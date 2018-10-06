<template>
  <div id="app">
    <transition name="slide-fade">
      <div v-if="this.$route.path != '/'" class="page-container">
        <div class="page-container md-layout-column">
          <md-toolbar class="md-primary">
            <md-button class="md-icon-button" @click="showNavigation = true">
              <md-icon>menu</md-icon>
            </md-button>
            <span class="md-title">เมนูทั้งหมด</span>
  
            <div class="md-toolbar-section-end">
              <md-button @click="showSidepanel = true">
                <md-icon class="md-size-1x" style="margin-right:10px">account_circle</md-icon>Profile</md-button>
            </div>
          </md-toolbar>
  
          <md-drawer :md-active.sync="showNavigation">
            <md-toolbar class="md-transparent" md-elevation="0">
              <span class="md-title">Menu</span>
            </md-toolbar>
  
            <md-list>
              <md-list-item @click="goindex('/index')">
                <md-icon>home</md-icon>
                <span class="md-list-item-text">หน้าหลัก</span>
              </md-list-item>
              <md-divider></md-divider>
              <md-list-item @click="goindex('/quotation')">
                <md-icon>move_to_inbox</md-icon>
                <span class="md-list-item-text">ใบเสนอราคา</span>
              </md-list-item>
  
              <md-list-item>
                <md-icon>send</md-icon>
                <span class="md-list-item-text">ใบสั่งขาย</span>
              </md-list-item>
  
              <md-list-item>
                <md-icon>delete</md-icon>
                <span class="md-list-item-text">ใบ BackOrder</span>
              </md-list-item>
              <md-divider></md-divider>
              <md-list-item>
                <md-icon>stars</md-icon>
                <span class="md-list-item-text">รายการโปรด</span>
              </md-list-item>
            </md-list>
          </md-drawer>
  
          <md-drawer class="md-right" :md-active.sync="showSidepanel">
            <md-toolbar class="md-transparent" md-elevation="0">
              <md-icon class="md-size-1x" style="position: absolute;
         left: 20px;">account_circle</md-icon>
              <span style="position:absolute;left:43px;" class="md-title">Profile</span>
  
            </md-toolbar>
  
            <md-list>
              <md-avatar style="    min-width: 128px;
        min-height: 128px;" class="md-large">
                <img v-show="pic_path" :src="pic_path" alt="People">
                 <img v-show="!pic_path" src="https://www.ankarsrum.com/wp-content/uploads/2018/01/no-image-icon-.png" alt="People">
                
                  <!-- <img v-show="!pic_path" src="https://www.talokla.com/wp-content/uploads/2018/04/single-lady01.jpg" alt="People"> -->
              </md-avatar>
  
              <div class="md-list-item-content md-ripple md-disabled" style="margin-top:20px">
                <md-icon style="margin-right: 16px;" class="md-primary">chat_bubble</md-icon>
                <span style="white-space: inherit;" class="md-list-item-text">{{name}}</span>
              </div>

               <md-list-item>
                <md-icon style="margin-right: 15px !important;" class="md-primary">build</md-icon>
                <div class="md-list-item-text">
                  <span>{{role}}</span>
                </div>
              </md-list-item>
  
              <md-list-item>
                <md-icon style="margin-right: 15px !important;" class="md-primary">phone</md-icon>
  
                <div class="md-list-item-text">
                  <span>(650) 555-1234</span>
                  <span>Mobile</span>
                </div>
  
  
              </md-list-item>
  
              <md-list-item>
                <md-icon style="margin-right: 15px !important;" class="md-primary">business_center</md-icon>
                <div class="md-list-item-text">
                  <span>{{branchname}}</span>
                </div>
              </md-list-item>
              <md-list-item>
                <md-icon style="margin-right: 15px !important;" class="md-primary">accessibility</md-icon>
                <div class="md-list-item-text">
                  <span>IT</span>
                </div>
              </md-list-item>
              <md-list-item>
                <md-icon style="margin-right: 15px !important;" class="md-primary">code</md-icon>
                <div class="md-list-item-text">
                  <span>{{sale_code}}</span>
                </div>
              </md-list-item>
              <md-list-item>
  
                <md-button to="/" style="position: relative; left: 28px;" class="md-raised md-accent">Logout</md-button>
  
              </md-list-item>
  
  
            </md-list>
          </md-drawer>
  
          <md-content style="background: #f4f5f7;">
            <transition name="slide-fade">
              <router-view/>
            </transition>
          </md-content>
  
        </div>
      </div>
    </transition>
    <!-- login -->
    <transition name="slide-fade">
      <login v-if="this.$route.path == '/'"></login>
    </transition>
  
    <!-- v-show="this.$route.path != '/login'" -->
    <!--  -->
  
  </div>
</template>

<script>
  import Login from "./components/login";
  if (localStorage.Datauser) {
  var Datauser = JSON.parse(localStorage.Datauser)
}
  export default {
    name: "app",
    components: {
      Login
    },
    data: () => ({
      menuVisible: false,
      showSidepanel: false,
      showNavigation: false,
      name:'',
      role:'',
      branchname:'',
      pic_path:'',
      sale_code:''
    }),
    methods: {
      toggleMenu() {
        this.menuVisible = !this.menuVisible;
      },
      test1234() {
        alert("12313");
      },
      goindex(val) {
        this.showNavigation = false
        this.$router.push(val);
      },
        username () {
  			// console.log(localStorage.DataUser)
        var Datauser = JSON.parse(localStorage.Datauser)
           this.name = Datauser.username
           this.role = Datauser.rolename
           this.branchname = Datauser.branch_name
           this.pic_path = Datauser.pic_path
           this.sale_code = Datauser.sale_code
          //  console.log(this.branchname)
        // localStorage.rolename = Datauser.rolename
  	}
    },
    mounted() {
    setInterval(function () {
  		this.username()
    }.bind(this),1000)

    }
  };
</script>

<style lang="scss" scoped>
.md-avatar img {
      width: 108%;
    height: 108%;
}

  span,
  label,
  input,
  h1 {
    font-family: "Kanit", sans-serif !important;
  }
  
  .page-container {
    min-height: 100vh;
    overflow: hidden;
    position: relative;
    // border: 1px solid rgba(#000, 0.12);
  }
  
  // Demo purposes only
  .md-drawer {
    width: 230px;
    max-width: calc(100vw - 125px);
  }
  
  .md-content {
    padding: 16px;
  }
  
  .slide-fade-enter-active {
    transition: all 1s ease;
  }
  
  .slide-fade-enter,
  .slide-fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
  }
</style>

<style>
.md-content {
      height: calc(100vh - 50px);
      overflow: auto;
    }
  .container {
    background-color: white;
    box-shadow: 0 15px 35px rgba(50, 50, 93, 0.03), 0 5px 15px rgba(0, 0, 0, 0.06);
  }
  
  span,
  label,
  input,
  h1,
  .md-title,
  .md-table-head-label,
  .md-table-cell-container,
  p,
  strong,
  .md-button-content,tr td,tr th {
    font-family: "Kanit", sans-serif !important;
  }
  
  * {
    box-sizing: border-box;
  }
</style>

<style lang="scss">
  @import "~vue-material/dist/theme/engine";
  @include md-register-theme( "default", ( primary: md-get-palette-color(blue, A200), / / The primary color of your application accent: md-get-palette-color(orange, A200), / / The accent or secondary color theme: dark / / This can be dark or light));
  @import "~vue-material/dist/theme/all";
</style>
