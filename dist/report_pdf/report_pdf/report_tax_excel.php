<?php
//คำสั่ง connect db เขียนเพิ่มเองนะ
ini_set('max_execution_time', 300);
ini_set("pcre.backtrack_limit", "1000000000");
ini_set('memory_limit', '-1');

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

$strExcelFileName="report_tax_".$date."(".date("Y-m-d").").xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40">
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

<center>
<h1>รายงานภาษีขายประจำเดือน <?php echo $date; ?></h1>
</center>
<table class="table" style="font-size: 14px;">
  <tr>
    <th colspan="3" style="width: 15%; font-size: 14px;">ใบกำกับภาษี</th>
    <th rowspan="2" style="width: 15%; font-size: 14px;">ชื่อผู้ซื้อสินค้า/ชื่อผู้รับบริการ</th>
    <th rowspan="2" style="width: 10%; font-size: 14px;">เลขประจำตัวผู้เสียภาษี</th>
    <th rowspan="2" style="width: 10%; font-size: 14px;">สถานประกอบการสำนักงานใหญ่ สาขาที่</th>
    <th rowspan="2" style="width: 14%; font-size: 14px;">มูลค่าสินค้า/บริการ</th>
    <th rowspan="2" style="width: 10%; font-size: 14px;">จำนวนเงินภาษีมูลค่าเพิ่ม</th>
    <th rowspan="2" style="width: 14%; font-size: 14px;">รวมยอด</th>
  </tr>
  <tr>
    <th style="font-size: 14px;">ลำดับที่</th>
    <th style="font-size: 14px;">วันเดือนปี</th>
    <th style="font-size: 14px;">เล่มที่/เลขที่</th>
  </tr>

  <?php
    $cnt = count($data['details']);
    $detail = $data['details'];
    $sum_of_item_amount = 0;
    $sum_tax_amount = 0;
    $sum_total_amount = 0;
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