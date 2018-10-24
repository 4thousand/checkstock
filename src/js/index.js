import api from "../service/service.js"

export default {
  name: 'quotation',
  data () {
    return {
     msg:'',
     star:true,
     Search:'',
     sale_code:JSON.parse(localStorage.Datauser),
     dataall:[],
     keyword_showalldoc:'',
    }
  },
  methods: {
    changeColor () {
      alert('sadasd')
    },
    seedetail(val){
        console.log(JSON.stringify(val))
        
        this.$router.push({ name : 'quotation', params : { id: val.id}});
    },
    showalldoc () {
        var payload = {
            sale_code : this.sale_code.sale_code,
            keyword: this.keyword_showalldoc
        }
        // v
        console.log(JSON.stringify(payload))
        api.showdocall(payload,
            (result) => {
            console.log(JSON.stringify(result.data))
               this.dataall = result.data
            },
            (error) => {
               console.log(JSON.stringify(error))
               alertify.error('Data ข้อมูลผิดพลาด');
              //  alertify.success('Error login');
              // this.cload()
            })
    },
  },
  mounted () {
      this.showalldoc()
    // console.log(JSON.stringify(this.payload))
  }
}
