const puppeteer = require('puppeteer');
require('dotenv').config();

const delay = ms => new Promise(res => setTimeout(res, ms));

(async () => {
  const browser = await puppeteer.launch({
    headless: false,  // เปิด UI ให้เห็น
    args: ['--disable-web-security', '--no-sandbox', '--disable-dev-shm-usage', '--disable-setuid-sandbox']
  });

  const page = await browser.newPage();
  await page.setDefaultNavigationTimeout(60000);
  await page.setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3');

  // ไปยังหน้าที่มีคอมเมนต์
  await page.goto(`http://localhost`, { waitUntil: 'networkidle2' });

  console.log("กำลังตรวจสอบลิงก์ในคอมเมนต์...");

  // รอให้คอมเมนต์โหลด
  await delay(2000);

  // ตั้งค่าคุกกี้จากตัวแปร flag
  const flag = process.env.ISAG_CTF;
  if (flag) {
    await page.setCookie({
      name: 'flag',
      value: flag,
      domain: 'localhost',
      path: '/',
      httpOnly: true,
      secure: false
    });
    console.log("ตั้งค่าคุกกี้ flag สำเร็จ");
  }

  while(true){
    // ดึงลิงก์ทั้งหมดจากคอมเมนต์
    const links = await page.evaluate(() => {
    return Array.from(document.querySelectorAll('ul li a'))
                .map(link => link.href);
    });

    if (links.length === 0) {
    console.log("ไม่พบลิงก์ในคอมเมนต์");
    } else {
    console.log(`พบ ${links.length} ลิงก์ กำลังกดคลิก...`);
    
    for (const link of links) {
        console.log(`กำลังกดลิงก์: ${link}`);
        await page.evaluate(url => {
        window.open(url, '_blank');
        }, link);
        
        await delay(2000); // หน่วงเวลาก่อนกดลิงก์ถัดไป
    }
    }

    await delay(15000);
    await page.goto(`http://localhost`, { waitUntil: 'networkidle2' });
      
  }

})();
