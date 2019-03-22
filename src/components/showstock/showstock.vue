<template>
  <div class="index" style="background: #f4f5f7;">
      <div style="padding-top:130px;">
      <div class="header">
          <div class="headcontent"> 
              <div class="headtitle" style="float:left;">
                  ค้นหาข้อมูลสินค้า
              </div>
              <div class="form" style="float:left;">
         
             <div class="carddiscount"><md-icon>search</md-icon></div>
            <input @keyup.enter="focuspass" autofocus>
          
  
         
        </div>
        </div>
          
      </div>
      <div class="content">
          <div class="title">
  1000174	หน้าต่างบานเลื่อนสลับไวนิลสีขาว+มุ้งลวด+กระจกเขียว 5 มิล 120*110 CM.WindSor
          </div>
    
           <div class="detial">
                     <div class="md-title" style="margin-top:10px;padding:10px;">คงเหลือ</div>
           <md-tab md-label>
            <div class="table-responsive" style="overflow-y: auto;">
              <table class="table table-hover">
                <thead align="center">
                  <tr>
                    <th>ลำดับ</th>
                    <th id="colorselectorder">คลัง</th>
                    <th id="colorselectorder">ที่เก็บ</th>
                    <th id="colorselectorder">จำนวน</th>
                  </tr>
                </thead>
                <tbody id="valuetable">
                   <tr>
                    <th>1</th>
                    <th id="colorselectorder">S1-A</th>
                    <th id="colorselectorder">-</th>
                    <th id="colorselectorder">2121</th>
                  </tr>
                </tbody>
              </table>
            </div>
          </md-tab>
        
          </div>
           <div class="priceitem">
               รายละเอียดสินค้า
           </div>
          
          </div>
      </div>
  </div>
</template>

<script src="../../js/showstock.js">
</script>

<style   lang="scss" scoped src="./showstock.scss">
</style>
