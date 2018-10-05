<template>
  <div class="login">
    <div class="centered-container">
      <md-content class="md-elevation-3">
        <div class="title">
          <img style="width:300px;height:100px;" src="../assets/nopadol.jpg">
          <div class="md-title">Nopadol</div>
          <div class="md-body-1">© 2014 Nopadol Panich Co., Ltd. All Rights Reserved</div>
        </div>
        <div class="form">
          <md-field>
            <label>Username</label>
            <md-input v-model="login.id" autofocus></md-input>
          </md-field>
  
          <md-field md-has-password>
            <label>Password</label>
            <md-input @keyup.enter="auth" v-model="login.password" type="password"></md-input>
          </md-field>
        </div>
  
        <div class="actions md-layout md-alignment-center-space-between">
          <a href="/resetpassword">Reset password</a>
          <md-button class="md-raised md-primary" @click="auth">Log in</md-button>
        </div>
  
        <div class="loading-overlay" v-if="loading">
          <md-progress-spinner md-mode="indeterminate" :md-stroke="2"></md-progress-spinner>
        </div>
  
      </md-content>
      <div class="background" />
       <!-- <facebook-login class="button"
      appId="326022817735322"
      @login="getUserData"
      @logout="onLogout"
      @get-initial-status="getUserData">
    </facebook-login> -->
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
      margin-bottom: 60px !important;
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
      padding: 40px !important;
      width: 100% !important;
      max-width: 400px !important;
      max-height: 510px !important;
      position: relative !important;
      margin-left: 10px !important;
      margin-right: 10px !important;
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
