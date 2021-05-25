<?php
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 8,
	'default_font' => 'sarabun'
]);

$mpdf->SetImportUse();
$mpdf->SetDocTemplate('normalform.pdf',true);
$html = '<div style="text-align:center;position:absolute;top:615px;left:220px;"><h1>ลายเซ็น</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:653px;left:180px;"><h1>ชื่ออาจารย์</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:700px;left:170px;"><h1> วัน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เดือน &nbsp;&nbsp;&nbsp;&nbsp; ปี</h1></div>';


$mpdf->WriteHTML($html);



$mpdf->Output();
?>