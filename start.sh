#!/bin/bash

# Start the bot in the background
cd /bot
node mybot2.js &

# Start Apache in the foreground
apache2-foreground