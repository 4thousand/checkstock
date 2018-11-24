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
            // var userid = 
           // localStorage.branchid = result.data.branch_id
            localStorage.userid = result.data.id
            localStorage.company_id = result.data.company_id
            // localStorage.user = result.data.usercode
            this.loading = false;
            this.$router.push("/index");
            alertify.success('Login Success');
          }
        },
        (error) => {
           this.login = {}
       
          alertify.error('เกิดข้อผิดพลาด')   
           this.loading = false;
           setTimeout(() => {
          switch (error.response.data.message) {
            case "No Content = UserName Not Active":
              alertify.error('ผู้ใช้ถูกระงับการใช้งาน');
              break;
          case "No Content = UserName or Password Invalid":
              alertify.error('ผู้ใช้ไม่มีสิทธิในแอพนี้หรือรหัสผ่านไม่ถูกต้อง');
              break;
            default:
              this.loading = false;
              break;
          }
        }, 3000);
    
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