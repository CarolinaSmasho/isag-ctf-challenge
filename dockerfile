# ใช้ base image PHP พร้อม Apache
FROM php:8.0-apache

# คัดลอกไฟล์ทั้งหมดไปยังโฟลเดอร์ในเซิร์ฟเวอร์
COPY . /var/www/html/

# เปิดพอร์ต 80
EXPOSE 80

# รันเซิร์ฟเวอร์ Apache
CMD ["apache2-foreground"]
