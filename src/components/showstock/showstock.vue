<template>
  <div class="index" style="background: #f4f5f7;">
    <div style="padding-top:130px;">
      <div class="header">
        <div class="headcontent">
          <div class="headtitle">ค้นหาข้อมูลสินค้า</div>
          <div class="form">
            <div class="carddiscount">
              <md-icon>search</md-icon>
            </div>
            <input @keyup.enter="focuspass" autofocus>
          </div>
        </div>
      </div>
      <div class="content">
        <div
          class="title"
        >1000174 หน้าต่างบานเลื่อนสลับไวนิลสีขาว+มุ้งลวด+กระจกเขียว 5 มิล 120*110 CM.WindSor</div>
        <div class="detailcontent">
          <div class="detial">
            <div class="md-title" style="margin-top:10px;padding:10px;">คงเหลือ</div>
            <md-tab md-label>
              <div class="table-responsive" style="overflow-y: auto;">
                <table class="table table-hover">
                  <thead align="center">
                    <tr>
                      <th id="colorselectorder">คลัง</th>
                      <th id="colorselectorder">ที่เก็บ</th>
                      <th id="colorselectorder">จำนวน</th>
                      <th id="colorselectorder">หน่วยนับ</th>
                    </tr>
                  </thead>
                  <tbody id="valuetable">
                    <tr>
                      <th id="colorselectorder">S1-A</th>
                      <th id="colorselectorder">-</th>
                      <th id="colorselectorder">2121</th>
                      <th id="colorselectorder">หน่วยนับ</th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </md-tab>
            <div>
              <div class="md-title" style="padding:10px;">รวมสินค้าคงเหลือ</div>
              <div style="width:100%;padding:10px;background-color: rgb(191, 190, 190);float:left;">
                <label>S01</label>
                <label style="float:right;font-size:1em;">50 บาท</label>
              </div>
              <div style="width:100%;padding:10px;background-color: rgb(191, 190, 190);float:left;">
                <label>S02</label>
                <label style="float:right;font-size:1em;">50 บาท</label>
              </div>
              <div
                style="width:100%;padding:10px;background-color: rgb(191, 190, 190);;float:left;"
              >
                <label>รวมสินค้าคงเหลือทั้งหมด</label>

                <label style="float:right;font-size:1em;">50 บาท</label>
              </div>
            </div>
          </div>
          <div class="priceitem">
            <div class="md-title" style="padding:10px;">ราคาสินค้า</div>
            <div
              style="width:100%;height:50px;paddin:10px;;margin-top: 10px;background-color: rgb(191, 190, 190);"
            >
              ราคาเงินสด
              <br>
              <label style="margin-left:50%;font-size:1.5em;">50 บาท</label>
            </div>
            <div
              style="width:100%;height:50px;paddin:10px;margin-top: 10px;background-color: rgb(191, 190, 190);"
            >
              ราคาเงินเชื่อ
              <br>
              <label style="margin-left:50%;font-size:1.5em;">50 บาท</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="../../js/showstock.js">
</script>

<style   lang="scss" scoped src="./showstock.scss">
</style>
