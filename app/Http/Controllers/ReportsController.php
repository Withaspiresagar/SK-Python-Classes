<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Query;
use App\Models\LiveClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    /**
     * Get reports data based on time period
     */
    public function index(Request $request)
    {
        $period = $request->query('period', 'month');
        
        // Calculate date range based on period
        $dateRange = $this->getDateRange($period);
        
        // Get statistics
        $stats = $this->getStats($dateRange);
        
        // Get top courses
        $topCourses = $this->getTopCourses($dateRange);
        
        // Get revenue by month (last 6 months)
        $revenueByMonth = $this->getRevenueByMonth();
        
        // Get students by month (last 6 months)
        $studentsByMonth = $this->getStudentsByMonth();
        
        // Get recent activities
        $recentActivities = $this->getRecentActivities();
        
        return response()->json([
            'success' => true,
            'stats' => $stats,
            'topCourses' => $topCourses,
            'revenueByMonth' => $revenueByMonth,
            'studentsByMonth' => $studentsByMonth,
            'recentActivities' => $recentActivities
        ]);
    }
    
    private function getDateRange($period)
    {
        $now = Carbon::now();
        
        switch ($period) {
            case 'today':
                return [
                    'start' => $now->copy()->startOfDay(),
                    'end' => $now->copy()->endOfDay()
                ];
            case 'week':
                return [
                    'start' => $now->copy()->startOfWeek(),
                    'end' => $now->copy()->endOfWeek()
                ];
            case 'month':
                return [
                    'start' => $now->copy()->startOfMonth(),
                    'end' => $now->copy()->endOfMonth()
                ];
            case 'year':
                return [
                    'start' => $now->copy()->startOfYear(),
                    'end' => $now->copy()->endOfYear()
                ];
            default: // all
                return [
                    'start' => Carbon::create(2020, 1, 1),
                    'end' => $now
                ];
        }
    }
    
    private function getStats($dateRange)
    {
        // Total students
        $totalStudents = User::where('role', 'student')->count();
        
        // New students this month
        $newStudentsThisMonth = User::where('role', 'student')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        
        // Total courses
        $totalCourses = Course::count();
        
        // Active courses
        $activeCourses = Course::where('status', 'active')->count();
        
        // Total revenue (sum of all course prices - simplified, in real app you'd have enrollments/payments table)
        $totalRevenue = Course::where('status', 'active')->sum('price');
        
        // Revenue this month (simplified - based on queries created this month)
        // In real app, this would be from payments/enrollments
        $queriesThisMonth = Query::whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();
        
        // Estimate revenue based on queries (assuming each query = potential enrollment)
        // Use average course price
        $avgCoursePrice = Course::where('status', 'active')->avg('price') ?: 10000;
        $revenueThisMonth = $queriesThisMonth * $avgCoursePrice;
        
        // Total enrollments (using queries as proxy for now)
        $totalEnrollments = Query::count();
        
        // Enrollments this month
        $enrollmentsThisMonth = Query::whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();
        
        // Completion rate (simplified - based on resolved queries)
        $totalResolved = Query::where('status', 'resolved')->count();
        $completionRate = $totalEnrollments > 0 
            ? round(($totalResolved / $totalEnrollments) * 100) 
            : 0;
        
        // Average rating (placeholder - would come from reviews table)
        $averageRating = 4.5;
        $totalReviews = $totalEnrollments; // Using enrollments as proxy
        
        // Active users (students with status active)
        $activeUsers = User::where('role', 'student')
            ->where('status', 'active')
            ->count();
        
        // Active users today (logged in today - simplified)
        $activeUsersToday = User::where('role', 'student')
            ->whereDate('updated_at', Carbon::today())
            ->count();
        
        return [
            'totalStudents' => $totalStudents,
            'newStudentsThisMonth' => $newStudentsThisMonth,
            'totalCourses' => $totalCourses,
            'activeCourses' => $activeCourses,
            'totalRevenue' => $totalRevenue,
            'revenueThisMonth' => $revenueThisMonth,
            'totalEnrollments' => $totalEnrollments,
            'enrollmentsThisMonth' => $enrollmentsThisMonth,
            'completionRate' => $completionRate,
            'averageRating' => $averageRating,
            'totalReviews' => $totalReviews,
            'activeUsers' => $activeUsers,
            'activeUsersToday' => $activeUsersToday
        ];
    }
    
    private function getTopCourses($dateRange)
    {
        // Get all courses
        $courses = Course::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return $courses->map(function($course) use ($dateRange) {
            // Count queries related to this course (by checking if course name is in subject)
            $enrollments = Query::where('subject', 'like', '%' . $course->name . '%')
                ->whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
                ->count();
            
            // If no direct match, use a base count
            if ($enrollments === 0) {
                $enrollments = Query::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
                    ->count();
                // Distribute evenly among courses
                $enrollments = max(1, round($enrollments / max(1, Course::where('status', 'active')->count())));
            }
            
            return [
                'id' => $course->id,
                'name' => $course->name,
                'enrollments' => $enrollments,
                'rating' => round(4.0 + (rand(0, 10) / 10), 1), // Placeholder rating
                'revenue' => $course->price * $enrollments
            ];
        })->sortByDesc('enrollments')->values()->toArray();
    }
    
    private function getRevenueByMonth()
    {
        $months = [];
        $monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 
                       'July', 'August', 'September', 'October', 'November', 'December'];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $monthNames[$date->month - 1];
            
            // Count queries in this month as proxy for revenue
            $queriesCount = Query::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            
            $revenue = $queriesCount * 10000; // Simplified calculation
            
            $months[] = [
                'month' => $monthName,
                'amount' => $revenue
            ];
        }
        
        return $months;
    }
    
    private function getStudentsByMonth()
    {
        $months = [];
        $monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 
                       'July', 'August', 'September', 'October', 'November', 'December'];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $monthNames[$date->month - 1];
            
            $count = User::where('role', 'student')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            
            $months[] = [
                'month' => $monthName,
                'count' => $count
            ];
        }
        
        return $months;
    }
    
    private function getRecentActivities()
    {
        $activities = [];
        
        // Get recent queries (enrollments)
        $recentQueries = Query::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        foreach ($recentQueries as $query) {
            $activities[] = [
                'id' => $query->id,
                'type' => 'enrollment',
                'title' => 'New Inquiry',
                'description' => $query->name . ' submitted inquiry: ' . $query->subject,
                'time' => $this->getTimeAgo($query->created_at),
                'timestamp' => Carbon::parse($query->created_at)->timestamp
            ];
        }
        
        // Get recent courses
        $recentCourses = Course::orderBy('created_at', 'desc')
            ->limit(2)
            ->get();
        
        foreach ($recentCourses as $course) {
            $activities[] = [
                'id' => 'course_' . $course->id,
                'type' => 'course',
                'title' => 'Course Created',
                'description' => $course->name . ' course was created',
                'time' => $this->getTimeAgo($course->created_at),
                'timestamp' => Carbon::parse($course->created_at)->timestamp
            ];
        }
        
        // Sort by timestamp (most recent first) and limit to 5
        usort($activities, function($a, $b) {
            return $b['timestamp'] - $a['timestamp'];
        });
        
        // Remove timestamp before returning
        $activities = array_map(function($activity) {
            unset($activity['timestamp']);
            return $activity;
        }, array_slice($activities, 0, 5));
        
        return $activities;
    }
    
    private function getTimeAgo($date)
    {
        $carbon = Carbon::parse($date);
        $diff = $carbon->diffForHumans();
        
        if ($carbon->isToday()) {
            if ($carbon->diffInMinutes() < 60) {
                return $carbon->diffInMinutes() . ' minutes ago';
            }
            return $carbon->diffInHours() . ' hours ago';
        } elseif ($carbon->isYesterday()) {
            return 'Yesterday';
        } elseif ($carbon->diffInDays() < 7) {
            return $carbon->diffInDays() . ' days ago';
        } else {
            return $carbon->format('M d, Y');
        }
    }

    /**
     * Get comprehensive dashboard data
     */
    public function dashboard()
    {
        // Get basic stats
        $totalStudents = User::where('role', 'student')->count();
        $totalCourses = Course::count();
        $activeCourses = Course::where('status', 'active')->count();
        $totalRevenue = Course::where('status', 'active')->sum('price');
        
        // Calculate student growth (this month vs last month)
        $studentsThisMonth = User::where('role', 'student')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $studentsLastMonth = User::where('role', 'student')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        $studentGrowth = $studentsLastMonth > 0 
            ? round((($studentsThisMonth - $studentsLastMonth) / $studentsLastMonth) * 100) 
            : ($studentsThisMonth > 0 ? 100 : 0);
        
        // Calculate revenue growth
        $revenueThisMonth = Query::whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count() * (Course::where('status', 'active')->avg('price') ?: 10000);
        
        $revenueLastMonth = Query::whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->count() * (Course::where('status', 'active')->avg('price') ?: 10000);
        
        $revenueGrowth = $revenueLastMonth > 0 
            ? round((($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100) 
            : ($revenueThisMonth > 0 ? 100 : 0);
        
        // Active classes (live classes scheduled/ongoing)
        $activeClasses = LiveClass::whereIn('status', ['scheduled', 'ongoing'])->count();
        
        // Today's classes
        $todayClasses = LiveClass::whereDate('date', Carbon::today())
            ->whereIn('status', ['scheduled', 'ongoing'])
            ->count();
        
        // Enrollment data for last 6 months
        $enrollmentData = [];
        $monthLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthLabels[] = $date->format('M');
            $enrollmentData[] = Query::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
        }
        
        // Course popularity (top 6 courses by query count)
        $courses = Course::where('status', 'active')->get();
        $coursePopularity = $courses->map(function($course) {
            $enrollments = Query::where('subject', 'like', '%' . $course->name . '%')
                ->orWhere('message', 'like', '%' . $course->name . '%')
                ->count();
            return [
                'name' => $course->name,
                'enrollments' => $enrollments
            ];
        })->sortByDesc('enrollments')->take(6)->values();
        
        // Student distribution by course (top 6 courses)
        $topCoursesForDistribution = $courses->take(6);
        $studentDistributionLabels = $topCoursesForDistribution->pluck('name')->toArray();
        $studentDistribution = $topCoursesForDistribution->map(function($course) {
            $count = Query::where('subject', 'like', '%' . $course->name . '%')
                ->orWhere('message', 'like', '%' . $course->name . '%')
                ->count();
            return $count;
        })->toArray();
        
        // Payment status (using query status as proxy)
        $paid = Query::where('status', 'resolved')->count();
        $pending = Query::where('status', 'pending')->count();
        $overdue = 0; // Placeholder
        
        // Revenue trend (last 6 months)
        $revenueTrend = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $queriesCount = Query::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            $avgPrice = Course::where('status', 'active')->avg('price') ?: 10000;
            $revenueTrend[] = $queriesCount * $avgPrice;
        }
        
        // Monthly enrollments (new vs returning - simplified)
        $newStudents = [];
        $returningStudents = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $new = Query::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            $newStudents[] = $new;
            $returningStudents[] = max(0, round($new * 0.3)); // Estimate 30% returning
        }
        
        return response()->json([
            'success' => true,
            'stats' => [
                'totalStudents' => $totalStudents,
                'totalCourses' => $totalCourses,
                'activeClasses' => $activeClasses,
                'totalRevenue' => $totalRevenue,
                'studentGrowth' => $studentGrowth,
                'revenueGrowth' => $revenueGrowth,
                'activeCourses' => $activeCourses,
                'todayClasses' => $todayClasses
            ],
            'charts' => [
                'enrollmentData' => [
                    'labels' => $monthLabels,
                    'data' => $enrollmentData
                ],
                'coursePopularity' => [
                    'labels' => $coursePopularity->pluck('name')->toArray(),
                    'data' => $coursePopularity->pluck('enrollments')->toArray()
                ],
                'studentDistribution' => [
                    'labels' => $studentDistributionLabels,
                    'data' => $studentDistribution
                ],
                'paymentStatus' => [
                    'paid' => $paid,
                    'pending' => $pending,
                    'overdue' => $overdue
                ],
                'revenueTrend' => [
                    'labels' => $monthLabels,
                    'data' => $revenueTrend
                ],
                'monthlyEnrollments' => [
                    'labels' => $monthLabels,
                    'newStudents' => $newStudents,
                    'returningStudents' => $returningStudents
                ]
            ]
        ]);
    }
}

