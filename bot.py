from selenium import webdriver
from selenium.webdriver.chrome.options import Options
import time


class Bot(object):
    def __init__(self):
        chrome_options = Options()
        chrome_options.add_argument("--headless")
        chrome_options.add_argument("--disable-gpu")
        chrome_options.add_argument("--no-sandbox")

        self.driver = webdriver.Chrome(options=chrome_options)

    def visit(self, url):
        self.driver.get("http://127.0.0.1:5000")

        self.driver.add_cookie(
            {"name": "flag", "value": "FLAG{DUMMY_FLAG}", "httpOnly": False}
        )

        self.driver.get(url)
        time.sleep(1)
        self.driver.refresh()
        print("Visited:", url)

    def close(self):
        self.driver.quit()
        print("Browser closed")
