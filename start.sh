#!/bin/bash

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${BLUE}========================================${NC}"
echo -e "${BLUE}  Starting SK Python Classes Server${NC}"
echo -e "${BLUE}========================================${NC}"
echo ""

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo -e "${RED}Error: PHP is not installed!${NC}"
    exit 1
fi

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo -e "${RED}Error: Node.js is not installed!${NC}"
    exit 1
fi

# Check if Composer is installed
if ! command -v composer &> /dev/null; then
    echo -e "${RED}Error: Composer is not installed!${NC}"
    exit 1
fi

# Function to cleanup on exit
cleanup() {
    echo ""
    echo -e "${YELLOW}Shutting down servers...${NC}"
    kill $LARAVEL_PID $VITE_PID 2>/dev/null
    wait $LARAVEL_PID $VITE_PID 2>/dev/null
    echo -e "${GREEN}Servers stopped successfully${NC}"
    exit
}

# Trap Ctrl+C
trap cleanup SIGINT SIGTERM

# Check if .env exists
if [ ! -f .env ]; then
    echo -e "${YELLOW}Warning: .env file not found. Creating from .env.example...${NC}"
    if [ -f .env.example ]; then
        cp .env.example .env
        echo -e "${GREEN}.env file created${NC}"
    else
        echo -e "${RED}Error: .env.example not found!${NC}"
        exit 1
    fi
fi

# Check if node_modules exists
if [ ! -d "node_modules" ]; then
    echo -e "${YELLOW}Installing npm dependencies...${NC}"
    npm install
fi

# Check if vendor exists
if [ ! -d "vendor" ]; then
    echo -e "${YELLOW}Installing composer dependencies...${NC}"
    composer install
fi

echo ""
echo -e "${GREEN}Starting Laravel Backend Server...${NC}"
php artisan serve &
LARAVEL_PID=$!

# Wait a bit for Laravel to start
sleep 2

# Check if Laravel server started successfully
if ! kill -0 $LARAVEL_PID 2>/dev/null; then
    echo -e "${RED}Error: Failed to start Laravel server${NC}"
    exit 1
fi

echo -e "${GREEN}Starting Vite Frontend Server...${NC}"
npm run dev &
VITE_PID=$!

# Wait a bit for Vite to start
sleep 2

# Check if Vite server started successfully
if ! kill -0 $VITE_PID 2>/dev/null; then
    echo -e "${RED}Error: Failed to start Vite server${NC}"
    kill $LARAVEL_PID 2>/dev/null
    exit 1
fi

echo ""
echo -e "${BLUE}========================================${NC}"
echo -e "${GREEN}✓ Backend Server:${NC} http://127.0.0.1:8000"
echo -e "${GREEN}✓ Frontend Server:${NC} Running on Vite"
echo -e "${BLUE}========================================${NC}"
echo ""
echo -e "${YELLOW}Both servers are running!${NC}"
echo -e "${YELLOW}Press Ctrl+C to stop all servers${NC}"
echo ""

# Wait for both processes
wait $LARAVEL_PID $VITE_PID

