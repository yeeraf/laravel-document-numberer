![example workflow](https://github.com/yeeraf/laravel-ducument-numberer/actions/workflows/test.yml/badge.svg)

# Laravel Document Running Number Generator

แพคเกจ laravel สำหรับการสร้าง เลขที่เอกสาร โดยสร้างสามารถระบุ ตัวอักษร นำหน้า, ต่อท้าย, จำนวนหลักตัวเลข ได้เอง เหมาระกับการใช้กับพวกเอกสารใบแจ้งหนี้ ใบเสร็จรับเงิน หรือเอกสารต่างๆได้ ตัวอย่างเลขที่เอกสาร

- INV-000001
- INV2101-0001
- REP-0000001
- QT #####1

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

โดยค่าเริ่มต้น เลขที่เอกสารจะเป็น 

นำหน้าด้วย ปีปัจจุบัน 2 digit และ เดือนปัจจุบัน 2 digit เข่น ถ้าวันนี้วันที่ 20/07/2021 เลขนำหน้าเอกสารจะเป็น **2107**000001

ความยาวของ running number จะเป็น 6 หลัก เริ่มต้องด้วย 1 เช่น
2107**000001**

ต่อท้าย - ไม่มี

### กรณีต้องการเปลี่ยน การสร้างเลขที่เอกสาร เช่น ต้องการ 
- นำหน้าด้วย **INV-**
- มี running number **3 หลัก**
- เปลี่ยน padding string จาก **0 -> #**
- ท้ายด้วย **-X**

ตัวอย่าง INV-001-X
```php
$documentNumberer = new \Yeeraf\DocumentNumberer\DocumentNumberer;
$docNumber = $documentNumberer
    ->prefix("INV-")
    ->padLength(3)
    ->padString("#")
    ->suffix("-X")
    ->generate();
```
## License
The MIT License (MIT)

