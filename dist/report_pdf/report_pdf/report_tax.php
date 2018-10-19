<?php
require_once __DIR__ . '/vendor/autoload.php';
ini_set('max_execution_time', 300);
ini_set("pcre.backtrack_limit", "1000000000");
ini_set('memory_limit', '-1');
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>รายงานภาษีขาย</title>
  <style>
    @font-face {
      font-family: 'THsaraban';
      src: url('font/THSarabun.ttf');
    }

    body * {
      text-align: center;
      font-family: 'THsaraban';
    }

    h5 {
      text-align: center;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
      font-family: 'THsaraban';
      margin-top: 0;
      text-align: center;
      font-size: 10px;
    }

    .table th {
      background: #d1d3d6;      
      padding: 1%;
    }

    .table td {
      padding: 0.5% 1%;
    }

    .table td,th {
      border: 1px solid black;
      font-family: 'THsaraban';
      text-align: center;
    }

    .table tbody td,th {
      font-size: 12px;
      text-align: center;
      vertical-align: top;
    }
  </style>
</head>
<body>
<?php

$data = json_decode($_POST['data_tax'],  true);

switch ($data['report_month']) {
  case '1':
    $date = 'มกราคม '.$data['report_year'];
    break;
  case '2':
    $date = 'กุมภาพันธ์ '.$data['report_year'];
    break;
  case '3':
    $date = 'มีนาคม '.$data['report_year'];
    break;
  case '4':
    $date = 'เมษายน '.$data['report_year'];
    break;
  case '5':
    $date = 'พฤษภาคม '.$data['report_year'];
    break;
  case '6':
    $date = 'มิถุนายน '.$data['report_year'];
    break;
  case '7':
    $date = 'กรกฏาคม '.$data['report_year'];
    break;
  case '8':
    $date = 'สิงหาคม '.$data['report_year'];
    break;
  case '9':
    $date = 'กันยายน '.$data['report_year'];
    break;
  case '10':
    $date = 'ตุลาคม '.$data['report_year'];
    break;
  case '11':
    $date = 'พฤศจิกายน '.$data['report_year'];
    break;
  case '12':
    $date = 'ธันวาคม '.$data['report_year'];
    break;
}

?>
<table class="table">
  <tr>
    <th colspan="3" style="width: 15%;">ใบกำกับภาษี</th>
    <th rowspan="2" style="width: 15%;">ชื่อผู้ซื้อสินค้า/ชื่อผู้รับบริการ</th>
    <th rowspan="2" style="width: 10%;">เลขประจำตัวผู้เสียภาษี</th>
    <th rowspan="2" style="width: 10%;">สถานประกอบการสำนักงานใหญ่ สาขาที่</th>
    <th rowspan="2" style="width: 14%;">มูลค่าสินค้า/บริการ</th>
    <th rowspan="2" style="width: 10%;">จำนวนเงินภาษีมูลค่าเพิ่ม</th>
    <th rowspan="2" style="width: 14%;">รวมยอด</th>
  </tr>
  <tr>
    <th>ลำดับที่</th>
    <th>วันเดือนปี</th>
    <th>เล่มที่/เลขที่</th>
  </tr>

  <?php
    $cnt = count($data['details']);
    $detail = $data['details'];
    for($i = 0; $i < $cnt; $i++){
      $sum_of_item_amount += $detail[$i]['sum_of_item_amount'];
      $sum_tax_amount += $detail[$i]['tax_amount'];
      $sum_total_amount += $detail[$i]['sum_total_amount'];
  ?>

  <tr>
    <td><?php $line = $i + 1; echo $line; ?></td>
    <td><?php echo date("d/m/Y", strtotime($detail[$i]['doc_date'])); ?></td>
    <td><?php echo $detail[$i]['doc_no']; ?></td>
    <td><?php echo $detail[$i]['customer_name']; ?></td>
    <td><?php echo $detail[$i]['cust_tax_id']; ?></td>
    <td><?php echo $data['company_name']; ?></td>
    <td style="text-align: right;"><?php echo number_format($detail[$i]['sum_of_item_amount'], 2, '.', ','); ?></td>
    <td style="text-align: right;"><?php echo number_format($detail[$i]['tax_amount'], 2, '.', ','); ?></td>
    <td style="text-align: right;"><?php echo number_format($detail[$i]['sum_total_amount'], 2, '.', ','); ?></td>
  </tr>

  <?php
    }
  ?>

  <tr>
    <th colspan="6" style="text-align: left;">รวม</th>
    <th style="text-align: right;"><?php echo number_format($sum_of_item_amount, 2, '.', ','); ?></th>
    <th style="text-align: right;"><?php echo number_format($sum_tax_amount, 2, '.', ','); ?></th>
    <th style="text-align: right;"><?php echo number_format($sum_total_amount, 2, '.', ','); ?></th>
  </tr>
</table>


</body>
</html>

<?php
date_default_timezone_set("Asia/Bangkok");

$datetime = date("d/m/Y H:i:s");
$header = "<div style='width:100%; text-align:center; font-size: 20px; font-style: B; '>รายงานภาษีขาย</div>"; 
$header .= "<div style='width:100%; text-align:center; font-size: 16px; font-style: B;'>เดือน ".$date."</div>"; 
$header .= "<div style='width:50%; text-align:left; float:left; clear: both; font-size: 12px; font-style: B;'>
ชื่อบริษัท&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$data['company_name']."<br> 
ชื่อผู้ประกอบการ&nbsp;".$data['entre_preneur_name']."<br> 
ที่อยู่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$data['address']."<br>
[x] สำนักงานใหญ่  [ ] สาขา
</div>"; 
$header .= "<div style='width:50%; text-align:right; float:left; font-size: 12px; font-style: B;'>
ชื่อสถานที่ประกอบการ ".$data['company_name']."<br>
เลขประจำตัวผู้เสียภาษี ".$data['tax_id']."<br>
อัตราภาษี ".$data['tax_rate']." %<br>
</div>"; 

$footer = "<div style='width:100%; text-align:right;'>บันทึก ณ วันที่ ".$datetime."</div>"; 

$html = ob_get_contents();
ob_end_clean();
try {
$pdf = new \Mpdf\Mpdf(['mode' => 'th', 'format' => 'A4-L', 'setAutoTopMargin' => 'stretch']);
$pdf->SetHeader($header);
$pdf->WriteHTML($html);
$pdf->Setfooter($footer);
$pdf->Output('ReportTax.pdf', \Mpdf\Output\Destination::INLINE);
} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}

?>     