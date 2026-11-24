import os
import time
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By

out_dir = r"c:\Users\LAB RPL 11\esaasas\dokumen_tugas\screenshots"
os.makedirs(out_dir, exist_ok=True)

chrome_options = Options()
chrome_options.add_argument("--headless=new")
chrome_options.add_argument("--disable-gpu")
chrome_options.add_argument("--no-sandbox")

driver = webdriver.Chrome(options=chrome_options)

viewports = {
    "desktop": (1280, 800),
    "tablet": (768, 1024),
    "hp": (375, 812),
}

def capture(url, name_prefix, wait_sec=1):
    for vp_name, (width, height) in viewports.items():
        driver.set_window_size(width, height)
        driver.get(url)
        time.sleep(wait_sec)
        filename = f"{name_prefix}_{vp_name}.png"
        filepath = os.path.join(out_dir, filename)
        driver.save_screenshot(filepath)
        print(f"Captured: {filename}")

try:
    print("--- 1. Capturing Login & Register ---")
    capture("http://127.0.0.1:8000/login", "01_login")
    capture("http://127.0.0.1:8000/register", "02_register")

    print("--- 2. Capturing Order (Halaman Depan / Kasir) ---")
    capture("http://127.0.0.1:8000", "03_order_cucian")

    print("--- 3. Logging in as Admin ---")
    driver.set_window_size(1280, 800)
    driver.get("http://127.0.0.1:8000/login")
    time.sleep(1)
    
    email_el = driver.find_element(By.ID, "email")
    pass_el = driver.find_element(By.ID, "password")
    email_el.clear()
    email_el.send_keys("admin@gmail.com")
    pass_el.clear()
    pass_el.send_keys("password")
    
    submit_btn = driver.find_element(By.CSS_SELECTOR, "button[type='submit']")
    submit_btn.click()
    time.sleep(2)

    print("--- 4. Capturing Rekap Order (Dashboard) ---")
    capture("http://127.0.0.1:8000/dashboard", "04_rekap_order")

    print("--- 5. Capturing CRUD Layanan (Master Paket) ---")
    capture("http://127.0.0.1:8000/admin/packages", "05_crud_layanan")
    capture("http://127.0.0.1:8000/admin/packages/create", "06_tambah_layanan")

    print("\nALL SCREENSHOTS CAPTURED SUCCESSFULLY!")
finally:
    driver.quit()
