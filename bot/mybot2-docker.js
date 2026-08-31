const puppeteer = require("puppeteer");
require("dotenv").config();

const delay = (ms) => new Promise((res) => setTimeout(res, ms));

(async () => {
  try {
    // Determine host based on environment
    // When running in Docker, use service name "web"
    // When running locally, use localhost:8080
    const host = process.env.DOCKER_ENV === "true" ? "web" : "localhost:8080";

    console.log(`📌 Bot connecting to: http://${host}`);
    console.log(`📌 Running in Docker: ${process.env.DOCKER_ENV === "true"}`);

    const browser = await puppeteer.launch({
      headless: true,  // Use true for Docker
      args: [
        "--no-sandbox",
        "--disable-setuid-sandbox",
        "--disable-dev-shm-usage",
        "--disable-gpu",
      ],
      // For Alpine Linux in Docker
      executablePath: process.env.PUPPETEER_EXECUTABLE_PATH || undefined,
    });

    const page = await browser.newPage();
    await page.setDefaultNavigationTimeout(60000);
    await page.setUserAgent(
      "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3"
    );

    console.log("กำลังเปิดหน้าเว็บ...");

    await page.goto(`http://${host}/index.php`, {
      waitUntil: "networkidle2",
    });

    console.log("✅ Connected to:", page.url());

    const flag = process.env.FLAG;
    console.log("📌 ค่าของ flag:", flag);

    if (flag) {
      const currentURL = new URL(page.url());
      const domain = currentURL.hostname;

      await page.setCookie({
        name: "flag",
        value: flag,
        domain: domain,
        path: "/",
        httpOnly: false,
        secure: false,
      });

      console.log("✅ ตั้งค่าคุกกี้ flag สำเร็จ");

      const cookies = await page.cookies();
      console.log("🎯 คุกกี้ที่ตั้งค่าแล้ว:", cookies);
    } else {
      console.log("⚠️ ไม่มีค่าของ `FLAG` ใน .env");
    }

    while (true) {
      await page.goto(`http://${host}/index.php`, {
        waitUntil: "networkidle2",
      });

      console.log("กำลังตรวจสอบลิงก์ในคอมเมนต์...");
      await delay(2000);

      const links = await page.evaluate(() => {
        return Array.from(document.querySelectorAll("ul li a")).map(
          (link) => link.href
        );
      });

      if (links.length === 0) {
        console.log("ไม่พบลิงก์ในคอมเมนต์");
      } else {
        console.log(`พบ ${links.length} ลิงก์`);

        for (const link of links) {
          try {
            console.log(`กำลังกดลิงก์: ${link}`);
            await page.goto(link);
            await delay(2000);
          } catch (error) {
            console.log("Error clicking link:", error.message);
          }
        }
      }

      await delay(15000);
    }
  } catch (error) {
    console.log("Bot error:", error);
  }
})();