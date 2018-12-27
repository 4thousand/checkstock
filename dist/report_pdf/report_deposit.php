<?php
    $depositData=json_decode($_POST[])
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deposit</title>
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
            width: 50%;
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
            height: 550px;
            border: 1px solid black;
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
            position: relative
        }

        .sub_header2 {
            float: left;
            width: 50%;
            height: 100%;
            border-right: 1px dashed grey;
            position: relative;
        }

        .sub_header3,
        .sub_header4,
        .sub_header5 {
            float: left;
            width: 10%;
            height: 100%;
            border-right: 1px dashed grey;
            position: relative
        }

        .sub_header6 {
            float: left;
            width: 14%;
            height: 100%;
            position: relative
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
        }

        .area_header,
        .quantity_header,
        .unit_header,
        .price_header {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            right: 5px
        }

        .typeofcost {
            width: 100%;
            height: 25px;
            border-bottom: 1px solid black;
        }

        .notype {
            height: 100%;
            float: left;
            width: 5%;
            position: relative;
        }

        .descript_type {
            float: left;
            width: 51%;
            height: 100%;
            position: relative;
        }

        .descript_type_blank {
            float: left;
            width: 10%;
            height: 100%;
            position: relative;
        }

        .priceoftype {
            float: left;
            width: 14%;
            height: 100%;
            position: relative;
        }

        .notype_text,
        .descript_type_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            left: 12px;
        }

        .priceoftype_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 3px;
            right: 5px;
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
            height: 80px;
            border-top: 1px solid #bbb;
            border-bottom: 1px solid #bbb;
        }

        .b_tax,
        .b_vat,
        .b_total {
            width: 100%;
            height: 25px;
        }

        .one_line {
            float: right;
            width: 14%;
            height: 100%;
            position: relative;
        }

        .two_line {
            float: right;
            width: 30%;
            height: 100%;
            position: relative;
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
            height: 100px;
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
            height: 200px;
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
            height: 70px;
        }

        .save_sig,
        .employ_sig,
        .depo_sig,
        .receive_sig {
            float: left;
            width: 16%;
            height: 70px;
            border-right: 1px solid grey;
            position: relative;
        }

        .baht_sig {
            float: left;
            width: 36%;
            height: 70px;
            position: relative;
        }

        .save_sig_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 10px;
            left: 4px;
        }

        .employ_sig_text {
            font-size: 0.68rem;
            position: absolute;
            bottom: 10px;
            left: 11px;
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
                <div><span>ใบเสร็จรับเงิน/</span></div>
                <br>
                <div><span>ใบรับเงินมัดจำ/ใบกำกับภาษี</span></div>
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
                        <span>รหัสลูกค้า :</span><span class="cus_no_space"> </span><span>ddd</span>
                    </div>
                    <div class="address_padding">
                        <span>ชื่อลูกค้า :</span><span class="cus_name_space"> </span><span>ddd</span>
                    </div>
                    <div class="address_padding">
                        <span>ที่อยู่ :<span class="cus_add_space"> </span>ddddddddddddddd</span>
                    </div>
                </div>
            </div>
            <div class="deposit_info">
                <div class="settop">
                    <div class="address_padding">
                        <span>เลขที่เอกสาร :</span><span class="depo_no"> </span><span>sss</span>
                    </div>
                    <div class="address_padding">
                        <span>วันที่ออกเอกสาร :</span><span class="depo_date"> </span><span>sss</span>
                    </div>
                    <div class="address_padding">
                        <span>เลขที่ใบสั่งจอง :</span><span class="order_no"> </span><span>sss</span>
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
                    <span class="area_header">คลัง</span>
                </div>
                <div class="sub_header4">
                    <span class="quantity_header">จำนวน</span>
                </div>
                <div class="sub_header5">
                    <span class="unit_header">หน่วย</span>
                </div>
                <div class="sub_header6">
                    <span class="price_header">จำนวนเงิน</span>
                </div>
            </div>
            <!-- อาจจะวนลูป -->
            <div class="typeofcost">
                <div class="notype">
                    <span class="notype_text">1.</span>
                </div>
                <div class="descript_type">
                    <span class="descript_type_text">เงินรับมัดจำเพื่อเป็นค่าสินค้านี้</span>
                </div>
                <div class="descript_type_blank">
                    <span></span>
                </div>
                <div class="descript_type_blank">
                    <span></span>
                </div>
                <div class="descript_type_blank">
                    <span></span>
                </div>
                <div class="priceoftype">
                    <span class="priceoftype_text">5,348.00</span>
                </div>
            </div>
            <!-- วนลูป -->
            <div class="deposit_product">
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
            </div>
            <div class="deposit_product">
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
            </div>
            

            <div class="cal_part">
                <div class="b_tax">
                    <div class="one_line">
                        <span class="one_line_text">4998.13</span>
                    </div>
                    <div class="two_line">
                        <span class="two_line_text">จำนวนเงินก่อนภาษี
                            (บาท)</span>
                    </div>
                </div>
                <div class="b_vat">
                    <div class="one_line">
                        <span class="one_line_text">349.87</span>
                    </div>
                    <div class="two_line">
                        <span class="two_line_text">ภาษีมูลค่าเพิ่ม
                            (บาท) อัตรา 7%</span>
                    </div>
                </div>
                <div class="b_total">
                    <div class="one_line">
                        <span class="one_line_text">5,348.00</span>
                    </div>
                    <div class="two_line">
                        <span class="two_line_text">รวมเงินทั้งสิ้น
                            (บาท)</span>
                    </div>
                </div>
            </div>

            <!-- วิธีการชำระเงิน -->
            <div class="final_payment">
                <div class="cash_payment">
                    <span class="cash_payment_text">ชำระโดย
                        : เงินโอน <span>5,348.00</span>
                    </span>
                </div>
            </div>
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
            </div>

            <div class="signature_part">
                <div class="save_sig">
                    <span class="save_sig_text">ผู้บันทึกรายการ</span>
                </div>
                <div class="employ_sig">
                    <span class="employ_sig_text">พนักงานขาย</span>
                </div>
                <div class="depo_sig">
                    <span class="depo_sig_text">ผู้มัดจำสินค้า</span>
                </div>
                <div class="receive_sig">
                    <span class="receive_sig_text">ผู้รับเงิน</span>
                </div>
                <div class="baht_sig">
                    <span class="baht_sig_text">ห้าพันสามร้อยสี่สิบแปดบาทถ้วน</span>
                </div>
            </div>
        </div>
    </div>

    <!-- หน้า 2 -->
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
                <div><span>สำเนา ใบเสร็จรับเงิน/</span></div>
                <br>
                <div><span>ใบรับเงินมัดจำ/ใบกำกับภาษี</span></div>
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
                        <span>รหัสลูกค้า :</span><span class="cus_no_space"> </span><span>ddd</span>
                    </div>
                    <div class="address_padding">
                        <span>ชื่อลูกค้า :</span><span class="cus_name_space"> </span><span>ddd</span>
                    </div>
                    <div class="address_padding">
                        <span>ที่อยู่ :<span class="cus_add_space"> </span>ddddddddddddddd</span>
                    </div>
                </div>
            </div>
            <div class="deposit_info">
                <div class="settop">
                    <div class="address_padding">
                        <span>เลขที่เอกสาร :</span><span class="depo_no"> </span><span>sss</span>
                    </div>
                    <div class="address_padding">
                        <span>วันที่ออกเอกสาร :</span><span class="depo_date"> </span><span>sss</span>
                    </div>
                    <div class="address_padding">
                        <span>เลขที่ใบสั่งจอง :</span><span class="order_no"> </span><span>sss</span>
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
                    <span class="area_header">คลัง</span>
                </div>
                <div class="sub_header4">
                    <span class="quantity_header">จำนวน</span>
                </div>
                <div class="sub_header5">
                    <span class="unit_header">หน่วย</span>
                </div>
                <div class="sub_header6">
                    <span class="price_header">จำนวนเงิน</span>
                </div>
            </div>
            <!-- อาจจะวนลูป -->
            <div class="typeofcost">
                <div class="notype">
                    <span class="notype_text">1.</span>
                </div>
                <div class="descript_type">
                    <span class="descript_type_text">เงินรับมัดจำเพื่อเป็นค่าสินค้านี้</span>
                </div>
                <div class="descript_type_blank">
                    <span></span>
                </div>
                <div class="descript_type_blank">
                    <span></span>
                </div>
                <div class="descript_type_blank">
                    <span></span>
                </div>
                <div class="priceoftype">
                    <span class="priceoftype_text">5,348.00</span>
                </div>
            </div>
            <!-- วนลูป -->
            <div class="deposit_product">
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
            </div>
            <div class="deposit_product">
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
            </div>

            <div class="cal_part">
                <div class="b_tax">
                    <div class="one_line">
                        <span class="one_line_text">4998.13</span>
                    </div>
                    <div class="two_line">
                        <span class="two_line_text">จำนวนเงินก่อนภาษี
                            (บาท)</span>
                    </div>
                </div>
                <div class="b_vat">
                    <div class="one_line">
                        <span class="one_line_text">349.87</span>
                    </div>
                    <div class="two_line">
                        <span class="two_line_text">ภาษีมูลค่าเพิ่ม
                            (บาท) อัตรา 7%</span>
                    </div>
                </div>
                <div class="b_total">
                    <div class="one_line">
                        <span class="one_line_text">5,348.00</span>
                    </div>
                    <div class="two_line">
                        <span class="two_line_text">รวมเงินทั้งสิ้น
                            (บาท)</span>
                    </div>
                </div>
            </div>

            <!-- วิธีการชำระเงิน -->
            <div class="final_payment">
                <div class="cash_payment">
                    <span class="cash_payment_text">ชำระโดย
                        : เงินโอน <span>5,348.00</span>
                    </span>
                </div>
            </div>
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
            </div>

            <div class="signature_part">
                <div class="save_sig">
                    <span class="save_sig_text">ผู้บันทึกรายการ</span>
                </div>
                <div class="employ_sig">
                    <span class="employ_sig_text">พนักงานขาย</span>
                </div>
                <div class="depo_sig">
                    <span class="depo_sig_text">ผู้มัดจำสินค้า</span>
                </div>
                <div class="receive_sig">
                    <span class="receive_sig_text">ผู้รับเงิน</span>
                </div>
                <div class="baht_sig">
                    <span class="baht_sig_text">ห้าพันสามร้อยสี่สิบแปดบาทถ้วน</span>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="convertthaimoney.js"></script>
</body>

</html>