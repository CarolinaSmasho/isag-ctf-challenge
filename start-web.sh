#!/bin/bash

# Simple script to start just the PHP web server
echo "Starting PHP web server on port 8080..."

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP first:"
    echo "   brew install php"
    exit 1
fi

echo "📁 Changing to app/views directory..."
cd app/views

# Create comments.txt if it doesn't exist
touch comments.txt

echo "🌐 Starting PHP web server on port 8080..."
echo "   Web app will be available at: http://localhost:8080"
echo "   Press Ctrl+C to stop the server"

# Start PHP web server
php -S localhost:8080