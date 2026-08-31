#!/bin/bash

# Simple script to run on Mac host machine
# This script starts the PHP web server and the bot

echo "Starting YouTube Clone CTF Challenge on Mac..."

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP first:"
    echo "   brew install php"
    exit 1
fi

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed. Please install Node.js first:"
    echo "   brew install node"
    exit 1
fi

# Check if .env file exists
if [ ! -f .env ]; then
    echo "⚠️  .env file not found. Creating a sample .env file..."
    echo "FLAG=ISAG{test_flag}" > .env
    echo "✅ Created sample .env file with FLAG=ISAG{test_flag}"
fi

echo "📁 Changing to app/views directory..."
cd app/views

# Create comments.txt if it doesn't exist
touch comments.txt

echo "🌐 Starting PHP web server on port 8080..."
echo "   Web app will be available at: http://localhost:8080"
echo "   Press Ctrl+C to stop the server"

# Start PHP web server in the background
php -S localhost:8080 &
PHP_PID=$!

echo "✅ PHP web server started with PID: $PHP_PID"

# Wait a moment for the server to start
sleep 3

echo ""
echo "🤖 Starting bot..."
echo "   Bot will connect to http://localhost:8080"

# Go back to root and start the bot
cd ../..

# Check if bot dependencies are installed
if [ ! -d "node_modules" ]; then
    echo "📦 Installing Node.js dependencies..."
    npm install
fi

echo "🚀 Starting bot in the background..."
node bot/mybot2.js &
BOT_PID=$!

echo "✅ Bot started with PID: $BOT_PID"

echo ""
echo "========================================"
echo "🎯 CTF Challenge is now running!"
echo "========================================"
echo "Web App:  http://localhost:8080"
echo "Bot PID:  $BOT_PID"
echo "PHP PID:  $PHP_PID"
echo ""
echo "To stop everything, run:"
echo "  kill $BOT_PID $PHP_PID"
echo "========================================"
echo ""
echo "📝 Logs will appear above. The bot will visit the page every 15 seconds."

# Wait for both processes
wait $PHP_PID $BOT_PID