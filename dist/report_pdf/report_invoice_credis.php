<?php
    $invoiceData=json_decode($_POST['invoice'],true);
    $customerCode=$invoiceData['ar_code'];
    $customerName=$invoiceData['ar_name'];
    $craditDay=$invoiceData['credit_day'];
    $customerAddress=$invoiceData['ar_bill_address'];
    $customerPhone=$invoiceData['ar_telephone'];
    $docno=$invoiceData['doc_no'];
    $orderno=$invoiceData['doc_no'];
   // $cashTTA=$invoiceData['cash_amount'];
    //$creditTTA=$invoiceData['creditcard_amount'];
    //$chqTTA=$invoiceData['chq_amount'];
    //$bankTTA=$invoiceData['bank_amount'];
    $totalPrice=$invoiceData['total_amount'];
    $saleCode=$invoiceData['sale_code'];
    $saleName=$invoiceData['sale_name'];
    $taxRate=$invoiceData['tax_rate'];
//    $calTax=$invoiceData['cal_tax'];
    $priceExtendTax=$totalPrice*(100/(100+$taxRate));
    $tax=$totalPrice-$priceExtendTax;
    $cashTotal=$totalPrice+$tax;

    $duedate=$invoiceData['due_date'];
    /*$cutdatepart=explode('-',$duedate);
    $dueyear=$cutdatepart[0]+543;
    $duemonth=$cutdatepart[1];
    $dueday=$cutdatepart[2];
    $docday=$dueday.'/'.$duemonth.'/'.$dueyear;*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invioce</title>
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
            max-width: 1200px;
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

        .page .underline {
            border-bottom: solid 1px black;
            width: 250px;
            height: 1px;
        }

        .depo_page {
            width: 100%;
            float: left;
            padding: 10px;
        }

        .settop {
            display: block;
            position: relative;
            top: 10px;
            left: 10px
        }

        svg {
            position: absolute !important;
            width: 209px !important;
            height: 69px !important;
            top: 17px !important;
            left: 165px !important;
        }

        .logo_padding {
            position: absolute;
            background: white;
            width: 173px;
            height: 12px;
            left: 171px;
            top: 70px;
            z-index: 20;
        }

        .logo_size {
            width: 132px;
            height: auto;
            position: absolute;
            left: 0;
            top: 0;
        }

        .header {
            position: relative;
        }

        .company_info {
            position: relative;
            width: 66%;
        }

        .info_height {
            line-height: 1.6;
        }

        .company_name {
            font-size: 13px;
            font-weight: bold;
        }

        .company_address {
            font-size: 10px;
            font-weight: inherit;
        }

        .address_padding {
            padding-bottom: 12px;
        }

        .doccument_highlight {
            padding-bottom: 12px;
        }

        .container_img {
            width: 132px;
            height: 60px;
            position: relative;
            float: left;
        }

        .receive_type {
            position: absolute;
            right: 0px;
            top: 0px;
            font-size: 13px;
            font-weight: bold;
            border-style: solid;
            border-width: 1px;
            padding: 18px;
            text-align: center;
            background-color: rgb(199, 196, 196)
        }

        .company_taxpart {
            height: 20px;
        }

        .company_taxinfo {
            font-size: 11px;
            font-weight: inherit;
            margin-left: 3px;
        }

        .doc_info {
            width: 100%;
            height: 100px;
        }

        .customer_info {
            float: left;
            width: 59%;
            height: 95%;
            border: 1px solid black;
            border-radius: 8px;
        }

        .cus_no_space {
            word-spacing: 10px;
        }

        .cus_name_space {
            word-spacing: 16px;
        }

        .cus_add_space {
            word-spacing: 36px;
            line-height: 1.6;
        }

        .cus_add_line {
            line-height: 1.6;
        }

        .deposit_info {
            float: right;
            width: 39%;
            height: 95%;
            border: 1px solid black;
            border-radius: 8px;
        }

        .depo_no {
            word-spacing: 25px;
        }

        .depo_date {
            word-spacing: 8px;
        }

        .order_no {
            word-spacing: 18px
        }

        .table_info {
            float: left;
            width: 100%;
            height: 380px;
            border: 1px solid black;
        }

        .table_total {
            width: 100%;
            height: 25px;
            border-bottom: 1px solid #bbb;
        }

        .total_text {
            float: right;
            width: 30%;
            height: 100%;
            position: relative;
            border-left: 1px solid grey;
        }
        .total_num {
            float: right;
            width: 12%;
            height: 100%;
            border-left: 1px solid grey;
            position: relative;
        }
        
        .table_header {
            width: 100%;
            height: 25px;
            border-bottom: 1px solid black;
            background: #eee
        }

        .sub_header1 {
            float: left;
            width: 6%;
            height: 100%;
            border-right: 1px dashed grey;
            position: relative;
        }

        .sub_header2 {
            float: left;
            width: 36%;
            height: 100%;
            border-right: 1px dashed grey;
            position: relative;
        }

        .sub_header3 {
            float: left;
            width: 9%;
            height: 100%;
            border-right: 1px dashed grey;
            position: relative;       
        }
        .sub_header4 {
            float: left;
            width: 10%;
            height: 100%;
            border-right: 1px dashed grey;
            position: relative;
        }

        .sub_header5{
            float: left;
            width: 8%;
            height: 100%;
            border-right: 1px dashed grey;
            position: relative;
        }
        .sub_header6{
        	float: left;
            width: 12%;
            height: 100%;
            border-right: 1px dashed grey;
            position: relative;
        }

        .sub_header7 {
            float: left;
            width: 7%;
            height: 100%;
            position: relative;
            border-right: 1px dashed grey;
        }

        .sub_header8 {
            float: left;
            width: 12%;
            height: 100%;
            position: relative;
        }

        .notype {
            float: left;
            width: 6%;
            height: 100%;
            position: relative;
            /* border-right: 1px dashed grey; */
        }

        .descript_type  {
            float: left;
            width: 36%;
            height: 100%;
           /* border-right: 1px dashed grey; */
            position: relative;
        }
        .warehouse {
            float: left;
            width: 9%;
            height: 100%;
            /* border-right: 1px dashed grey; */
            position: relative;
        }
        .buy_number {
            float: left;
            width: 10%;
            height: 100%;
            /* border-right: 1px dashed grey; */
            position: relative;
        }
        
        .priceoftype {
            float: left;
            width: 8%;
            height: 100%;
            /* border-right: 1px dashed grey; */
            position: relative;
        }

        .priceoftype_text{
        	float: left;
            width: 10%;
            height: 100%;
            /* border-right: 1px dashed grey; */
            position: relative;
        }

        .price_number {
        	float: left;
            width: 12%;
            height: 100%;
            /* border-right: 1px dashed grey; */
            position: relative;
        }

        .discount {
            float: left;
            width: 7%;
            height: 100%;
            /* border-right: 1px dashed grey; */
            position: relative;
        }
        .totalPrice {
            float: left;
            width: 12%;
            height: 100%;
            /* border-right: 1px dashed grey; */
            position: relative;
        }
        
        .no_header {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            left: 2px;
        }

        .productid_header {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            left: 5px;
            line-height: 13 px;
            
        }

        .area_header,
        .quantity_header,
        .unit_header,
        .price_header {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            float: left;
            width: 100%;
            text-align: center;
        }
        .table_typeofcost {
            width: 100%;
            height: 200px;
            border-bottom: 1px solid #bbb;
        }

        .typeofcost {
            width: 100%;
            height: 30px;
        }

        .descript_type_blank {
            float: left;
            width: 10%;
            height: 100%;
            position: relative;
        }

        .notype_text,
        .descript_type_text {
            position: absolute;
            bottom: 6px;
            font-size: 0.68rem;
            float: left;
            width: 100%;
            text-align: center;
            
        }
        .descript_type_num {
            position: absolute;
            bottom: 6px;
            right:5px;
            font-size: 0.68rem;
            float: left;
            width: 100%;
            text-align: right;
            
        }

        .deposit_product {
            width: 100%;
            height: 25px;
        }

        .depoblank {
            height: 100%;
            float: left;
            width: 5%;
            position: relative;
        }

        .depoblank_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            left: 12px;
        }

        .depo_product {
            float: left;
            width: 51%;
            height: 100%;
            position: relative;
        }

        .depo_product_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            left: 12px;
        }

        .area_info {
            float: left;
            width: 10%;
            height: 100%;
            position: relative;
        }

        .area_info_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            right: 5px;
        }

        .quantity_info {
            float: left;
            width: 10%;
            height: 100%;
            position: relative;
        }

        .quantity_info_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            right: 5px;
        }

        .unit_info {
            float: left;
            width: 10%;
            height: 100%;
            position: relative;
        }

        .unit_info_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            right: 5px;
        }

        .depoblank_last {
            float: left;
            width: 14%;
            height: 100%;
            position: relative;
        }

        .depoblank_last_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            right: 5px;
        }

        .cal_part {
            width: 100%;
            height: 100px;
            border-top: 1px solid #bbb;
            border-bottom: 1px solid #bbb;
        }
        .box_note {
            width: 30%;
            height: 100%;
            float: left;
            position: relative;
        }
        .box_discount {
            width: 30%;
            height: 99px;
            float: left;
            border-left: 1px solid grey;
            border-right: 1px solid grey;
            position: relative;
        }
        .box_dis_des {
            width: 100%;
            height: 25px;
            border-bottom: 1px solid grey;
        }
        .box_deposit {
            float: left;
            width: 60%;
            height: 100%;
            position: relative; 
            bottom:2px;
        }
        .box_numdis {
            float: left;
            width: 50%;
            height: 75px;
            position: relative; 
            border-left: 1px solid grey;

        }
        .box_numdis1 {
            float: left;
            width: 50%;
            height: 75px;
            position: relative; 

        }
        .box_numdis_box {
            float: left;
            width: 100%;
            height: 25px;
            position: relative; 
            top: 5px;
        }
        .box_numdis_box1 {
            float: left;
            width: 100%;
            height: 20px;
            position: relative; 
            top: 6px;
        }
        .box_numdis_text {
            font-size: 0.68rem;
            float: left;
            line-height: 15px;
            width: 100%;
            text-align: center;
        }
        .box_numdis_text_code {
            font-size: 0.6rem;
            float: left;
            line-height: 15px;
            width: 100%;
            text-align: center;
        }
        .box_numdis_text1 {
            font-size: 0.68rem;
            float: left;
            width: 100%;
            text-align: center;
        }
        .box_total {
            width: 40%;
            height: 100%;
            float: left;
            position: relative;
        }
        .b_tax,
        .b_vat,
        .b_total {
            width: 100%;
            height: 25px;
        }

        .one_line {
            float: right;
            width: 40%;
            height: 100%;
            position: relative; 
        }

        .two_line {
            float: right;
            width: 60%;
            height: 100%;
            position: relative;

        }

        .note_line {
            float: left;
            width: 100%;
            height: 40;
            position: relative;
        }
        .note_down {
            float: left;
            width: 100%;
            height: 30;
            position: absolute;
            bottom: 20;
            line-height: 12px;
        }

        .note_line_text {
            font-size: 0.68rem;
            float: left;
            position: absolute ;
            top: 13px;
            left: 4;
        }
        .note_line_text1 {
            font-size: 0.6rem;
            float: left;
            position: absolute ;
            top: 25px;
            left: 4;
            line-height: 1.5;
        }

        .line_dis_text {
            font-size: 0.68rem;
            float: left;
            position: absolute ;
            top: 13px;
            left: 4;
          /*  border-left: 1px solid #bbb;
            border-right: 1px solid #bbb; */
        }
        .one_line_text,
        .two_line_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            right: 5px;
        }

        .final_payment {
            width: 100%;
            height: 80px;
            border-bottom: 1px solid #bbb;
        }

        .cash_payment,
        .check_payment,
        .credit_payment,
        .transfer_payment {
            height: 25%;
            float: left;
            width: 100%;
            position: relative;
        }

        .cash_payment_text,
        .check_payment_text,
        .credit_payment_text,
        .transfer_payment_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            left: 12px;
        }

        .doc_notict {
            width: 100%;
            height: 250px;
            border-bottom: 1px solid #bbb;
        }

        .doc_warning {
            height: 25px;
            float: left;
            width: 100%;
            position: relative;
            margin-top: 20px;
        }

        .doc_warning_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            left: 12px;
            font-weight: bold;
        }

        .other_notict {
            height: 25px;
            float: left;
            width: 100%;
            position: relative;
        }

        .other_notict_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            left: 12px;
        }

        .signature_part {
            width: 100%;
            height: 50px;
        }

        .save_sig,
        .car_sig,
        .employ_sig {
            float: left;
            width: 15%;
            height: 50px;
            border-right: 1px solid grey;
            position: relative;
        }
        
        .depo_sig,
        .receive_sig {
            float: left;
            width: 15%;
            height: 50px;
            border-right: 1px solid grey;
            position: relative;
        }

        .baht_sig{
            float: left;
            width: 25%;
            height: 50px;
            border-right: 1px solid grey;
            position: relative;
        }

        .save_sig_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
        }

        .employ_sig_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
        }

        .depo_sig_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 10px;
            right: 11px;
        }

        .receive_sig_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 10px;
            right: 22px;
        }

        .baht_sig_text {
            font-size: 0.68rem;
            position: absolute;
            top: 8px;
            right: 5px;
        }
    </style>
</head>

<body>
    <div class="depo_page">
        <div class="header">
            <div class="container_img">
                <img src="logo.jpg" class="logo_size" alt="">
            </div>
            <div class="company_info">
                <span class="info_height">
                    <span class="company_name">บริษัท นพดลพานิช จำกัด</span><br>
                    <span class="company_address">
                        392 ถ.เชียงใหม่-ลำปาง ต.ฟ้าฮ่าม อ.เมือง จ.เชียงใหม่ 50000
                        <br>
                        โทร: (053) 240-377 แฟกซ์: (053) 244-411
                    </span>
                </span>
            </div>
            <div class="receive_type">
                <div><span>ต้นฉบับใบกำกับภาษี/ใบส่งสินค้า</span></div>
            </div>
        </div>
        <div class="company_taxpart">
            <span class="company_taxinfo">
                ทะเบียนเลขที่/เลขประจำตัวผู้เสียภาษี 0505533000157 / สำนักงานใหญ่
            </span>
        </div>
        <div class="doc_info">
            <div class="customer_info">
                <div class="settop">
                    <div class="address_padding">
                        <span>เลขประจำตัวผู้เสียภาษี :</span><span class="cus_no_space"> </span><span> 0505533000157</span>
                    </div>
                    <div class="address_padding">
                        <span>ชื่อลูกค้า :</span><span class="cus_name_space"> </span><span><?php echo $customerCode."/".$customerName; ?></span>
                    </div>
                    <div class="address_padding">
                        <span>ที่อยู่ : <span class="cus_add_space"></span><?php echo $customerAddress; ?></span>
                    </div>
                    <div class="address_padding">
                        <span>เบอร์โทร : <span class="cus_add_space"></span><?php echo $customerPhone; ?></span>
                    </div>
                </div>
            </div>
            <div class="deposit_info">
                <div class="settop">
                    <div class="address_padding">
                        <span>เลขที่เอกสาร :</span><span class="depo_no"> </span><span><?php echo $docno; ?></span>
                    </div>
                    <div class="address_padding">
                        <span>วันที่ออกเอกสาร :</span><span class="depo_date"> </span><span><?php echo $docday ?></span>
                    </div>
                    <div class="address_padding">
                        <span>วันที่กำหนดชำระ :</span><span class="order_no"> </span><span><?php echo $docday; ?></span>
                    </div>
                    <div class="address_padding">
                        <span>เครดิต :</span><span class="order_no"> </span><span><?php echo $craditDay; ?> วัน</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="table_info">
            <div class="table_header">
                <div class="sub_header1">
                    <span class="no_header">ลำดับ</span>
                </div>
                <div class="sub_header2">
                    <span class="productid_header">รหัสสินค้า/รายละเอียด</span>
                </div>
                <div class="sub_header3">
                    <span class="quantity_header">คลัง</span>
                </div>
                <div class="sub_header5">
                    <span class="unit_header">หน่วย</span>
                </div>
                <div class="sub_header4">
                    <span class="quantity_header">จำนวน</span>
                </div>
                <div class="sub_header6">
                    <span class="unit_header">ราคา/หน่วย</span>
                </div>
                <div class="sub_header7">
                    <span class="price_header">ส่วนลด</span>
                </div>
                <div class="sub_header8">
                    <span class="price_header">จำนวนเงิน</span>
                </div>                
            </div>

            <div class="table_typeofcost">
                <!-- วนลูป -->
            <?php 
            $count = count($invoiceData['subs']);
            $detail = $invoiceData['subs'];
            for($i = 0; $i < $count; $i++){

            ?>               
                <div class="typeofcost">
                    <div class="notype">
                        <span class="notype_text"><?php $line = $i + 1; echo $line; ?></span>
                    </div>
                    <div class="descript_type">
                        <span class="descript_type_text"><?php echo $detail[$i]['item_code']; ?>/<?php echo $detail[$i]['item_name']; ?></span>
                    </div>
                    <div class="warehouse">
                        <span class="descript_type_text"><?php echo $detail[$i]['location']; ?></span>
                    </div>
                    <div class="priceoftype">
                        <span class="descript_type_text"><?php echo $detail[$i]['unit_code']; ?></span>
                    </div>
                    <div class="buy_number">
                        <span class="descript_type_num"><?php echo $detail[$i]['qty']; ?></span>
                    </div>
                    <div class="price_number">
                        <span class="descript_type_num"><?php echo $detail[$i]['amount']; ?></span>
                    </div>
                    <div class="discount">
                        <span class="descript_type_num"><?php echo $detail[$i]['discount_word_sub']; ?></span>
                    </div>
                    <div class="totalPrice">
                    
                        <span class="descript_type_num"><?php echo $detail[$i]['price']; ?></span>
                    </div>
                </div>
              <?php  } ?>
                <!-- วนลูป -->
            </div>
            <!--<div class="table_total">
                    <div class="total_num">
                        <span class="descript_type_num">1,000.00</span>
                    </div>
                    <div class="total_text">
                        <span class="descript_type_text">รวมทั้งสิ้น</span>
                    </div>
            </div>-->

            <!-- วนลูป -->
            <!-- <div class="deposit_product">
                <div class="depoblank">
                    <span class="depoblank_text"></span>
                </div>
                <div class="depo_product">
                    <span class="depo_product_text">2002006
                        <span>ท่อ PVC ชั้น 8.5 ขนาด 2"</span>
                    </span>
                </div>
                <div class="area_info">
                    <span class="area_info_text">S1-B/-</span>
                </div>
                <div class="quantity_info">
                    <span class="quantity_info_text">100</span>
                </div>
                <div class="unit_info">
                    <span class="unit_info_text">ท่อน</span>
                </div>
                <div class="depoblank_last">
                    <span class="depoblank_last_text"></span>
                </div>
            </div> -->
            <!-- <div class="deposit_product">
                <div class="depoblank">
                    <span class="depoblank_text"></span>
                </div>
                <div class="depo_product">
                    <span class="depo_product_text">2002006
                        <span>ท่อ PVC ชั้น 8.5 ขนาด 2"</span>
                    </span>
                </div>
                <div class="area_info">
                    <span class="area_info_text">S1-B/-</span>
                </div>
                <div class="quantity_info">
                    <span class="quantity_info_text">100</span>
                </div>
                <div class="unit_info">
                    <span class="unit_info_text">ท่อน</span>
                </div>
                <div class="depoblank_last">
                    <span class="depoblank_last_text"></span>
                </div>
            </div> -->

            <!-- วิธีการชำระเงิน -->
            <!--<div class="final_payment">
                <!--<div class="cash_payment">
                    <span class="cash_payment_text"><p style='margin-top:5px'>ชำระโดย :</p></span>
                </div>
                <?php
                    /*if($cashTTA>0){
                        echo "<div class='cash_payment'><span class='cash_payment_text'>เงินสด : ",number_format((float)$cashTTA,2,'.',''),"</span></div>";
                    }
                    if($creditTTA>0){
                        echo "<div class='cash_payment'><span class='cash_payment_text'>บัตรเครดิต : ",number_format((float)$creditTTA,2,'.',''),"</span></div>";
                    }
                    if($chqTTA>0){
                        echo "<div class='cash_payment'><span class='cash_payment_text'>เช็ค : ",number_format((float)$chqTTA,2,'.',''),"</span></div>";
                    }
                    if($bankTTA>0){
                        echo "<div class='cash_payment'><span class='cash_payment_text'>เงินโอน : ",number_format((float)$bankTTA,2,'.',''),"</span></div>";
                    }*/
                ?>
            </div> -->
            
            <div class="cal_part">
                <div class="box_note">
                    <div class="b_tax">
                        <span class="note_line_text">หมายเหตุ :</span>
                        <span class="note_line_text1">*แก้ไขเปลี่ยนแปลงภายใน 7 วันเท่านั้น<br>
                        	*สินค้าทำพิเศษไม่รับคืน<br>
                        	*บริการจัดส่งสินค้าถึงหน้างาน บริเวณที่รถเข้าถึงได้สะดวก<br>
                        	*โดยไม่รวมบริการจัดเก็บให้</span>

                    </div>
                </div>
                <div class="box_discount">
                    <div class="box_dis_des">
                        <div class="one_line">
                            <span class="one_line_text">0.00</span>
                        </div>
                        <div class="box_deposit">
                            <span class="line_dis_text"><u>หัก</u>  ส่วนลดรวม</span>
                        </div>
                    </div>
                    <div class="box_numdis1">
                        <div class="box_numdis_box">
                            <span class="box_numdis_text">ใบมัดจำเลขที่</span>
                        </div>
                        <div class="box_numdis_box1">
                            <span class="box_numdis_text_code">S01-IDM6112-0522</span>
                        </div>
                    </div>
                    <div class="box_numdis">
                        <div class="box_numdis_box">
                            <span class="box_numdis_text">มูลค่าเงินมัดจำ</span>
                        </div>
                        <div class="box_numdis_box1">
                            <span class="box_numdis_text1">0.00</span>
                        </div>
                    </div>        
                </div>
                <div class="box_total">
                    <div class="b_tax">
                        <div class="one_line">
                            <span class="one_line_text"><?php echo $totalPrice; ?></span>
                        </div>
                        <div class="two_line">
                            <span class="two_line_text">รวมมูลค่าสินค้า</span>
                        </div>
                    </div>
                    <div class="b_vat">
                        <div class="one_line">
                            <span class="one_line_text"><?php echo $tax; ?></span>
                        </div>
                        <div class="two_line">
                            <span class="two_line_text">ภาษีมูลค่าเพิ่ม (บาท) อัตรา <?php echo $taxRate; ?>%</span>
                        </div>
                    </div>
                    <div class="b_total">
                        <div class="one_line">
                            <span class="one_line_text"><?php echo $cashTotal; ?></span>
                        </div>
                        <div class="two_line">
                            <span class="two_line_text">รวมเงินทั้งสิ้น</span>
                        </div>
                    </div>
                </div>
            </div>

            <!--
            <div class="doc_notict">
                <div class="doc_warning">
                    <span class="doc_warning_text">***
                        เอกสารนี้ ไม่สามารถเบิกจ่ายสินค้าได้ ***</span>
                </div>
                <div class="other_notict">
                    <span class="other_notict_text">*
                        กรณีชำระด้วยเช็ค บริษัทจะส่งสินค้าให้เมื่อเช็คผ่านเข้าบัญชีบริษัทแล้ว</span>
                </div>
                <div class="other_notict">
                    <span class="other_notict_text">*
                        กรุณานำใบรับเงินมัดจำนี้มาแสดงเมื่อมารับสินค้าที่บริษัทฯ ทุกครั้ง</span>
                </div>
                <div class="other_notict">
                    <span class="other_notict_text">*
                        แก้ไขหรือเปลี่ยนแปลงใบกำกับภาษีภายใน 7 วันเท่านั้น</span>
                </div>
                <div class="other_notict">
                    <span class="other_notict_text">*
                        ค่าบริการฝากสินค้า 30 วัน คิด 1% ของราคาสินค้า</span>
                </div>
                <div class="other_notict">
                    <span class="other_notict_text">*
                        สินค้าพิเศษไม่รับคืน หรือแลกเปลี่ยน เงินรับมัดจำนี้บริษัทสงวนสิทธิ์ในการไม่คืน
                        หากมีการยกเลิก</span>
                </div>
                <div class="other_notict">
                </div>
                <div class="other_notict">
                </div>
            </div>
            -->
            
            
            <div class="signature_part">
                <div class="save_sig">
                    <span class='save_sig_text' style='top:8px;'></span>
                    <span class="employ_sig_text">ผู้จัดส่ง</span>
                </div>
                <div class="car_sig">
                    <span class='save_sig_text' style='top:8px;'></span>
                    <span class="employ_sig_text">ทะเบียนรถ</span>
                </div>
                <div class="employ_sig">
                    <span class='save_sig_text' style='top:8px;'></span>
                    <span class="employ_sig_text">ผู้บันทึกรายการ</span>
                </div>
                <div class="depo_sig">
                    <span class='save_sig_text' style='top:8px;'><?php echo $saleCode."/".$saleName; ?></span>
                    <span class="employ_sig_text">พนักงานขาย</span>
                </div>
                <div class="receive_sig">
                    <span class='save_sig_text' style='top:8px;'></span>
                    <span class="employ_sig_text">ผู้รับสินค้า</span>
                </div>
                <div class="baht_sig">
                    <span class='save_sig_text' style='top:8px;'></span>
                    <span class="employ_sig_text">ผู้รับเงิน</span>
                </div>
            </div>
        </div>
    </div>

    <!-- หน้า 2 -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="convertthaimoney.js"></script>
    <script>
        var thaiBaht="<?php echo $totalPrice ?>";
        thaiBaht=ArabicNumberToText(thaiBaht)
        document.getElementById("showThaiBaht").innerHTML = thaiBaht;
        document.getElementById("copyShowThaiBaht").innerHTML = thaiBaht;
    </script>
</body>

</html>
