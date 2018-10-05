const toLower = text => {
    return text.toString().toLowerCase();
  };
  
  const searchByName = (items, term) => {
    if (term) {
      return items.filter(item => toLower(item.name).includes(toLower(term)));
    }
    return items;
  };
  import Datepicker from 'vuejs-datepicker';
  import * as lang from "vuejs-datepicker/src/locale";

  export default {
    name: "quotation",
    components: {
      Datepicker
    },
    data: () => ({
      msg: "",
      selectedDate: null,
      date: "",
      search: [],
      search: null,
      test:localStorage.test,
      users: [{
          id: "0000290",
          name: "พาเวอร์ปลั๊ก ตัวเมีย 3 ขา 16 A ต่อตรงกลาง HT-213 / PT-213",
          count: "อัน/อัน",
          amount: 1.0,
          price: 80.0,
          discount: "443",
          allprice: 289751.0,
          because: "รับเอง"
        },
        {
          id: "8852439012978",
          name: "คอบสันโค้งเซรามิค FLATO สีศิลเวอร์เกรย์",
          count: "แผ่น/แผ่น",
          amount: 51.0,
          price: 280.0,
          discount: "334",
          allprice: 14280.0,
          because: "ส่งให้"
        },
        {
          id: "8852439013296",
          name: "ครอบตะเข้ส้นเซรามิค FLATO สีซิลเวอร์เกรย์",
          count: "แผ่น/แผ่น",
          amount: 51.0,
          price: 280.0,
          discount: "33",
          allprice: 49280.0,
          because: "รับเอง"
        },
        {
          id: "8852439013012",
          name: "ครอบปิดปลายตะเข้สันเซรามิค FLATO สีซิลเวอร์เกรย์",
          count: "แผ่น/แผ่น",
          amount: 16.0,
          price: 310.0,
          discount: "33",
          allprice: 4960.0,
          because: "รับเอง"
        },
        {
          id: "8852439007677",
          name: "การเส้น EXCELLA",
          count: "กล่อง/กล่อง",
          amount: 2.0,
          price: 290.0,
          discount: "33",
          allprice: 580.0,
          because: "รับเอง"
        },
        {
          id: "88524390153597",
          name: "แผ่นรองเชิงชายตราช้าง / Excella",
          count: "ม้วน/ม้วน",
          amount: 4.0,
          price: 350.0,
          discount: "",
          allprice: 1400.0,
          because: "รับเอง"
        },
        {
          id: "88524390155397",
          name: "แผ่นรองเชิงชายตราช้าง / Excella",
          count: "ม้วน/ม้วน",
          amount: 4.0,
          price: 350.0,
          discount: "",
          allprice: 1400.0,
          because: "รับเอง"
        },
        {
          id: "8852439015597",
          name: "แผ่นรองเชิงชายตราช้าง / Excella",
          count: "ม้วน/ม้วน",
          amount: 4.0,
          price: 350.0,
          discount: "",
          allprice: 1400.0,
          because: "รับเอง"
        },
        {
          id: "88524390154597",
          name: "แผ่นรองเชิงชายตราช้าง / Excella",
          count: "ม้วน/ม้วน",
          amount: 4.0,
          price: 350.0,
          discount: "",
          allprice: 1400.0,
          because: "รับเอง"
        },
        {
          id: "88524390155597",
          name: "แผ่นรองเชิงชายตราช้าง / Excella",
          count: "ม้วน/ม้วน",
          amount: 4.0,
          price: 350.0,
          discount: "",
          allprice: 1400.0,
          because: "รับเอง"
        },
        {
          id: "88524390115597",
          name: "แผ่นรองเชิงชายตราช้าง / Excella",
          count: "ม้วน/ม้วน",
          amount: 4.0,
          price: 350.0,
          discount: "",
          allprice: 1400.0,
          because: "รับเอง"
        }
      ],
      active: 'first',
      first: false,
      second: false,
      third: false,
      secondStepError: null,
      language: "th",
      languages: lang,
    }),
    methods: {
      test1234() {
        alert("12313");
      },
      newUser() {
        window.alert("Noop");
      },
      searchOnTable() {
        this.searched = searchByName(this.users, this.search);
      },
      tests() {
        alert("ค้นหาข้อมูล Waiting ...");
      },
      setDone(id, index) {
        this[id] = true
        this.secondStepError = null
        if (index) {
          this.active = index
        }
        document.getElementsByClassName("md-content")[0].scrollTop = 0
      }
    },
    created() {
      this.searched = this.users;
    },
    computed: {
      firstDayOfAWeek: {
        get() {
          return this.$material.locale.firstDayOfAWeek;
        },
        set(val) {
          this.$material.locale.firstDayOfAWeek = val;
        }
      }
    },
    mounted() {
        // data:('3')
      console.log(localStorage.test)
    console.log(this.test)
      // this.$refs.testDiv.scrollTop = 0;
      // console.log(this.loading)
    }
  };