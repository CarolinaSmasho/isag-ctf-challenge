#!/bin/bash
# Clear comments.txt on startup
if [ -f /var/www/html/comments.txt ]; then
    echo "" > /var/www/html/comments.txt
    echo "Cleared comments.txt on Docker startup"
fi

# Start Apache in the foreground
exec apache2-foreground