![example workflow](https://github.com/yeeraf/laravel-ducument-numberer/actions/workflows/test.yml/badge.svg)

# Laravel Document Running Number Generator

แพคเกจสำหรับการสร้าง เลขที่เอกสาร สำหรับ Laravel โดยสร้างสามารถระบุ ตัวอักษร นำหน้า, ต่อท้าย, จำนวนหลักตัวเลข ได้เอง

## การติดตั้ง
```php
composer require yeeraf/laravel-ducument-numberer
```

หลังจากติดตั้งแล้วจะต้องทำการ run คำสั่ง migration สำหรับสร้าง table document_numbers เพื่อเก็บข้อมูลการสร้างเลขที่เอกสาร
```bash
php artisan migration
```

## ตัวอย่างการใข้งาน
```php
$documentNumberer = new \Yeeraf\DocumentNumberer\DocumentNumberer;
$docNumber = $documentNumberer->generate();
```


## License
The MIT License (MIT)

