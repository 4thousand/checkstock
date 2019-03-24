<template>
  <div class="index" style="background: #f4f5f7;">
    <div class="body">
      <div class="header">
        <div class="headcontent">
          <div class="headtitle">ค้นหาข้อมูลสินค้า</div>
          <div class="form">
            <input @keyup.enter="focuspass" autofocus>
            <div class="carddiscount">
              <md-icon>search</md-icon>
            </div>
          </div>
        </div>
        <div class="count">จำนวนสินค้าที่ค้นพบ</div>
      </div>
      <div class="content">
        <div class="box">
           <div class="boxid">ลำดับ</div>
          <div class="boxtitle">รหัสสินค้า</div>
          <div class="boxname">ชื่อสินค้า</div>
          <div class="boxunit">หน่วยนับ</div>
         <div class="boxgrade">เกรด</div>
         <div class="boxstatus">สถานะ</div>
        </div>
          <div class="box">
           <div class="boxid">ลำดับ</div>
          <div class="boxtitle">000114</div>
          <div class="boxname">[p] ก๊อกน้ำโปรโมชั่น</div>
          <div class="boxunit">ตัว</div>
         <div class="boxgrade">c</div>
         <div class="boxstatus">special Order</div>
        </div>
          <div class="box">
           <div class="boxid">ลำดับ</div>
          <div class="boxtitle">รหัสสินค้า</div>
          <div class="boxname">ชื่อสินค้า</div>
          <div class="boxunit">หน่วยนับ</div>
         <div class="boxgrade">เกรด</div>
         <div class="boxstatus">สถานะ</div>
        </div>
          <div class="box">
           <div class="boxid">ลำดับ</div>
          <div class="boxtitle">รหัสสินค้า</div>
          <div class="boxname">ชื่อสินค้า</div>
          <div class="boxunit">หน่วยนับ</div>
         <div class="boxgrade">เกรด</div>
         <div class="boxstatus">สถานะ</div>
        </div>
        
      </div>
    </div>
  </div>
</template>
 

<style lang="scss" scoped>
.box {
  float: left;
  width: 100%;
  /* height: 60px; */
  background-color: #f3f3f3;
  padding: 10px;
  
  box-shadow: 0px 0px 1px rgb(236, 236, 236),
    0 3px 6px rgba(151, 151, 151, 0.23);
  font-size: large;
    .boxid {
    width: 5%;
    float: left;
  }
  .boxtitle {
    width: 15%;
    float: left;
  }
  .boxname {
    width: 45%;
    float: left;
  }
  .boxunit {
    width: 10%;
    float: right;
  }
    .boxgrade {
    width: 5%;
    float: right;
  }
  .boxstatus {
    width: 15%;
    float: right;
  }
}

.index {
  height: 100vh !important;
}
.body {
  padding-top: 55px;
}
.content {
  margin: 20px auto;
  width: 100%;

  height: auto;
  background-color: hsl(0, 0%, 100%);

  display: table;

  box-shadow: 0px 0px 1px rgb(236, 236, 236),
    0 3px 6px rgba(151, 151, 151, 0.23);
  padding: 0 10px;
  .detailcontent {
    width: 100%;
    justify-content: flex-end;
    min-height: 100%;
    max-height: 100%;
    display: flex;
  }
  .title {
    padding: 10px;
    font-size: 1.4em;
    width: 100%;
    background-color: hsl(0, 0%, 100%);
  }
  .detial {
    width: 48%;
    // box-shadow:0px 0px 1px rgb(236, 236, 236), 0 3px 6px rgba(151, 151, 151, 0.23);
    float: left;
    height: auto;
  }
  .priceitem {
    width: 50%;

    padding: 10px;
    float: right;
    box-shadow: 0px 0px 1px rgb(236, 236, 236),
      0 3px 6px rgba(151, 151, 151, 0.23);
  }
}
.header {
  background-color: hsl(0, 0%, 100%);
  height: auto;

  box-shadow: 0px 0px 1px rgb(236, 236, 236),
    0 3px 6px rgba(151, 151, 151, 0.23);

  color: #000000;
  box-sizing: border-box;
  left: 0;
  right: 0;
  position: fixed;
  text-align: center;
  top: 0;
  z-index: 1;
  .count{
    width: 100%;
  }
}
.headcontent {
  width: 100%;
  height: 100%;
  margin: 0 auto;
  padding: 20px 10px 0 0;
  .headtitle {
    text-align: left;
    font-size: 2em;
    width: auto;
    padding: 10px;
    float: left;
  }
}
.form {
  margin-bottom: 10px !important;
  margin: 0 auto;
  width: 500px;
  position: relative;
  float: left;
  input {
    width: 470px;
    background-color: rgb(139, 138, 138);
    //border: 1px solid #b4b0b0;
    box-shadow: 0 3px 8px 0 rgba(132, 132, 132, 0.2),
      0 0 0 1px rgba(0, 0, 0, 0.13);
    //box-shadow: 0 3px 3px -2px rgba(0,0,0,.2), 0 3px 4px 0 rgba(0,0,0,.14), 0 1px 8px 0 rgba(0,0,0,.12);

    padding: 9px 12px;

    border: 0px;
  }
  input:focus {
    width: 470px;
    padding: 9px 12px;
    background-color: rgb(255, 255, 255);
    box-shadow: 0 3px 3px -2px rgba(0, 0, 0, 0.2),
      0 3px 4px 0 rgba(0, 0, 0, 0.14), 0 1px 8px 0 rgba(0, 0, 0, 0.12);
    //box-shadow: 0px 0px 1px rgb(151, 150, 150), 0 3px 6px rgba(151, 151, 151, 0.23);
    // box-shadow: 0 3px 8px 0 rgba(0,0,0,0.2), 0 0 0 1px rgba(0,0,0,0.08);
  }
  .carddiscount {
    color: #fff;
    font-size: 14px;
    padding: 7.7px 10px;
    position: absolute;
    top: 0px;
    right: 3%;
    /* border-radius: 50%; */
    border-radius: 0 15px 15px 0;
    /* border-right: 15px; */
    /* border-bottom-right-radius: 20px; */
    /* border-bottom-left-radius: 20px; */
    /* opacity: 0.7; */
    -webkit-transition: opacity 0.25s ease-in-out;
    transition: opacity 0.25s ease-in-out;
  }
}
@media (max-width: 1150px) {
  .body {
    padding-top: 100px;
  }
  .headcontent {
    width: 60%;
    height: 100%;
    margin: 0 auto;
    padding: 10px;
    .headtitle {
      text-align: center;
      font-size: 2em;
      width: 100%;
      padding: 10px;
      float: none;
    }
    .form {
      margin-top: 10px;
      margin-bottom: 10px !important;
      width: 100%;
      float: none;

      input {
        width: 100%;
        //border: 1px solid #b4b0b0;
        box-shadow: 0 3px 8px 0 rgba(132, 132, 132, 0.2),
          0 0 0 1px rgba(0, 0, 0, 0.13);
        //box-shadow: 0 3px 3px -2px rgba(0,0,0,.2), 0 3px 4px 0 rgba(0,0,0,.14), 0 1px 8px 0 rgba(0,0,0,.12);
        width: 100%;
        padding: 9px 12px;
        border-radius: 15px;
        border: 0px;
      }
      input:focus {
        width: 100%;
        padding: 9px 12px;
        border-radius: 15px;
        box-shadow: 0 3px 3px -2px rgba(0, 0, 0, 0.2),
          0 3px 4px 0 rgba(0, 0, 0, 0.14), 0 1px 8px 0 rgba(0, 0, 0, 0.12);
        //box-shadow: 0px 0px 1px rgb(151, 150, 150), 0 3px 6px rgba(151, 151, 151, 0.23);
        // box-shadow: 0 3px 8px 0 rgba(0,0,0,0.2), 0 0 0 1px rgba(0,0,0,0.08);
      }
      .carddiscount {
        color: #fff;
        font-size: 14px;
        padding: 7.5px 10px;
        position: absolute;
        background: #fff;
        top: -2%;
        right: 0%;
        /* border-radius: 50%; */
        border-radius: 0 15px 15px 0;
        /* border-right: 15px; */
        /* border-bottom-right-radius: 20px; */
        /* border-bottom-left-radius: 20px; */
        /* opacity: 0.7; */
        -webkit-transition: opacity 0.25s ease-in-out;
        transition: opacity 0.25s ease-in-out;
      }
    }
  }
}
</style>
