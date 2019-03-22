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
  
    
  },
  mounted() {
    this.id = this.$route.params.id;
    this.showedit();
  },
};
