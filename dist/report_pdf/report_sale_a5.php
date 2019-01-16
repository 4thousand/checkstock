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
            max-width: 794px;
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
            width: 150px;
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
                <img src="logo.jpg" style="width: 160px; height: 72px; position: absolute; left: 45px; top: 16px;">
                <!--                <svg id="code128"></svg>-->
            </div>
            <span style="position: absolute; left: 13.5rem; font-weight: bold; top: 77px;"><span style="font-size:0.6rem">RunNumber :</span>
            <span style="font-size:0.6rem;"><?php echo $data['doc_no']; ?></span></span>

            <span style="position: absolute; left: 25.5rem; top: 77px;"><span style="font-size:0.6rem;padding-left: 10px">รหัสลูกค้า :</span>
                <span style="font-size:0.6rem;padding-left: 10px"><?php echo $data['ar_code']; ?></span>
                <span style="font-size:0.6rem;padding-left: 10px"><?php echo $data['ar_name']; ?></span> 
                <span style="font-size:0.6rem;padding-left: 20px"> เอกสารภายใน ไม่ใช้กับลูกค้า</span></span>
        </div>
        <div style="float: left;padding-top: 12px">
            <span style="display: block;font-size: 0.6rem;line-height: 10px;font-weight: bold">** ไม่ใช่ใบเสร็จรับเงิน พนักงานขายไม่มีสิทธิ์เรียกเก็บเงินจากเอกสารนี้ ***</span>
            <span style="display: block;font-size: 0.6rem;line-height: 10px;font-weight: bold">*** กรุณาเรียกใบเสร็จทุกครั้งที่ชำระเงิน ***</span>
        </div>
        <div style="display: block;float: right;;text-align: right;top: 2px;margin-top: 16px;margin-right: 5px;position: relative">
            <div>
                <span style="font-size: 0.65rem;font-weight: bold;">F-WS-404</span>
                <div style="position: absolute;right: 0" class="underline"></div>
            </div>
            <div style="text-align: right;margin-top: 12px;">
                <span style="font-size: 0.75rem;font-weight: 500;">ใบสั่งขาย - Sales Order</span>
                <div style="position: absolute;right: 0" class="underline"></div>
            </div>
            <div style="margin-top: 6px">
                <span style="font-size: 0.5rem;font-weight: 500;">Page 1 of 1 </span>
            </div>
        </div>
    </div>
    <div style="width: 100%;height: 140px;margin-top: -5px;">
        <div style="float: left;width: 26%;height: 100%;border: 1px solid black;border-radius: 8px">
            <div class="settop" style="width: 95%;height: 5%">
                <div>
                    <span style="font-size:0.6rem;">ชื่อลูกค้า</span> <span style="text-decoration:underline">
                    <span style="font-size:0.6rem;"><?php echo $data['ar_code']; ?></span>
                    <span style="font-size:0.6rem;"><?php echo $data['ar_name']; ?></span>
                    </span>
                </div>  
            </div>
            <div class="settop" style="width: 95%;height: 15%">
                <div style="margin-top: 20px">
                    <div style="width: 10%;float: left;position:relative;top: 6px">
                        <span style="font-size:0.6rem;">ที่อยู่</span>
                    </div>
                    <div style="width: 90%;float: left;word-break:break-word;padding-right: 8px">

                        <span style="position: relative;left: -13px;line-height: 20px;font-size:0.6rem;">
                            <?php echo $data['ar_bill_address']; ?></span>
                    </div>
                </div>
            </div>

            <!-- <div style="margin-top:10px;font-weight: bold;height: 25%">
                <div style="width: 100%;float:left;padding-left:5px;">
                    <span style="font-size:0.6rem;display: block;line-height: 20px">ใบสั่งของลูกค้า</span>
                </div>
            </div> -->
        </div>
        <div style="width: 100%;height: 140px;margin-top: -5px;">
            <div style="margin-left:0.5%;float: left;width: 33%;height: 100%;border: 1px solid black;border-radius: 8px">
                <div class="settop" style="width: 100%;height: 100%">
                    <div style="width: 100%;height: 30%">
                        <div style="width: 32%;float: left;text-align: right">
                            <span style="font-size: 0.6rem;font-weight: bold">ส่งไปที่/Ship to</span>
                        </div>
                        <div style="width: 80%;padding-left: 5px">
                            <span style="font-size: 0.6rem;padding-left: 15px;">
                                <?php echo $data['cus_address']; ?>
                            </span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 14%">
                        <div style="width: 32%;float: left;text-align: right">
                            <span style="font-size:0.6rem;font-weight: bold">ผู้รับสินค้า</span>
                        </div>
                        <div style="width:80%;padding-left: 5px">
                            <span style="font-size:0.6rem;padding-left: 15px;">
                                <?php echo $data['cus_name']; ?>
                            </span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 14%">
                        <div style="width: 32%;float: left;text-align: right">
                            <span style="font-size:0.6rem;font-weight: bold">ผู้ติดต่อ</span>
                        </div>
                        <div style="width:80%;padding-left: 5px">
                            <span style="font-size: 0.6rem;padding-left: 15px;">
                                <?php echo $data['contact']; ?>
                            </span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 14%">
                        <div style="width: 32%;float: left;text-align: right">
                            <span style="font-size: 0.6rem;font-weight: bold">วันที่นัดส่ง</span>
                        </div>
                        <div style="width:80%;padding-left: 5px">
                            <span style="font-size: 0.6rem;padding-left: 15px;">
                                <?php echo $delivery_date ?>
                            </span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 14%">
                        <?php 
                            $is_send;
                            if($data['is_condition_send'] == '0'){
                                $is_send = 'รับเอง';
                            }else{
                                $is_send = 'ส่งให้';
                            }
                        ?>
                        <div style="width: 32%;float: left;text-align: right;">
                            <span style="font-size: 0.6rem;font-weight: bold;"> 
                                เงื่อนไขการออกบิล
                            </span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 14%">
                        <div style="width: 32%;float: left;text-align: right;">
                            <span style="font-size: 0.6rem;font-weight: bold;">
                                วิธีการจัดส่ง    
                            </span>
                        </div>
                        <div style="width: 80%;padding-left:5px;">
                            <span style="font-size: 0.6rem;padding-left:15px;">
                                <?php echo $is_send; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>


            <div style="float: right;width: 40%;height: 100%;border: 1px solid black;border-radius: 8px;position:relative">
                <div style="position: relative;
                    width: 178px;
                    height: 10px;
                    background: white;
                    z-index: 99;
                    top: 51px;">
                </div>
                <svg id="code128"></svg>
                <div class="settop">
                    <div style="height:20%;padding-right: 5px;text-align: right">
                        <span style="font-size: 0.75rem">เลขที่ใบสั่งขาย</span>
                    </div>
                    <div style="height:20%;padding-right: 5px;text-align: right">
                        <span style="font-size: 0.85rem">
                            <?php echo $data['doc_no']; ?>
                        </span>
                    </div>
                    <div style="height:15%;padding-right: 5px;text-align: right;padding-right: 5px">
                        <span style="font-size:0.6rem">วันที่ออกเอกสาร <span style="font-weight:bold;font-size:0.6rem">
                                <?php echo $datenow_datepicker ?></span></span>
                    </div>
                    <div style="height:15%;padding-right: 5px;text-align: right;padding-right: 5px">
                        <span style="font-size:0.6rem">เงื่อนไขการส่งสินค้า <span style="font-weight:bold;font-size:0.6rem">
                                <?php echo $data['credit_day'] ?></span> วัน</span>
                    </div>
                    <div style="height:15%;padding-right: 5px;text-align: right;padding-right: 5px">
                        <span style="font-size:0.6rem">ยืนราคาถึง <span style="font-weight: bold;font-size:0.6rem">
                                <?php echo $due_date ?></span></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="heightproduct" style="width: 100%;border-top: 1px solid black;border-left: 1px solid black;height: 176.77px;border-right: 1px solid black;border-radius: 5px">
            <div style="width: 100%;    height: 25px;border-bottom: 1px solid black">

                <div style="height:100%;float: left;width: 2.5%;border-right: 1px dashed grey;position: relative">
                    <span style="font-size: 0.50rem;position: absolute;left: 50%;transform: translateX(-50%);bottom: 3px;">No</span>

                </div>

                <div style="width: 5.5%;float: left;height: 100%;border-right: 1px dashed grey;position: relative">
                    <span style="font-size: 0.5rem;position: absolute;bottom: 3px;white-space: nowrap;right:2px">คลังชั้นเก็บ</span>
                </div>

                <div style="float:left;width: 18.5%;height: 100%;border-right: 1px dashed grey;position: relative">
                    <span style="font-size: 0.5rem;position: absolute;left: 5px;bottom: 3px">รหัสสินค้า/รายละเอียด</span>
                </div>

                <div style="float: left;width: 6.5%;height: 100%;border-right: 1px dashed grey;position: relative">
                    <span style="font-size: 0.5rem;position: absolute;bottom: 3px;right: 5px">น้ำหนัก(ก.ก)</span>
                </div>

                <div style="float: left;width: 6%;height: 100%;border-right: 1px dashed grey;position: relative">
                    <span style="font-size: 0.5rem;position: absolute;bottom: 3px;right: 9px">Qty ที่สั่ง</span>
                </div>
                <div style="float: left;width: 6.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.5rem;position: absolute;bottom: 3px;right: 5px">ถึงจุดสั่งซื้อ</span>
                </div>
                <div style="float: left;width: 6%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.5rem;position: absolute;bottom: 3px;right: 9px">Onhand</span>
                </div>
                <div style="float: left;width: 8.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.5rem;white-space: nowrap;position: absolute;bottom: 3px;right: 3px">Qtyออกบิล(จอง)</span>
                </div>
                <div style="float: left;width: 6.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.5rem;white-space: nowrap;position: absolute;bottom: 3px;right: 4px">Qty ที่ค้างส่ง</span>
                </div>
                <div style="float: left;width: 5.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.5rem;white-space: nowrap;position: absolute;bottom: 3px;right: 7px">หน่วยนับ</span>
                </div>
                <div style="float: left;width: 7%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.5rem;white-space: nowrap;position: absolute;bottom: 3px;right: 4px">ราคาต่อหน่วย</span>
                </div>
                <div style="float: left;width: 6.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.5rem;white-space: nowrap;position: absolute;bottom: 3px;right: 9px">ราคารวม</span>
                </div>
                <div style="float: left;width: 6.5%;height: 100%;position: relative;border-right: 1px dashed grey;">
                    <span style="font-size: 0.5rem;white-space: nowrap;position: absolute;bottom: 3px;right: 5px">ส่วนลดรวม</span>
                </div>
                <div style="float: left;width: 8%;height: 100%;position: relative;">
                    <span style="font-size: 0.5rem;white-space: nowrap;position: absolute;bottom: 3px;right: 4px">ยอดจองคงเหลือ</span>
                </div>
            </div>

            <div id="counttable" style="width: 100%;height: calc(100% - 25px);border-bottom: 1px solid black;position: relative">

                <div style="position: absolute;width: 2.5%;height: 100%;border-right: 1px dashed grey;">

                </div>
                <div class="table2" style="left: 2.5%;width: 5.5% ;position: absolute;height: 100%;border-right: 1px dashed grey">

                </div>

                <div style="left: 8%;width: 18.5%;height: 100%;border-right: 1px dashed grey;position: absolute">

                </div>
                <div style="left: 26.5%;width: 6.5%;height: 100%;border-right: 1px dashed grey;position: absolute">

                </div>
                <div style="left:33%;width: 6%;height: 100%;border-right: 1px dashed grey;position: absolute">

                </div>
                <div style="left: 39%;width: 6.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 45.5%;width: 6%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 51.5%;width: 8.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 60%;width: 6.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 66.5%;width: 5.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 72%;width: 7%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 79%;width: 6.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 85.4%;width: 6.5%;height: 100%;position: absolute;border-right: 1px dashed grey;">

                </div>
                <div style="left: 92%;width: 8%;height: 100%;position: absolute;">

                </div>

                <?php 
            $count = count($data['subs']);
            $detail = $data['subs'];
            for($i = 0; $i < $count; $i++){

            ?>
                <div style="position: relative;min-height: 20px;width: 100%;float: left">
                    <div style="width: 2.5%;float:left;position: relative;line-height: 20px;text-align: center">
                        <span style="font-size: 0.5rem;">
                            <?php $line = $i + 1; echo $line; ?></span>
                    </div>
                    <div style="width: 5.5%;float:left;position: relative;line-height: 20px;padding-left: 5px">
                        <span style="font-size: 0.5rem;">
                            <?php echo $detail[$i]['wh_code']; ?> /
                            <?php echo $detail[$i]['shelf_code']; ?></span>
                    </div>

                    <div style="width: 18.5%;float:left;position: relative;line-height: 20px;padding-left: 5px">
                     <span style="font-size: 0.5rem;">
                            <?php echo $detail[$i]['item_code']; ?>
                            <?php echo $detail[$i]['item_name']; ?></span>
                    </div>
                    <!-- น้ำหนัก กก.-->
                    <div style="width: 6.5%;float:left;position: relative;line-height: 20px;padding-left: 5px">
                        <span style="font-size: 0.5rem;margin-right: 5px">
                            <?php echo money_format("%!n",2000); ?></span>
                    </div>
                        <!-- QTY -->
                    <div style="width: 6%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.5rem;margin-right: 5px">
                            <?php echo money_format("%!n",$detail[$i]['qty']); ?>
                        </span>
                    </div>
                        <!-- ถึงจุดสั่งซื้อ -->
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.5rem;margin-right: 5px"></span>
                    </div>
                        <!-- onhand --> 
                    <div style="width: 6%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.5rem;margin-right: 5px"></span>
                    </div>
                        <!-- Qtyออกบอล(จอง) -->
                    <div style="width: 8.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.5rem;margin-right: 5px"></span>
                    </div>
                        <!-- Qty ที่ค้างส่ง --> 
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.5rem;margin-right: 5px"></span>
                    </div>
                        <!-- หน่วยนับ --> 
                    <div style="width: 5.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.5rem;margin-right: 5px">
                        <?php echo $detail[$i]['unit_code']; ?>
                        </span>
                    </div>
                        <!-- ราคาต่อหน่วย -->
                    <div style="width: 7%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.5rem;margin-right: 5px">
                        <?php echo money_format("%!n",$detail[$i]['price']); ?>
                        </span>
                    </div>
                        <!-- ราคารวม -->  
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.5rem;margin-right: 5px">
                            
                        </span>
                    </div>
                        <!-- ส่วนลดรวม -->   
                    <div style="width: 6.5%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.5rem;margin-right: 5px">
                         <?php echo money_format("%!n",$detail[$i]['discount_amount']); ?>
                        </span>
                    </div> 
                        <!-- ยอดจองคงเหลือ -->  
                    <div style="width: 8%;float:left;position: relative;text-align: right;line-height: 20px">
                        <span style="font-size: 0.5rem;margin-right: 5px">
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
        <div style="height: 140px;border: 1px solid black;border-radius: 5px">
            <!--            border-right: 1px dashed grey;-->
            <div style="float:left;position: relative;padding-top: 5px;padding-left: 5px;width: 35%;height: 60%;">

                <span style="font-size: 0.65rem;font-weight: bold;white-space: nowrap;line-height: 1.5"><span style="font-size: 0.65rem;font-weight: 100">หมายเหตุ : </span>* สินค้าเหลือน้อย โปรดแจ้ง Section Manager(ขายปลีก) ก่อนนำสินค้าไปขาย</span>
                <span style="font-size: 0.65rem;font-weight: bold;white-space: nowrap;line-height: 1.5;padding-left: 49px;"> * สินค้าสั่งพิเศษ ลูกค้าไม่รับตามกำหนดเกิน 30 วัน จะคิดค่าบริการคลัง 1% ของมูลค่าสินค้า</span>
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

                <div style="width:22%;float: right;height: 60%;position: relative">
                    <div style="width: 100%;height: 25%;position: relative">
                        <div style="width: 55%;text-align: right;position: absolute;bottom: 0;">
                            <span style="position: relative;font-size:0.6rem">ราคาสินค้า</span>
                        </div>
                        <div style="width: 50%;text-align: right;position: absolute;bottom: 0;left: 50%">
                            <span style="position: relative;right: 5px;font-size:0.6rem">
                                <?php echo money_format("%!n", $data['after_discount_amount']);  ?></span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 25%;position: relative">
                        <div style="width: 55%;text-align: right;position: absolute;bottom: 0;">
                            <span style="position: relative;font-size:0.6rem">จำนวนภาษีมูลค่าเพิ่ม</span>
                        </div>
                        <div style="width: 50%;text-align: right;position: absolute;bottom: 0;left: 50%">
                            <span style="position: relative;right: 5px;font-size:0.6rem">
                                <?php echo money_format("%!n",  $data['dif_fee']); ?></span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 25%;position: relative">
                        <div style="width: 55%;text-align: right;position: absolute;bottom: 0;">
                            <span style="position: relative;font-size:0.6rem;">จำนวนเงินทั้งสิ้น</span>
                        </div>
                        <div style="width: 50%;text-align: right;position: absolute;bottom: 0;left: 50%">
                            <span style="position: relative;right:5px;font-size:0.6rem;">
                                <?php echo  money_format("%!n", $data['after_discount_amount']); ?>
                            </span>
                        </div>
                    </div>
                    <div style="width: 100%;height: 25%;position: relative">
                        <div style="width: 55%;text-align: right;position: absolute;bottom: 0;">
                            <span style="position: relative;font-size:0.6rem;">คงค้างชำระ</span>
                        </div>
                        <div style="width: 50%;text-align: right;position: absolute;bottom: 0;left: 50%">
                            <span style="position: relative;right:5px;font-size:0.6rem;">
                                <?php echo  money_format("%!n", $data['after_discount_amount']); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div style="width:18%;float: right;height: 60%;border-right: 1px dashed grey;position: relative;border-left: 1px dashed grey;">
                    <span style="position: absolute;top: 17px;left: 0;white-space: nowrap;font-size:0.6rem">
                        <span style="text-decoration: underline;padding-left: 5px;font-size:0.6rem">หัก</span>
                        ส่วนลดรวม
                    </span>
                    <span style="position: absolute;right: 3px;top: 17px;font-size:0.6rem">
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
                        <span style="position: relative;top: 10px;font-size:0.6rem">ผู้ทำรายการ</span>
                        <span style="bottom: 8px; white-space: nowrap; left: 20px;position: absolute;font-size:0.6rem">
                            <?php echo $data['sale_name'] ?></span>
                    </div>
                    <div style="width:120px;height: 100%;text-align: center;border-right: 1px dashed grey;float: left;position:relative">
                        <span style="position: relative;top: 10px;font-size:0.6rem">ผู้สั่งขาย</span>
                        
                        <span style="bottom: 5px; white-space: nowrap; left: 4px;position: absolute">
                           <?php echo $data['sale_code'] ?>   <?php echo $data['sale_name'] ?></span>
                       
                    </div>

                    <div style="width: 109px;height: 100%;text-align: center;border-right: 1px dashed grey;float: left">

                        <span style="position: relative;top: 10px;font-size:0.6rem">ผู้อนุมัติการขาย</span>
                    </div>


                    <div style="position: relative;width:109px;height: 100%;text-align: center;border-right: 1px dashed grey;float: left">
                        <span style="position: relative;top: 10px;font-size:0.6rem">ลูกค้าเซ็นรับทราบ</span>
                        <span style="bottom: 6px; white-space: nowrap; left: 20px;position: absolute;font-size:0.6rem"> ยืนยันการสั่งซื้อ</span>
                    </div>

                    <div style="width: 240px;height: 100%;text-align: center;float: left">
                        <span style="position: relative;top: 10px;font-size:0.6rem">ตัวอักษร : <span style="font-size:0.6rem" id="thaimoney"></span></span>
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
