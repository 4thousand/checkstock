<?php
$data = json_decode($_POST['dataquotation'],  true);
// print_r($data);
// echo $data['datenow_datepicker'];
$countdatenow = strlen($data['datenow_datepicker']);
// echo $countdatenow;

$delivery = $data['delivery_date'];
$date2 = explode('-', $delivery);
$year = $date2[0]+543;
$month   = $date2[1];
$day  = $date2[2];
$delivery_date = $day.'/'.$month.'/'.$year;

$due = $data['due_date'];
$data3 = explode('-', $due);
$year = $data3[0]+543;
$month   = $data3[1];
$day  = $data3[2];
$due_date = $day.'/'.$month.'/'.$year;

if($countdatenow <= 13 ){
  $convertdate = $data['datenow_datepicker'];
  $datenow_datepicker =  date( "d/m/Y", $convertdate);
}
if($countdatenow > 20 ){
$beforecut = $data['datenow_datepicker'];
$cutstring = substr($beforecut,0,10);   
$data4 = explode('-',$cutstring);
$year = $data4[0]+543;
$month   = $data4[1];
$day  = $data4[2];
$datenow_datepicker = $day.'/'.$month.'/'.$year;
}
// $data['doc_date'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Print Test</title>
  
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Niramit');
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        @page {
            size: auto;
            /* auto is the initial value */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }

        html {
            background-color: #FFFFFF;
            margin: 0px;
            /* this affects the margin on the html before sending to printer */
        }

        body {
            /* display:block !important; */
           max-width: 714px;
            /*            border: solid 1px blue;*/
            margin: 4mm 5mm 5mm 4mm;
            font-size: 30px;
            /* margin you want for the content */
        }

        span {
            font-size: 0.7rem;
            font-family: 'Niramit', sans-serif;
        }

        div {
            line-height: 0.5rem;
            padding-bottom: 0.15rem;
            word-break: break-word;
        }

        .underline {
            border-bottom: solid 1px black;
            width: 250px;
            height: 1px;
        }

        .settop {
            display: block;
            position: relative;
            top: 10px;
            left: 10px
        }
    </style>
      <style type="text/css" media="print">
     body {
        max-width: inherit !important;
     }
    </style>
</head>
<body>
<input type="hidden" id="docno" value="<?php echo $data['doc_no']; ?>">
    <div style="height: 81px">
        <div style="float: left;display: inline-block">
            <div>
                <img src="logo.jpg" style="width: 170px;height: 60px;position: relative;left: 1px;top: 5px"> <div id="qrcodeTable"></div>
            </div>
            <span style="position: relative;left: 2.3rem;font-weight: 500">เลขประจำตัวผู้เสียภาษี 0505533000157</span>
        </div>
        <div style="display: block;float: right;text-align: right;margin-top: 16px;margin-right: 5px;position: relative">
            <div>
                <span style="font-size: 0.9rem;font-weight: bold;">F-WS-301</span>
                <div style="position: absolute;right: 0" class="underline"></div>
            </div>
            <div style="text-align: right;margin-top: 12px">
                <span style="font-size: 1.1rem;font-weight: 500;">ใบเสนอราคา/ใบรับคำสั่งซื้อ</span>
                <div style="position: absolute;right: 0" class="underline"></div>
            </div>
            <div style="margin-top: 6px">
                <span style="font-size: 0.8rem;font-weight: 500;">RunNumber/Copy : <?php echo $data['doc_no']; ?>/1.00 <span style="font-weight: bold">QUOTATION</span> </span>
            </div>
        </div>
    </div> 
    <div style="width: 100%;height: 170px;margin-top: -5px;">
        <div style="float: left;width: 55%;height: 100%;border: 1px solid black;border-radius: 8px">
            <div class="settop" style="width: 95%;height: 55%">
                <div>   
                    <span>ชื่อลูกค้า</span> <span style="text-decoration:underline"><?php echo $data['ar_code']; ?> <?php echo $data['ar_name']; ?></span>
                </div>    
                <div style="margin-top: 20px">
                    <div style="width: 10%;float: left;position:relative;top: 6px">
                        <span>ที่อยู่</span>
                    </div>
                    <div style="width: 90%;float: left;word-break:break-word;padding-right: 8px">
                        <span style=" font-size: 0.67rem;position: relative;left: 13px;line-height: 20px"><?php echo $data['ar_bill_address']; ?> โทร 081-6711966</span>
                    </div>
                </div>
            </div> 
            <div class="settop" style="width: 95%;height: 35%">
                <div> 
                    <span>วันที่นัดส่งสินค้า <?php echo $delivery_date ?></span>
                </div>
                <div style="margin-top:10px;font-weight: bold; ">
                    <div style="width: 4%;float: left;padding-top: 7px">
                        <span style="font-size: 0.88rem">*</span>
                    </div>
                    <div style="width: 76%;float:left">
                        <span style="font-size: 0.88rem;display: block;line-height: 20px">สินค้าสั่งพิเศษ ลูกค้าไม่รับตามกำหนด 30 วัน จะคิดค่าบริการคลัง 1% ของมูลค่าสินค้า</span>

                    </div>
                </div>

            </div>

        </div>
        <div style="float: right;width: 45%;height: 60%;border: 1px solid black;border-radius: 8px">
            <div class="settop">
                <div>
                    <div style="float: left;width: 40%">
                        <span style="font-size: 0.95rem; ">เลขที่ใบเสนอราคา</span>
                    </div>
                    <div style="float: left;width: 60%">
                        <span style="font-size: 1.2rem; ">
                        <?php echo $data['doc_no']; ?></span>
                    </div>
                </div>
                <div style="margin-top: 20px">
                    <div style="float: left;width: 40%;text-align: right;padding-right: 10px">
                        <span style="font-size: 0.70rem;">วันที่ออกเอกสาร</span>
                    </div>
                    <div style="float: left;width: 60%">
                        <span style="font-size: 0.70rem;"><?php echo $datenow_datepicker ?></span>
                    </div>
                </div>
                <div style="margin-top: 20px">
                    <div style="float: left;width: 40%;text-align: right;padding-right: 10px">
                        <span style="font-size: 0.70rem;">เงื่อนไขการชำระเงิน</span>
                    </div>
                    <div style="float: left;width: 20%">
                        <span style="font-size: 0.70rem;"><?php echo $data['credit_day'] ?></span>
                    </div>
                    <div style="float: left;width: 30%">
                        <span style="font-size: 0.70rem;">วัน</span>
                    </div>
                </div>
                <div style="margin-top: 20px">
                    <div style="float: left;width: 40%;text-align: right;padding-right: 10px">
                        <span style="font-size: 0.70rem;">ยืนราคาถึงวันที่</span>
                    </div>
                    <div style="float: left;width: 60%">
                        <span style="font-size: 0.70rem;"><?php echo $due_date ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div style="float: right;width: 45%;height: 40%;border: 1px solid black;border-radius: 8px">
            <div style="font-size: 0.6rem;position: relative;left:5px;top: 5px">
                <div style="width: 100%;height: 35px;line-height:14px">
                    <span>พนักงานขาย</span> <span> <?php echo $data['sale_code'] ?> </span><span> <?php echo $data['sale_name'] ?> , โทร - , มือถือ - , อีเมลล์ -</span>
                </div>
            </div>
            <div style="width: 100%;text-align: center;font-size: 0.55rem;color: grey">
                <div>
                    <span> โทร: (053) 240-377 แฟกซ์: (053) 244-111</span>
                </div>
                <div style="position: relative;top: 3px;color: black">
                    <span>ComputerName: NEWAPPSERVICE/LogINName : administrator</span>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 18px;position: relative;top: 4px">
        <span style="font-size: 0.68rem;float: left">ขอขอบพระคุณที่ท่านไว้วางใจในบริการเรา ทางบริษัทฯมีความยินดีที่จะเสนอราคาสินค้า ดังต่อไปนี้</span>
        <span style="float: right;font-size: 0.68rem;">Page 1 of 1</span>
    </div>

    <div style="width: 100%;border-top: 1px solid black;border-left: 1px solid black;height: 615.77px;border-right: 1px solid black;border-radius: 5px">
        <div style="width: 100%;height: 3%;border-bottom: 1px solid black">
            <div style="float: left;width: 5%;height: 100%;border-right: 1px dashed grey;position: relative">
                <span style="font-size: 0.68rem;position: absolute;bottom: 3px;left: 2px">ลำดับ</span>
            </div>
            <div style="float: left;width: 40%;height: 100%;border-right: 1px dashed grey;position: relative">

                <span style="font-size: 0.68rem;position: absolute;bottom: 3px;left: 5px">รหัสสินค้า/รายละเอียด</span>
            </div>

            <div style="float: left;width: 13.75%;height: 100%;border-right: 1px dashed grey;position: relative">
                <span style="font-size: 0.68rem;position: absolute;bottom: 3px;right: 5px">จำนวน</span>
            </div>
            <div style="float: left;width: 13.75%;height: 100%;border-right: 1px dashed grey;position: relative">
                <span style="font-size: 0.68rem;position: absolute;bottom: 3px;right: 5px">หน่วย</span>
            </div>
            <div style="float: left;width: 13.75%;height: 100%;border-right: 1px dashed grey;position: relative">
                <span style="font-size: 0.68rem;position: absolute;bottom: 3px;right: 5px">ราคาต่อหน่วย</span>
            </div>
            <div style="float: left;width: 13.75%;height: 100%;position: relative">
                <span style="font-size: 0.68rem;position: absolute;bottom: 3px;right: 5px">ราคารวมภาษี</span>
            </div>
        </div>

        <div style="width: 100%;height: 97%;border-bottom: 1px solid black;position: relative">

            <div style="position: absolute;width: 5%;height: 100%;border-right: 1px dashed grey;">
            </div>
            <div style="left: 5%; position: absolute;width: 40%;height: 100%;border-right: 1px dashed grey">

            </div>

            <div style="left: 45%;width: 13.75%;height: 100%;border-right: 1px dashed grey;position: absolute">

            </div>
            <div style="left: 58.75%;width: 13.75%;height: 100%;border-right: 1px dashed grey;position: absolute">

            </div>
            <div style="left:72.5%;width: 13.75%;height: 100%;border-right: 1px dashed grey;position: absolute">

            </div>
            <div style="left: 86.25%;width: 13.75%;height: 100%;position: absolute">

            </div>
            <?php 
            $count = count($data['subs']);
            $detail = $data['subs'];
            for($i = 0; $i < $count; $i++){

            ?>
            <div style="position: relative;min-height: 20px;width: 100%;float: left">
                <div style="width: 5%;float:left;position: relative;line-height: 20px;text-align: center">
                    <span style="font-size: 0.68rem;"><?php $line = $i + 1; echo $line; ?></span>
                </div>
                <div style="width: 40%;float:left;position: relative;line-height: 20px;padding-left: 5px">
                    <span style="font-size: 0.68rem;"><?php echo $detail[$i]['item_code']; ?> <?php echo $detail[$i]['item_name']; ?></span>
                </div>
                <div style="width: 13.75%;float:left;position: relative;text-align: right;line-height: 20px">
                    <span style="font-size: 0.68rem;margin-right: 5px"><?php echo $detail[$i]['qty']; ?></span>
                </div>   
                <div style="width: 13.75%;float:left;position: relative;text-align: right;line-height: 20px">
                    <span style="font-size: 0.68rem;margin-right: 5px"><?php echo $detail[$i]['unit_code']; ?></span>
                </div>
                <div style="width: 13.75%;float:left;position: relative;text-align: right;line-height: 20px">
                    <span style="font-size: 0.68rem;margin-right: 5px"><?php echo $detail[$i]['price']; ?></span>
                </div>  
                <div style="width: 13.75%;float:left;position: relative;text-align: right;line-height: 20px">
                    <span style="font-size: 0.68rem;margin-right: 5px"><?php echo $detail[$i]['item_amount']; ?></span>
                </div>
            </div>
    <?php  } ?>
            <!-- <div style="position: relative;min-height: 20px;width: 100%;float: left">
                <div style="width: 5%;float:left;position: relative;line-height: 20px;text-align: center">
                    <span style="font-size: 0.68rem;">2</span>
                </div>
                <div style="width: 40%;float:left;position: relative;line-height: 20px;padding-left: 5px">
                    <span style="font-size: 0.68rem;">6701217 เซี้ยมจับมุมเสา KAIZEN SK-06L สีเทา ( ขนาดใหญ่ No.2 ) ยาว 2 เมตร : 1 กล่อง บรรจุ 100เส้น</span>
                </div>
                <div style="width: 13.75%;float:left;position: relative;text-align: right;line-height: 20px">
                    <span style="font-size: 0.68rem;margin-right: 5px">80.000</span>
                </div>
                <div style="width: 13.75%;float:left;position: relative;text-align: right;line-height: 20px">
                    <span style="font-size: 0.68rem;margin-right: 5px">เส้น</span>
                </div>
                <div style="width: 13.75%;float:left;position: relative;text-align: right;line-height: 20px">
                    <span style="font-size: 0.68rem;margin-right: 5px">17.00</span>
                </div>
                <div style="width: 13.75%;float:left;position: relative;text-align: right;line-height: 20px">
                    <span style="font-size: 0.68rem;margin-right: 5px">1,360.00</span>
                </div>
            </div> -->

            <!-- <div style="position: relative;min-height: 20px;width: 100%;float: left">
                <div style="width: 5%;float:left;position: relative;line-height: 20px;text-align: center">
                    <span style="font-size: 0.68rem;">3</span>
                </div>
                <div style="width: 40%;float:left;position: relative;line-height: 20px;padding-left: 5px">
                    <span style="font-size: 0.68rem;">8854346002240 LANKO 110 ปูนฉาบแต่งผิวบาง ภายนอก/ภายในสีขาว (20กก.)</span>
                </div>
                <div style="width: 13.75%;float:left;position: relative;text-align: right;line-height: 20px">
                    <span style="font-size: 0.68rem;margin-right: 5px">5.000</span>
                </div>
                <div style="width: 13.75%;float:left;position: relative;text-align: right;line-height: 20px">
                    <span style="font-size: 0.68rem;margin-right: 5px">ถุง</span>
                </div>
                <div style="width: 13.75%;float:left;position: relative;text-align: right;line-height: 20px">
                    <span style="font-size: 0.68rem;margin-right: 5px">266.00</span>
                </div>
                <div style="width: 13.75%;float:left;position: relative;text-align: right;line-height: 20px">
                    <span style="font-size: 0.68rem;margin-right: 5px">1,330.00</span>
                </div>
            </div> -->
        </div>
    </div>
    <div style="height: 185px;border: 1px solid black;border-radius: 5px">
        <div style="float:left;position: relative;padding-top: 5px;padding-left: 5px;width: 35%;height: 100%;border-right: 1px dashed grey;">
            <span> หมายเหตุ</span>
            <div style="position:absolute;bottom: -10px">
            <div style="margin-bottom: 8px">
            <span style="font-size: 0.85rem;font-weight: bold"> * ไม่ใช่ใบเสร็จรับเงิน *</span>
             </div>
                  <div style="margin-bottom: 8px">
            <span style="font-size: 0.85rem;font-weight: bold"> * กรุณาเรียกใบเสร็จทุกครั้งที่ชำระเงิน *</span>
             </div>
                <div style="margin-bottom: 8px">
            <span style="font-size: 0.85rem;font-weight: bold"> * มิฉะนั้น ทางบริษัทฯไม่รับผิดชอบ *</span>
             </div>
            </div>
        </div>
        <div style="display:block">
            <div style="width:17.5%;float: left;height: 35%;border-bottom: 1px solid black;border-right: 1px dashed grey;">
                <div style="width: 100%;height: 40%;position: relative">
                <span style="position: absolute;bottom: 0;left: 50%;transform: translateX(-50%);white-space: nowrap"> <?php echo $data['sale_code'] ?>  <?php echo $data['sale_name'] ?> </span>
                </div>
                <div style="width: 100%;height: 60%;position: relative">
                <span style="position: absolute;bottom: 5px;left: 50%;transform: translateX(-50%);"> ผู้ทำรายการ</span>
                </div>
            </div>
            <div style="width:17.5%;float: left;height: 35%;border-bottom: 1px solid black;border-right: 1px dashed grey;position: relative">
                    <span style="position: absolute;top: 17px;left: 0;white-space: nowrap">
                        <span style="text-decoration: underline;padding-left: 10px">หัก</span>
                        
                        ส่วนลด รวม
               
                </span>
                 <span style="position: absolute;right: 3px;top: 17px;"><?php echo $data['discount_amount'] ?></span>
            </div>
            <div style="width:30%;float: left;height: 35%;border-bottom: 1px solid black;position: relative">
                <div style="width: 100%;height: 33.333%;position: relative">
                    <div style="width: 50%;text-align: right;position: absolute;bottom: 0;">
                    <span style="position: relative;"> ราคาสินค้า</span>
                        </div>
                   <div style="width: 50%;text-align: right;position: absolute;bottom: 0;left: 50%">
                      <span style="position: relative;right: 5px"> <?php echo $data['after_discount_amount'] ?> </span>
                    </div> 
                </div>
                 <div style="width: 100%;height: 33.333%;position: relative">
                    <div style="width: 50%;text-align: right;position: absolute;bottom: 0;">
                    <span style="position: relative;"> จำนวนภาษีมูลค่าเพิ่ม</span>
                        </div>
                   <div style="width: 50%;text-align: right;position: absolute;bottom: 0;left: 50%">
                      <span style="position: relative;right: 5px"> <?php echo number_format((float)$data['dif_fee'] , 2, '.', '') ?> </span>
                    </div>
                </div>
                 <div style="width: 100%;height: 33.333%;position: relative">
                    <div style="width: 50%;text-align: right;position: absolute;bottom: 0;">
                    <span style="position: relative;">จำนวนเงินทั้งสิ้น</span>
                        </div>
                   <div style="width: 50%;text-align: right;position: absolute;bottom: 0;left: 50%">
                      <span style="position: relative;right: 5px"> <?php echo $data['after_discount_amount'] ?> </span>
                    </div>
                </div>
            </div>
        </div>
        <div style="display:block">
            <div style="width: 65%;float: left;height: 15%;border-bottom: 1px dashed grey;position: relative">
                <span style="font-size: 0.68rem;font-weight: bold;position: absolute;top: 50%;transform: translateY(-50%);left:10px">ตัวอักษร: แปดพันหนึ่งร้อยสี่สิบบาทถ้วน</span>
            </div>
        </div>
        <div style="display:block">
            <div style="width: 65%;float: left;height: 52%;border-bottom: 1px dashed grey;position: relative">
                <div style="width: 28%;height: 100%;border-right: 1px dashed grey;float: left">
                    <div style="height: 50%;width: 100%;text-align: center">
                    <span style="position: relative;top: 10px"> <?php echo $data['sale_code'] ?>   <?php echo $data['sale_name'] ?></span>
                    </div>
                    <div style="height: 50%;width: 100%;text-align: center;position: relative">
                        <div>
                        <span style="position:relative;top: 15px">............/............/............</span>
                            </div>
                        <div>
                        <span style="position: relative;top: 20px;font-size: 0.65rem">พนักงานขายผู้เสนอราคา</span>
                        </div>
                    </div>
                </div>
                <div style="width: 28%;height: 100%;border-right: 1px dashed grey;float: left">
                     <div style="height: 50%;width: 100%;text-align: center">
                    <span style="position: relative;top: 10px">ขอแสดงความนับถือ</span>
                    </div>
                      <div style="height: 50%;width: 100%;text-align: center;position: relative">
                        <div>
                        <span style="position:relative;top: 15px">............/............/............</span>
                            </div>
                        <div>
                        <span style="position: relative;top: 20px;font-size: 0.65rem">ผู้อนุมัติการเสนอราคา</span>
                        </div>
                    </div>
                </div>
                <div style="width: 44%;height: 100%;float: left">
                     <div style="height: 50%;width: 100%;text-align: center">
                    <span style="position: relative;top: 10px">อนุมัติสั่งซื้อตามใบเสนอราคานี้</span>
                    </div>
                      <div style="height: 50%;width: 100%;text-align: center;position: relative">
                        <div>
                        <span style="position:relative;top: 15px">............/............/............</span>
                            </div>
                        <div>
                        <span style="position: relative;top: 20px;font-size: 0.65rem">ลงชื่อผู้มีอำนาจในการสั่งซื้อ พร้อมประทับตรา</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="jquery.qrcode.js"></script>
<script type="text/javascript" src="qrcode.js"></script>
    <script>
   var inputdocno =  document.getElementById('docno').value;
   jQuery('#qrcodeTable').qrcode({
		render	: "table",
		text	: inputdocno
	});	
    
window.print()

</script>
</body>
</html>