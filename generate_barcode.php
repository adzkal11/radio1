<?php
require_once __DIR__ . '/midtrans-php/barcode/BarcodeGenerator.php';
require_once __DIR__ . '/midtrans-php/barcode/BarcodeGeneratorPNG.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

// Pastikan order_id dikirim via query string, contoh: generate_barcode.php?order_id=TRX123
$order_id = $_GET['order_id'] ?? 'UNKNOWN';

header('Content-type: image/png');

$generator = new BarcodeGeneratorPNG();
echo $generator->getBarcode($order_id, $generator::TYPE_CODE_128);