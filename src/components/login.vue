<template>
  <div class="login">
    <div class="centered-container">
    <md-content class="md-elevation-3">
        <div class="title">
 
          <div class="md-title">ค้นหาสินค้า</div>
        
        </div>
        <div class="form">
         
             <div class="carddiscount"><md-icon>search</md-icon></div>
            <input @keyup.enter="focuspass" autofocus>
          
  
         
        </div>
       <!-- <div class="actions md-layout md-alignment-center-space-between">
          
          <md-button class="md-raised md-primary" @click="auth">Log in</md-button>
        </div> -->
        <div class="title">
 
          <div class="md-title"><md-button style="background:#ececec;">ค้นหาสินค้า</md-button></div>
        
        </div>
        
      </md-content>
    
    </div>
  </div>
</template>

<script src="../js/login.js"></script>

<style lang="scss" scoped>
 
  .centered-container {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    position: relative !important;
    height: 100vh !important;
    .title {
      text-align: center !important;
      margin-bottom: 30px !important;
      img {
        margin-bottom: 16px !important; 
        max-width: 200px !important;
      }
    }
    .actions {
      .md-button {
        margin: 0 !important;
      }
    }
    .form {
     margin-bottom: 10px !important;
  
      input{
          width: 100%;
    //border: 1px solid #b4b0b0;
    box-shadow: 0 3px 8px 0 rgba(132, 132, 132, 0.2), 0 0 0 1px rgba(0, 0, 0, 0.13);
   //box-shadow: 0 3px 3px -2px rgba(0,0,0,.2), 0 3px 4px 0 rgba(0,0,0,.14), 0 1px 8px 0 rgba(0,0,0,.12);
            width: 100%;
      padding: 9px 12px;
      border-radius: 15px;
    border:0px;
      }
      input:focus{
            width: 100%;
      padding: 9px 12px;
      border-radius: 15px; 
          box-shadow: 0 3px 3px -2px rgba(0,0,0,.2), 0 3px 4px 0 rgba(0,0,0,.14), 0 1px 8px 0 rgba(0,0,0,.12);
         //box-shadow: 0px 0px 1px rgb(151, 150, 150), 0 3px 6px rgba(151, 151, 151, 0.23);
         // box-shadow: 0 3px 8px 0 rgba(0,0,0,0.2), 0 0 0 1px rgba(0,0,0,0.08);
 
      }
       .carddiscount {
  
    color: #fff;
    font-size: 14px;
    padding: 7.7px 10px;
    position: absolute;
    top: 65px;
    right: 2.6%;
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
  .form:focus{
     border:0px;
  }
   
    .background {
      position: absolute !important;
      height: 100% !important;
      width: 100% !important;
      top: 0 !important;
      bottom: 0 !important;
      right: 0 !important;
      left: 0 !important;
      z-index: 0 !important;
    }
    .md-content {
      z-index: 1 !important;
      padding: 10px !important;
      width: 100% !important;
      max-width: 400px !important;
      max-height: 400px !important;
      position: relative !important;
      margin-left: 10px !important;
      margin-right: 10px !important;
    }
    .md-elevation-3 {
    box-shadow: 0 0px 0px 0px rgba(0,0,0,.2), 0 0px 0px 0 rgba(0,0,0,.14), 0 0px 0px 0 rgba(0,0,0,.12);
}
    .loading-overlay {
      z-index: 10 !important;
      top: 0 !important;
      left: 0 !important;
      right: 0 !important;
      position: absolute !important;
      width: 100% !important ;
      height: 100% !important;
      background: rgba(255, 255, 255, 0.9) !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
    }
  }
 
</style>
