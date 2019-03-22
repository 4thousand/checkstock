<template>
  <div id="app">
    <transition name="slide-fade">
      <div v-if="this.$route.path != '/'">
        
              <router-view/>
           
          
        
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
  var Datauser = JSON.parse(localStorage.Datauser);
}
export default {
  name: "app",
  components: {
    Login
  },
  data: () => ({
    userPermission: JSON.parse(localStorage.Datauser),
    menuVisible: false,
    showSidepanel: false,
    showNavigation: false,
    name: "",
    topicmenu: "หน้าหลัก",
    role: "",
    branchname: "",
    pic_path: "",
    icon: "",
    sale_code: "",
    company_name: "",
    permission: "",
    selectedEmployee: null
  }),
  created() {
    this.changetopicmenu();
  },
  watch: {
    $route: "changetopicmenu"
  },
  methods: {
    changetopicmenu() {
      //  alert(this.$route.fullPath.search("quotation"))
      if (this.$route.fullPath.search("quolist") == 1) {
        this.topicmenucolor = "green";
        this.topicmenu = "ใบเสนอราคา";
        this.icon = "move_to_inbox";
      }
      if (this.$route.fullPath.search("index") == 1) {
        this.topicmenucolor = "#448aff";
        this.topicmenu = "หน้าหลัก";
        this.icon = "home";
      }
      if (this.$route.fullPath.search("settinglist") == 1) {
        this.topicmenucolor = "#ff9100";
        this.topicmenu = "Setting";
        this.icon = "build";
      }
      if (this.$route.fullPath.search("setting") == 1) {
        this.topicmenucolor = "#ff9100";
        this.topicmenu = "Setting";
        this.icon = "build";
      }
      if (this.$route.fullPath.search("solist") == 1) {
        this.topicmenucolor = "#795548";
        this.topicmenu = "ใบสั่งขาย";
        this.icon = "send";
      }
      if (this.$route.fullPath.search("saleorder") == 1) {
        this.topicmenucolor = "#795548";
        this.topicmenu = "ใบสั่งขาย";
        this.icon = "bookmark_border";
      }if (this.$route.fullPath.search("salehistory") == 1) {
        this.topicmenucolor = "#795548";
        this.topicmenu = "ประวัติการขาย";
        this.icon = "bookmark_border";
      }
      if (this.$route.fullPath.search("invoice") == 1) {
        this.topicmenucolor = "#6c7b94";
        this.topicmenu = "ใบออกบิลขาย";
        this.icon = "bookmark_border";
      }
      if (this.$route.fullPath.search("deposit") == 1) {
        this.topicmenucolor = "#f4c2sd";
        this.topicmenu = "ใบรับเงินมัดจำ";
        this.icon = "assignment";
      }
      if (this.$route.fullPath.search("depositlist") == 1) {
        this.topicmenucolor = "#f4c20d";
        this.topicmenu = "ใบรับเงินมัดจำ";
        this.icon = "assignment";
      }
      if (this.$route.fullPath.search("prototype") == 1) {
        this.topicmenucolor = "#f4c20d";
        this.topicmenu = "ใบรับเงินมัดจำ";
        this.icon = "assignment";
      }
      if (this.$route.fullPath.search("sms") == 1) {
        this.topicmenucolor = "red";
        this.topicmenu = "ระบบ SMS";
        this.icon = "sms";
      }
    },
    toggleMenu() {
      this.menuVisible = !this.menuVisible;
    },
    goindex(val) {
      // localStorage.iddocno = 0
      this.showNavigation = false;

      if (val == "/depositlist") {
        this.$router.push({ name: "depositlist" });
        return;
      }

      if (val == "/sale") {
        this.$router.push({ name: "newsale", params: { id: 0 } });
        return;
      }

      if (val == "/invoicelist") {
        this.$router.push({ name: "invoicelist", params: { id: 0 } });
        return;
      }

      if (this.$route.fullPath.search("newsale") == 1) {
        this.topicmenucolor = "#795548";
        this.topicmenu = "สร้าง ใบสั่งขาย";
        this.icon = "bookmark_border";
      }

      if (this.$route.fullPath.search("newsaleorder") == 1) {
        this.topicmenucolor = "#795548";
        this.topicmenu = "สร้าง ใบสั่งขาย (ทดสอบ)";
        this.icon = "bookmark_border";
      }
    },
    toggleMenu() {
      this.menuVisible = !this.menuVisible;
    },
    goindex(val) {
      // localStorage.iddocno = 0
      this.showNavigation = false;

      if (val == "/sale") {
        this.$router.push({ name: "newsale", params: { id: 0 } });
        return;
      }

      if (val == "/saleorder") {
        this.$router.push({ name: "newsaleorder", params: { id: 0 } });
        return;
      }

      if (val == "/quotation") {
        // this.topicmenu = 'ใบเสนอราคา'
        this.$router.push({ name: "newquo", params: { id: 0 } });
        return;
      }

      this.$router.push(val);
    },
    username() {
      // console.log(localStor/age.Datauser)
      var Datauser = JSON.parse(localStorage.Datauser);
      this.name = Datauser.username;
      this.role = Datauser.rolename;
      this.branchname = Datauser.branch_name;
      this.pic_path = Datauser.pic_path;
      this.sale_code = Datauser.sale_code;
      this.company_name = Datauser.company_name;
      //  console.log(this.branchname)
      // localStorage.rolename = Datauser.rolename
    }
  },
  mounted() {
    setInterval(
      function() {
        this.username();
      }.bind(this),
      1000
    );
    console.log(JSON.parse(localStorage.Datauser))
  }
};
</script>

<style lang="scss" scoped>
.search {
  max-width: 500px;
}
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
.md-button-content,
tr td,
tr th {
  font-family: "Kanit", sans-serif !important;
}

* {
  box-sizing: border-box;
}
</style>

<style lang="scss">
@import "~vue-material/dist/theme/engine";
@include md-register-theme(
  "default",
  (
    primary: md-get-palette-color(blue, A200),
  )
);
@import "~vue-material/dist/theme/all";
</style>
