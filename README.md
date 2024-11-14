## Test Status
[![Test](https://github.com/yeeraf/laravel-document-numberer/actions/workflows/test.yml/badge.svg)](https://github.com/yeeraf/laravel-document-numberer/actions/workflows/test.yml)

# Laravel Document Running Number Generator

แพคเกจ laravel สำหรับการสร้าง เลขที่เอกสาร โดยสร้างสามารถระบุ ตัวอักษร นำหน้า, ต่อท้าย, จำนวนหลักตัวเลข ได้เอง เหมาระกับการใช้กับพวกเอกสารใบแจ้งหนี้ ใบเสร็จรับเงิน หรือเอกสารต่างๆได้ ตัวอย่างเลขที่เอกสาร

- INV-000001
- INV2101-0001
- REC-0000001
- QT #####1

## การติดตั้ง

```php
composer require yeeraf/laravel-document-numberer
```

หลังจากติดตั้งแล้วจะต้องทำการ run คำสั่ง migration สำหรับสร้าง table document_numbers เพื่อเก็บข้อมูลการสร้างเลขที่เอกสาร

```bash
php artisan migrate
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

### กรณีต้องการให้เลขที่เอกสาร 2 ประเภทมี format เดียวกัน แต่ต้องการให้ running แยกกัน เข่น

เลขใบแจ้งหนี้ เริ่มที่ 2107000001, 2107000002, 2107000003, ...

เลขใบเสร็จรับเงิน เริ่มที่ 2107000001, 2107000002, 2107000003, ...

ระบบสามารถแยกประเภทได้ดังนี้

```php
// ใบแจ้งหนี้
$documentNumberer = new \Yeeraf\DocumentNumberer\DocumentNumberer;
$docNumber = $documentNumberer->name("invoice")->generate();
```

```php
// ใบเสร็จรับเงิน
$documentNumberer = new \Yeeraf\DocumentNumberer\DocumentNumberer;
$docNumber = $documentNumberer->name("receipt")->generate();
```

### กรณีต้องการเปลี่ยน การสร้างเลขที่เอกสาร เช่น ต้องการ

- นำหน้าด้วย **INV-**
- มี running number **3 หลัก**
- เปลี่ยน padding string จาก **0 -> #**
- ท้ายด้วย **-X**

ตัวอย่าง INV-##1-X

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
