<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .receipt-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #6366f1;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .brand-name {
            font-size: 28px;
            font-weight: bold;
            color: #6366f1;
            margin: 10px 0;
        }
        .tagline {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .contact-info {
            font-size: 12px;
            color: #666;
            margin-top: 10px;
        }
        .receipt-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin: 30px 0;
            color: #333;
        }
        .receipt-details {
            margin: 30px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-label {
            font-weight: bold;
            color: #666;
            width: 40%;
        }
        .detail-value {
            color: #333;
            width: 60%;
            text-align: right;
        }
        .amount-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
        }
        .amount-row {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            padding: 10px 0;
        }
        .total-amount {
            font-size: 24px;
            font-weight: bold;
            color: #6366f1;
            border-top: 2px solid #6366f1;
            padding-top: 15px;
            margin-top: 15px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 12px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-paid {
            background: #10b981;
            color: white;
        }
        .thank-you {
            text-align: center;
            margin: 30px 0;
            font-size: 16px;
            color: #6366f1;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="header">
            @if($brandSettings && $brandSettings->brand_logo)
                <img src="{{ asset('storage/' . $brandSettings->brand_logo) }}" alt="Logo" class="logo">
            @endif
            <div class="brand-name">{{ $brandSettings->brand_name ?? 'SK Python Classes' }}</div>
            @if($brandSettings && $brandSettings->tagline)
                <div class="tagline">{{ $brandSettings->tagline }}</div>
            @endif
            @if($brandSettings)
                <div class="contact-info">
                    @if($brandSettings->address)
                        {{ $brandSettings->address }}<br>
                    @endif
                    @if($brandSettings->email)
                        Email: {{ $brandSettings->email }}
                    @endif
                    @if($brandSettings->phone)
                        | Phone: {{ $brandSettings->phone }}
                    @endif
                </div>
            @endif
        </div>

        <div class="receipt-title">PAYMENT RECEIPT</div>

        <div class="receipt-details">
            <div class="detail-row">
                <div class="detail-label">Receipt Number:</div>
                <div class="detail-value">#{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Payment Date:</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Student Name:</div>
                <div class="detail-value">{{ $payment->user->name }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Student Email:</div>
                <div class="detail-value">{{ $payment->user->email }}</div>
            </div>
            @if($payment->course)
            <div class="detail-row">
                <div class="detail-label">Course:</div>
                <div class="detail-value">{{ $payment->course->name }}</div>
            </div>
            @endif
            <div class="detail-row">
                <div class="detail-label">Payment Method:</div>
                <div class="detail-value">{{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? 'N/A')) }}</div>
            </div>
            @if($payment->transaction_id)
            <div class="detail-row">
                <div class="detail-label">Transaction ID:</div>
                <div class="detail-value">{{ $payment->transaction_id }}</div>
            </div>
            @endif
            <div class="detail-row">
                <div class="detail-label">Payment Status:</div>
                <div class="detail-value">
                    <span class="status-badge status-paid">{{ strtoupper($payment->status) }}</span>
                </div>
            </div>
        </div>

        <div class="amount-section">
            <div class="amount-row">
                <div>Amount Paid:</div>
                <div class="total-amount">₹{{ number_format($payment->amount, 2) }}</div>
            </div>
        </div>

        @if($payment->notes)
        <div class="receipt-details">
            <div class="detail-label" style="margin-bottom: 10px;">Notes:</div>
            <div style="color: #666; font-size: 14px;">{{ $payment->notes }}</div>
        </div>
        @endif

        <div class="thank-you">
            Thank you for your payment!
        </div>

        <div class="footer">
            <p>This is a computer-generated receipt. No signature is required.</p>
            <p>For any queries, please contact us at {{ $brandSettings->email ?? 'support@skpythonclasses.com' }}</p>
            <p>&copy; {{ date('Y') }} {{ $brandSettings->brand_name ?? 'SK Python Classes' }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

