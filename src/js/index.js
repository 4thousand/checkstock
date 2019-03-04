import api from "../service/service.js"

export default {
  name: 'quotation',
  data() {
    return {
      msg: '',
      star: true,
      Search: '',
      sale_code: JSON.parse(localStorage.Datauser),
      dataall: [],
      keyword_showalldoc: '',
    }
  },
  methods: {
    changeColor() {
      alert('sadasd')
    },
    convertToBaht(val) {
      var result = numeral(val).format("0,0.00");
      // console.log(typeof result)
      return result;
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
        this.$router.push({ name: "newquotation", params: { id: 0 } });
        return;
      }

      this.$router.push(val);
    },
    seedetail(val) {
      console.log(JSON.stringify(val))

      this.$router.push({ name: 'quotation', params: { id: val.id } });
    },
    showalldoc() {
      var payload = {
        sale_code: this.sale_code.sale_code,
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
        })
    },
  },
  mounted() {
    this.showalldoc()
    // console.log(JSON.stringify(this.payload))
  }
}
