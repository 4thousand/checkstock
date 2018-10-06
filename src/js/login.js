import api from "../service/service.js"
import facebookLogin from 'facebook-login-vuejs';
  export default {
    name: "login",
     components: {
        facebookLogin
    },
    data() {
      return {
        loading: false,
        login: {
          id: "",
          password: "",
          value:'9'
        }
      }
    },
    methods: {
      auth() {
        this.loading = true;
        let {id , password} = this.login
        setTimeout(() => {
      api.signin(id,password,
        (result) => {
          // this.cload()
         localStorage.test = this.login.password
         console.log(localStorage.test)
          if (result.status == 'success') {
               console.log(JSON.stringify(result.data))
            localStorage.Datauser = JSON.stringify(result.data)
            this.loading = false;
            this.$router.push("/index");
            alertify.success('Login Success');
          }
        },
        (error) => {
           console.log(error.response.data.message)
          switch (error.response.data.message) {
            case "No Content = UserName Not Active":
              alertify.error('ผู้ใช้ถูกระงับการใช้งาน');
                this.loading = false;
              break;
          case "No Content = UserName or Password Invalid":
              alertify.error('ผู้ใช้ไม่มีสิทธิในแอพนี้หรือรหัสผ่านไม่ถูกต้อง');
                this.loading = false;
              break;
            default:
              this.loading = false;
              break;
          }
          //  alertify.success('Error login');
          // this.cload()
        })
        }, 3000);
      },
      getUserData(val){
        console.log(val)
      },
      logout(val){
        console.log(val)
      },
      onLogout(val){
        console.log(val)
      },
      focuspass(){
        this.$refs.pass.$el.focus()
      },

    },
    mounted() {
   
    }
  }