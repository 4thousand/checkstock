import api from "../service/service.js";
import Loading from "vue-loading-overlay";
export default {
  name: "showstock",
  data() {
    return {

      fax: "",
    };
  },
  components: {
    Loading,
  },
  methods: {
    testcallapi() {
      let payload = {
        id: 11
      }
      api.testcallapi(payload,
        (result) => {
          this.isLoading = false
          console.log(JSON.stringify(result))

        },
        (error) => {
          this.isLoading = false
          console.log(JSON.stringify(error))
          alertify.error('Data ข้อมูลการจัดสรรผิดพลาด');
        })
    }

  },
  mounted() {
    this.id = this.$route.params.id;
    this.testcallapi();
  },
};
