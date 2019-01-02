<?php
$data = json_decode($_POST['datasale'],  true);
// print_r($data);
//exit;
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


//เซ็ท format money
//$number = 1234.56;
setlocale(LC_MONETARY, 'en_US');
//echo money_format('%(#10n', $number) . "\n";

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
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
            size: landscape;
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
            max-width: 1096px;
            /*            border: solid 1px blue;*/
            margin: 4mm 4mm 4mm 4mm;
            font-size: 30px;
            padding-left: 10px;
            padding-bottom: 14px;
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
            padding: 10px 0 0 10px;
        }

        svg {
            position: absolute !important;
            width: 179px !important;
            height: 69px !important;
            top: 0px !important;
            left: 0px !important;
        }

        .table2 {
            width: 40%
        }

    </style>
    <style type="text/css" media="print">
        body {

            max-width: inherit !important;
        }

        .printnone {
            display: none;
        }

    </style>
</head>

<body>
    <input type="hidden" id="barcodedocno" value="<?php echo $data['doc_no']; ?>">
    <input type="hidden" id="convertmoney" value="<?php echo $data['after_discount_amount']; ?>">
    <div style="height: 81px">
        <div style="float: left;display: inline-block;width: 300px">
            <div>
                <!--            <div style="position: absolute; background: white; width: 173px; height: 12px; left: 171px; top: 70px; z-index: 20;"></div>-->
                <img src="logo.jpg" style="width: 235px; height: 70px; position: absolute; left: 45px; top: 16px;">
                <!--                <svg id="code128"></svg>-->
            </div>
            <span style="position: absolute; left: 18.1rem; font-weight: bold; top: 77px;">RunNumber :
                <?php echo $data['doc_no']; ?></span>

            <span style="position: absolute; left: 28.5rem; top: 77px;">รหัสลูกค้า :
                <?php echo $data['ar_code']; ?>
                <?php echo $data['ar_name']; ?> <span style="font-size:0.9rem;padding-left: 20px"> เอกสารภายใน ไม่ใช้กับลูกค้า</span></span>
        </div>
        <div style="float: left;padding-top: 12px">
            <span style="display: block;font-size: 0.88rem;line-height: 20px;font-weight: bold">** ไม่ใช่ใบเสร็จรับเงิน พนักงานขายไม่มีสิทธิ์เรียกเก็บเงินจากเอกสารนี้ ***</span>
            <span style="display: block;font-size: 0.88rem;line-height: 20px;font-weight: bold">*** กรุณาเรียกใบเสร็จทุกครั้งที่ชำระงิน ***</span>
        </div>
        <div style="display: block;float: right;;text-align: right;top: 2px;margin-top: 16px;margin-right: 5px;position: relative">
            <div>
                <span style="font-size: 0.9rem;font-weight: bold;">F-WS-404</span>
                <div style="position: absolute;right: 0" class="underline"></div>
            </div>
            <div style="text-align: right;margin-top: 12px;">
                <span style="font-size: 1.1rem;font-weight: 500;">ใบสั่งขาย - Sales Order</span>
                <div style="position: absolute;right: 0" class="underline"></div>
            </div>
            <div style="margin-top: 6px">
                <span style="font-size: 0.8rem;font-weight: 500;">Page 1 of 1 </span>
            </div>
        </div>
    </div>
    <div style="width: 100%;height: 170px;margin-top: -5px;">
        <div style="float: left;width: 33%;height: 100%;border: 1px solid black;border-radius: 8px">
            <div class="settop" style="width: 95%;height: 45%">

                <div>
                    <span>ชื่อลูกค้า</span> <span style="text-decoration:underline">
                        <?php echo $data['ar_code']; ?>
                        <?php echo $data['ar_name']; ?>
                    </span>
                </div>
                <div style="margin-top: 20px">
                    <div style="width: 10%;float: left;position:relative;top: 6px">
                        <span>ที่อยู่</span>
                    </div>
                    <div style="width: 90%;float: left;word-break:break-word;padding-right: 8px">

                        <span style=" font-size: 0.67rem;position: relative;left: -13px;line-height: 20px">
                            <?php echo $data['ar_bill_address']; ?></span>
                    </div>
                </div>
            </div>
            <div class="settop" style="width: 95%;height: 30%">
                <div style="height: 35%;line-height: 1.2">
                    <span>
                        <?php echo $data['sale_code'] ?> </span><span>
                        <?php echo $data['sale_name'] ?> , โทร - , มือถือ - , อีเมลล์ -</span>
                </div>
            </div>

            <div style="margin-top:10px;font-weight: bold;height: 25%">
                <div style="width: 100%;float:left;padding-left:5px;">
                    <span style="font-size: 0.68rem;display: block;line-height: 20px">ใบสั่งของลูกค้า</span>
                </div>
            </div>
        </div>
        <div style="width: 100%;height: 170px;margin-top: -5px;">
            <div style="margin-left:0.5%;float: left;width: 33%;height: 100%;border: 1px solid black;border-radius: 8px">
                <div class="settop" style="width: 95%;height: 69%">
                    <div style="width: 100%;height: 65%">
                        <div style="width: 30%;float: left;text-align: right">
                            <span style="font-size: 0.68rem;font-weight: bold">ส่งไปที่/Ship to</span>
                        </div>
                        <div style="width: 70%; padding-left: 13px; word-break: break-word; float: right; line-height: 16px;">
                            <span style="font-size: 0.68rem;padding-left: 15px;">
                            ที่อยู่ <?php echo $data['cus_address']; ?> ตำบล  <?php echo $data['cus_district']; ?>
                                อำเภอ/เขต <?php echo $data['cus_canton']; ?> จังหวัด <?php echo $data['cus_province']; ?> 
                                รหัสไปรษณีย์ <?php echo $data['cus_post']; ?> เบอร์โทรศัพท์ผู้รับสินค้า <?php echo $data['cus_tel']; ?>
                            </span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 20%">
                        <div style="width: 30%;float: left;text-align: right">
                            <span style="font-size: 0.68rem;font-weight: bold">ผู้รับสินค้า</span>
                        </div>
                        <div style="width:80%;padding-left: 5px">
                            <span style="font-size: 0.68rem;padding-left: 15px;">
                                <?php echo $data['cus_name']; ?>
                            </span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 20%">
                        <div style="width: 30%;float: left;text-align: right">
                            <span style="font-size: 0.68rem;font-weight: bold">ผู้ติดต่อ</span>
                        </div>
                        <div style="width:80%;padding-left: 5px">
                            <span style="font-size: 0.68rem;padding-left: 15px;">
                                <?php echo $data['contact']; ?>
                            </span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 20%">
                        <div style="width: 30%;float: left;text-align: right">
                            <span style="font-size: 0.68rem;font-weight: bold">วันที่นัดส่ง</span>
                        </div>
                        <div style="width:80%;padding-left: 5px">
                            <span style="font-size: 0.68rem;padding-left: 15px;">
                                <?php echo $delivery_date ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="settop" style="width: 95%;height: 20%;">
                    <div style="margin-top:10px;font-weight: bold; ">
                        <div style="width: 50%;float: left;padding-top: 7px">
                            <span style="font-size: 0.68rem">เงื่อนไขการออกบิล</span>

                        </div>
                        <div style="width: 50%;float: right;padding-top: 7px;text-align: right">
                            <?php 
                                    $is_send;
                                    if($data['is_condition_send'] == '0'){
                                        $is_send = 'รับเอง';
                                    }else{
                                        $is_send = 'ส่งให้';
                                    }
                            ?>
                            <span style="font-size: 0.68rem">เงื่อนไขการออกบิล
                                <?php echo $is_send; ?></span>
                        </div>
                    </div>
                </div>

            </div>


            <div style="float: right;width: 33%;height: 100%;border: 1px solid black;border-radius: 8px;position:relative">
                <div style="position: absolute;
                        width: 178px;
                        height: 10px;
                        background: white;
                        z-index: 99;
                        top: 51px;"></div>
                <svg id="code128"></svg>
                <div class="settop">
                    <div style="height:14%;padding-right: 5px;text-align: right">
                        <span style="font-size: 0.88rem">เลขที่ใบสั่งขาย</span>
                    </div>
                    <div style="height:20%;padding-right: 5px;text-align: right">
                        <span style="font-size: 1.2rem">
                            <?php echo $data['doc_no']; ?></span>
                    </div>
                    <div style="height:15%;padding-right: 5px;text-align: right;padding-right: 75px">
                        <span style="font-size: 0.68rem">วันที่ออกเอกสาร <span style="font-weight: bold">
                                <?php echo $datenow_datepicker ?></span></span>
                    </div>
                    <div style="height:15%;padding-right: 5px;text-align: right;padding-right: 75px">
                        <span style="font-size: 0.68rem">เงื่อนไขการส่งสินค้า <span style="font-weight: bold">
                                <?php echo $data['credit_day'] ?></span> วัน</span>
                    </div>
                    <div style="height:15%;padding-right: 5px;text-align: right;padding-right: 75px">
                        <span style="font-size: 0.68rem">ยืนราคาถึง <span style="font-weight: bold;">
                                <?php echo $due_date ?></span></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="heightproduct" style="width: 100%;border-top: 1px solid black;border-left: 1px solid black;height: 336.77px;border-right: 1px solid black;border-radius: 5px">
            <div style="width: 100%;    height: 25px;border-bottom: 1px solid black">

                <div style="height:100%;float: left;width: 3%;border-right: 1px dashed grey;position: relative">
                    <span style="font-size: 0.68rem;position: absolute;left: 50%;transform: translateX(-50%);bottom: 3px;">No</span>

                </div>

                <div style="width: 5%;float: left;height: 100%;border-right: 1px dashed grey;position: relative">
                    <span style="font-size: 0.68rem;position: absolute;bottom: 3px;white-space: nowrap">คลังชั้นเก็บ</span>
                </div>

                <div style="float:left;width: 20%;height: 100%;border-right: 1px dashed grey;position: relative">
                    <span style="font-size: 0.68rem;position: absolute;left: 5px;bottom: 3px">รหัสสินค้า/รายละเอียด</span>
                </div>

                <div style="float: left;width: 6.5%;height: 100%;border-right: 1px dashed grey;position: relative">
                    <span style="font-size: 0.68rem;position: absolute;bottom: 3px;right: 5px">น้ำหนัก (ก.ก)</span>
                </div>

                <div style="float: left;width: 6.5%;height: 100%;border-right: 1px dashed grey;position: relative">
                    <span style="font-size: 0.68rem;position: absolute;bottom: 3px;right: 5px">Qty ที่สั่ง</span>
                </div>
                <div style="float: left;width: 6.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.68rem;position: absolute;bottom: 3px;right: 5px">ถึงจุดสั่งซื้อ</span>
                </div>
                <div style="float: left;width: 6.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.68rem;position: absolute;bottom: 3px;right: 5px">Onhand</span>
                </div>
                <div style="float: left;width: 6.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.58rem;white-space: nowrap;position: absolute;bottom: 3px;">Qtyออกบอล(จอง)</span>
                </div>
                <div style="float: left;width: 6.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.58rem;white-space: nowrap;position: absolute;bottom: 3px;right: 5px">Qty ที่ค้างส่ง</span>
                </div>
                <div style="float: left;width: 6.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.58rem;white-space: nowrap;position: absolute;bottom: 3px;right: 5px">หน่วยนับ</span>
                </div>
                <div style="float: left;width: 6.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.58rem;white-space: nowrap;position: absolute;bottom: 3px;right: 5px">ราคาต่อหน่วย</span>
                </div>
                <div style="float: left;width: 6.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.58rem;white-space: nowrap;position: absolute;bottom: 3px;right: 5px">ราคารวม</span>
                </div>
                <div style="float: left;width: 6.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.58rem;white-space: nowrap;position: absolute;bottom: 3px;right: 5px">ส่วนลดรวม</span>
                </div>
                <div style="float: left;width: 6.5%;height: 100%;position: relative;">
                    <span style="font-size: 0.58rem;white-space: nowrap;position: absolute;bottom: 3px;right: 5px">ยอดจองคงเหลือ</span>
                </div>
            </div>

            <div id="counttable" style="width: 100%;height: calc(100% - 25px);border-bottom: 1px solid black;position: relative">

                <div style="position: absolute;width: 3%;height: 100%;border-right: 1px dashed grey;">

                </div>
                <div class="table2" style="left: 3%;width: 5% ;position: absolute;height: 100%;border-right: 1px dashed grey">

                </div>

                <div style="left: 8%;width: 20%;height: 100%;border-right: 1px dashed grey;position: absolute">

                </div>
                <div style="left: 28%;width: 6.5%;height: 100%;border-right: 1px dashed grey;position: absolute">

                </div>
                <div style="left:34.5%;width: 6.5%;height: 100%;border-right: 1px dashed grey;position: absolute">

                </div>
                <div style="left: 41%;width: 6.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 47.5%;width: 6.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 54%;width: 6.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 60.5%;width: 6.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 67%;width: 6.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 73.5%;width: 6.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 80%;width: 6.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 86.5%;width: 6.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 93%;width: 7%;height: 100%;position: absolute;">

                </div>

                <?php 
            $count = count($data['subs']);
            $detail = $data['subs'];
            for($i = 0; $i < $count; $i++){

            ?>
                <div style="position: relative;min-height: 20px;width: 100%;float: left">
                    <div style="width: 3%;float:left;position: relative;line-height: 20px;text-align: center">
                        <span style="font-size: 0.68rem;">
                            <?php $line = $i + 1; echo $line; ?></span>
                    </div>
                    <div style="width: 5%;float:left;position: relative;line-height: 20px;padding-left: 5px">
                        <span style="font-size: 0.68rem;">
                            <?php echo $detail[$i]['wh_code']; ?> /
                            <?php echo $detail[$i]['shelf_code']; ?></span>
                    </div>

                    <div style="width: 20%;float:left;position: relative;line-height: 20px;padding-left: 5px">
                     <span style="font-size: 0.68rem;">
                            <?php echo $detail[$i]['item_code']; ?>
                            <?php echo $detail[$i]['item_name']; ?></span>
                    </div>
                    <!-- น้ำหนัก กก.-->
                    <div style="width: 6.5%;float:left;position: relative;line-height: 20px;padding-left: 5px">
                        <span style="font-size: 0.68rem;margin-right: 5px">
                            <?php echo money_format("%!n",2000); ?></span>
                    </div>
                        <!-- QTY -->
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.68rem;margin-right: 5px">
                            <?php echo money_format("%!n",$detail[$i]['qty']); ?>
                        </span>
                    </div>
                        <!-- ถึงจุดสั่งซื้อ -->
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.68rem;margin-right: 5px"></span>
                    </div>
                        <!-- onhand --> 
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.68rem;margin-right: 5px"></span>
                    </div>
                        <!-- Qtyออกบอล(จอง) -->
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.68rem;margin-right: 5px"></span>
                    </div>
                        <!-- Qty ที่ค้างส่ง --> 
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.68rem;margin-right: 5px"></span>
                    </div>
                        <!-- หน่วยนับ --> 
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.68rem;margin-right: 5px">
                        <?php echo $detail[$i]['unit_code']; ?>
                        </span>
                    </div>
                        <!-- ราคาต่อหน่วย -->
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.68rem;margin-right: 5px">
                        <?php echo money_format("%!n",$detail[$i]['price']); ?>
                        </span>
                    </div>
                        <!-- ราคารวม -->  
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.68rem;margin-right: 5px">
                            
                        </span>
                    </div>
                        <!-- ส่วนลดรวม -->   
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.68rem;margin-right: 5px">
                         <?php echo money_format("%!n",$detail[$i]['discount_amount']); ?>
                        </span>
                    </div> 
                        <!-- ยอดจองคงเหลือ -->  
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.68rem;margin-right: 5px">
                        <?php echo money_format("%!n",$detail[$i]['item_amount']); ?>
                        </span>
                    </div>
                </div>
                <?php } ?>

                <!-- รวมทั้งหมด -->
<!--
                <div style="position: relative;min-height: 20px;width: 100%;height: 93.1%;float: left">
                    <div style="width: 8%;float:left;position: relative;line-height: 20px;text-align: center">

                    </div>
                    <div style="padding-top: 12px;width: 26.2%;float:left;position: relative;line-height: 20px;padding-left: 5px;z-index: 99;background: white;height: 100%;border-top: 1px solid black;">
                        <div style="float: left;width: 80%;">
                            <span style="font-size: 0.78rem;font-weight: bold">
                                น้ำหนักรวมทั้งหมด :
                            </span>
                        </div>
                        <div style="width: 20%;float: left">
                            <span style="font-size: 0.78rem;">
                                2,000.00
                            </span>
                        </div>
                    </div>

                </div>
-->
                <!-- รวมทั้งหมด-->


            </div>
        </div>
        <div style="height: 170px;border: 1px solid black;border-radius: 5px">
            <!--            border-right: 1px dashed grey;-->
            <div style="float:left;position: relative;padding-top: 5px;padding-left: 5px;width: 35%;height: 60%;">

                <span style="font-size: 0.85rem;font-weight: bold;white-space: nowrap;line-height: 1.5"><span style="font-weight: 100">หมายเหตุ : </span>* สินค้าเหลือน้อยห โปรดแจ้ง Section Manager(ขายปลีก) ก่อนนำสินค้าไปขาย</span>
                <span style="font-size: 0.85rem;font-weight: bold;white-space: nowrap;line-height: 1.5;padding-left: 50px;"> * สินค้าสั่งพิเศษ ลูกค้าไม่รับตามกำหนดเกิน 30 วัน จะคิดค่าบริการคลัง 1% ของมูลค่าสินค้า</span>
                <!--
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
-->
            </div>
            <div style="display: block">

                <div style="width:19.6%;float: right;height: 60%;position: relative">
                    <div style="width: 100%;height: 25%;position: relative">
                        <div style="width: 50%;text-align: right;position: absolute;bottom: 0;">
                            <span style="position: relative;"> ราคาสินค้า</span>
                        </div>
                        <div style="width: 50%;text-align: right;position: absolute;bottom: 0;left: 50%">
                            <span style="position: relative;right: 5px">
                                <?php echo money_format("%!n", $data['after_discount_amount']);  ?></span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 25%;position: relative">
                        <div style="width: 50%;text-align: right;position: absolute;bottom: 0;">
                            <span style="position: relative;"> จำนวนภาษีมูลค่าเพิ่ม</span>
                        </div>
                        <div style="width: 50%;text-align: right;position: absolute;bottom: 0;left: 50%">
                            <span style="position: relative;right: 5px">
                                <?php echo money_format("%!n",  $data['dif_fee']); ?></span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 25%;position: relative">
                        <div style="width: 50%;text-align: right;position: absolute;bottom: 0;">
                            <span style="position: relative;">จำนวนเงินทั้งสิ้น</span>
                        </div>
                        <div style="width: 50%;text-align: right;position: absolute;bottom: 0;left: 50%">
                            <span style="position: relative;right: 5px">
                                <?php echo  money_format("%!n", $data['after_discount_amount']); ?>
                            </span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 25%;position: relative">
                        <div style="width: 50%;text-align: right;position: absolute;bottom: 0;">
                            <span style="position: relative;">คงค้างชำระ</span>
                        </div>
                        <div style="width: 50%;text-align: right;position: absolute;bottom: 0;left: 50%">
                            <span style="position: relative;right: 5px">
                                <?php echo  money_format("%!n", $data['after_discount_amount']); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div style="width:16.8%;float: right;height: 60%;border-right: 1px dashed grey;position: relative;border-left: 1px dashed grey;">
                    <span style="position: absolute;top: 17px;left: 0;white-space: nowrap">
                        <span style="text-decoration: underline;padding-left: 10px">หัก</span>

                        ส่วนลด รวม

                    </span>
                    <span style="position: absolute;right: 3px;top: 17px;">
                        <?php echo money_format("%!n", $data['discount_amount']);?></span>
                </div>

            </div>
            <!--
            <div style="display:block">
                <div style="width: 65%;float: left;height: 15%;border-bottom: 1px dashed grey;position: relative">
                    <span style="font-size: 0.68rem;font-weight: bold;position: absolute;top: 50%;transform: translateY(-50%);left:10px">ตัวอักษร: <span id="thaimoney"></span></span>
                </div>
            </div>
-->
            <div style="display:block">
                <div style="float: right;height: 42.5%;position: relative;border-left: 1px dashed grey;border-top: 1px solid black;">
                    <div style="width: 109px;height: 100%;text-align: center;border-right: 1px dashed grey;float: left">
                        <span style="position: relative;top: 10px">ผู้ทำรายการ</span>
                        <span style="bottom: 8px; white-space: nowrap; left: 20px;position: absolute">
                            <?php echo $data['sale_name'] ?></span>
                    </div>
                    <div style="width:120px;height: 100%;text-align: center;border-right: 1px dashed grey;float: left;position:relative">
                        <span style="position: relative;top: 10px">ผู้สั่งขาย</span>
                        
                        <span style="bottom: 5px; white-space: nowrap; left: 4px;position: absolute">
                           <?php echo $data['sale_code'] ?>   <?php echo $data['sale_name'] ?></span>
                       
                    </div>

                    <div style="width: 109px;height: 100%;text-align: center;border-right: 1px dashed grey;float: left">

                        <span style="position: relative;top: 10px">ผู้อนุมัติการขาย</span>
                    </div>


                    <div style="position: relative;width:109px;height: 100%;text-align: center;border-right: 1px dashed grey;float: left">
                        <span style="position: relative;top: 10px">ลูกค้าเซ็นรับทราบ</span>
                        <span style="bottom: 6px; white-space: nowrap; left: 20px;position: absolute"> ยืนยันการสั่งซื้อ</span>
                    </div>

                    <div style="width: 240px;height: 100%;text-align: center;float: left">
                        <span style="position: relative;top: 10px">ตัวอักษร : <span id="thaimoney"></span></span>
                    </div>


                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="convertthaimoney.js"></script>
        <script src="JsBarcode.all.min.js"></script>
        <script>
            // alert($("#counttable div").length)
            // alert('dasdsa')
            //    var heightproduct = document.getElementById('heightproduct').clientHeight;
            //    var valuepage = document.getElementById('valuepage').value
            var totalmoney = document.getElementById('convertmoney').value;
            console.log(totalmoney);
            var inputthaimoney = document.getElementById('thaimoney');
            var thaimoney = ArabicNumberToText(totalmoney.toString());

            inputthaimoney.innerHTML = thaimoney;
            //
            var docno = document.getElementById('barcodedocno').value
            JsBarcode("#code128", docno);
            //
            //    function sizepage(){
            //        document.getElementById('heightproduct').style.height = document.getElementById('valuepage').value
            //    }

        </script>
</body>

</html>
