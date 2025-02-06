const puppeteer = require('puppeteer');
require('dotenv').config();

// function to timeout 
const delay = ms => new Promise(res => setTimeout(res, ms));
const threadsURL = `http://${process.env.HOST}:${process.env.PORT}/thread.php`;

(async () => {
  const browser = await puppeteer.launch({
    headless: true,
    args: ['--disable-web-security','--no-sandbox', '--disable-dev-shm-usage', '--disable-setuid-sandbox']
  });
  const page = await browser.newPage();
  
  await page.setDefaultNavigationTimeout(60000);
  await page.setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3');

  await page.goto(`http://localhost`, {waitUntil: 'networkidle2'})
  console.log("Hello YOUTUBE")

  // page.view('#comment-container')

  await page.type('#comment', "Hello");
  // await page.type('#passwordForLogin', process.env.ADMIN_PASSWORD);
  await page.click('#submit');

  // await page.waitForNavigation({ waitUntil: 'networkidle2' });

  // const cookies = await page.cookies();
  // const session = cookies.find(cookies => cookies.name === 'sessionid');

  await page.setCookie(process.env.ISAG_CTF);

  // while (true) {
  //   try {
  //     await page.goto(threadsURL);
  //     console.log(`Visiting threads at ${new Date().toLocaleString()}`);
  //     await delay(5000);
  //   }
  //   catch (error) {
  //     console.error(error);
  //   }
    
  // }
})();
