# Docker Fazbear Tube CTF Challenge Setup

This Fazbear Tube CTF Challenge now works on both **Mac** and **amd64** systems.

## Quick Start Options

### Option 1: Run on Mac Host Machine (Easiest)
```bash
# Make sure you have PHP and Node.js installed
brew install php node

# Install dependencies
npm install

# Set your flag
echo "FLAG=OqH0uz396fl4g{sukasa_2214_00o00o}" > .env

# Start everything
./start-mac.sh
```

### Option 2: Run with Docker (Cross-platform)
```bash
# Set your flag
echo "FLAG=OqH0uz396fl4g{sukasa_2214_00o00o}" > .env

# Start with Docker Compose
docker-compose up --build
```

## Architecture

The challenge uses a 2-service Docker setup:
1. **Web Service** (`web`): PHP/Apache web app on port 8080
2. **Bot Service** (`bot`): Node.js bot that visits pages and sets cookies

## Key Features

1. **Mac Compatibility**: Created `start-mac.sh` to run on Mac without Docker
2. **Cross-platform Docker**: Added `platform: linux/amd64` to force x86_64 architecture
3. **Bot Improvements**: Updated bot to detect environment (Docker vs Mac)
4. **Simplified Setup**: Separated web and bot services for easier debugging
5. **Automatic Comments Clearing**: Comments.txt is automatically cleared on Docker container startup

## Testing

To test the challenge locally on Mac:
1. Run `./start-mac.sh` to start just the web server
2. Visit `http://localhost:8080` in your browser
3. The bot will simulate an admin visiting links with the flag cookie

## Docker Notes for Mac

On Apple Silicon Macs:
- Docker will emulate x86_64 architecture for consistency
- The `platform: linux/amd64` setting ensures compatibility
- Performance may be slightly slower due to emulation

## Environment Variables

- `FLAG`: The flag value that gets set as a cookie (OqH0uz396fl4g{sukasa_2214_00o00o})
- `DOCKER_ENV`: Set to `true` when running in Docker (auto-detected)
- `PUPPETEER_SKIP_CHROMIUM_DOWNLOAD`: Skip Chrome download in Docker