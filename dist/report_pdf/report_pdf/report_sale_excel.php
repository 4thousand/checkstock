<?php
//คำสั่ง connect db เขียนเพิ่มเองนะ
ini_set('max_execution_time', 300);
ini_set("pcre.backtrack_limit", "1000000000");
ini_set('memory_limit', '-1');
$strExcelFileName="report_sale_".date("Y-m-d").".xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40">
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
  <title>รายงานสรุปยอดขายประจำวัน</title>
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
    }

    .table td,th {
      border: 1px solid gray;
      padding: 1%;
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

$data = json_decode($_POST['data'],  true);

$all_amount_page = 0;
sort($data);
$cnt_data = count($data);
for ($a = 0; $a < $cnt_data; $a++) {
  $all_amount_page += $data[$a]['total_host_amount'];
}

?>

<h5 style="margin-bottom: 0; padding: 0;"> จากวันที่ <?php echo date("d/m/Y", strtotime($_POST['start_date'])); ?> ถึงวันที่ <?php echo date("d/m/Y", strtotime($_POST['end_date'])); ?></h5>
  <table class="table" style="autosize:2.4;">
      <?php for($x = 0; $x < $cnt_data; $x++){?>
              
          <tbody>
            <tr style="background: #c2c3c4;">
              <th colspan="6" style="text-align: left;">วันที่ : <?php echo date("d/m/Y", strtotime($data[$x]['date'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;จุดขาย : เคาน์เตอร์ <?php echo $data[$x]['host']; ?> </th>
            </tr>
            <tr style="background: #c2c3c4;">
              <th style="width: 10%;"> คิว </th>
              <th style="width: 40%;"> รายการ </th>
              <th style="width: 10%;"> จำนวน </th>
              <th style="width: 10%;"> ราคาสินค้า </th>
              <th style="width: 15%;"> ภาษีมูลค่าเพิ่ม </th>
              <th style="width: 15%;"> ราคาสุทธิ </th>
            </tr>
            <?php 
              $order = $data[$x]['order_list'];
              $cnt = count($order); 
              for($s = 0; $s < $cnt; $s++){ 
              ?>
               <tr>
                  <td ><?php echo $order[$s]['que_id']; ?></td>
                  <td style="text-align: left;"> 
                    <?php 
                      $sub = $order[$s]['item_subs'];
                      $cnt_sub = count($sub);
                      for($y = 0; $y < $cnt_sub; $y++){
                        echo '<span>'.$sub[$y]['item_name'].'</span> ';
                        if($sub[$y]['description']!=''){
                          echo '<i>('.$sub[$y]['description'].')</i><br>';
                        }else{
                          echo '<br>';
                        }
                      }
                    ?>               
                  </td>
                  <td>
                    <?php 
                      $sub = $order[$s]['item_subs'];
                      $cnt_sub = count($sub);
                      for($y = 0; $y < $cnt_sub; $y++){
                        echo '<span>'.$sub[$y]['qty'].'</span><br> ';
                      }
                    ?>
                  </td>
                  <td style="text-align: right;">
                    <?php 
                      $sub = $order[$s]['item_subs'];
                      $cnt_sub = count($sub);
                      for($y = 0; $y < $cnt_sub; $y++){
                        echo '<span>'.number_format($sub[$y]['amount'], 2, '.', ',').'</span><br>';
                      }
                    ?>
                  </td>
                  <td > <?php echo number_format($order[$s]['tax_amount'], 2, '.', ',');?> </td>
                  <td style="text-align: right;"> <?php echo number_format($order[$s]['total_amount'], 2, '.', ','); ?></td>
                </tr>
             <?php } ?>    
            <tr>
              <th colspan="4" style="text-align: left;">รวมจุดขาย</th>
              <th colspan="2" style="text-align: right;"><?php echo number_format($data[$x]['total_host_amount'], 2, '.', ','); ?> </th>
            </tr>
          </tbody>

      <?php } ?>
          <!-- ************************************************ -->
          <tr style="background: #edf1f7;">
            <th colspan="4" style="text-align: left;">ยอดรวมทั้งหมด</th>
            <th colspan="2" style="text-align: right;"><?php echo number_format($all_amount_page, 2, '.', ','); ?></th>
          </tr>
          <!-- ************************************************* -->
  </table>
</body>
</html>