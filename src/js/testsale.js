import api from "../service/service.js";
export default {
  name: "testsale",
  data: () => ({
    username: "",
    password: ""
  }),
  methods: {
    login() {
      api.signin(this.username,this.password,
        result => {
          alert(JSON.stringify(result));
        },
        error => {
          alert(JSON.stringify(error.response));
        }
      );
    }
  },
  computed: {
  }
};
