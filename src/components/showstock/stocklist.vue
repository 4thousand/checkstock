<template>
  <div class="index" style="background: #f4f5f7;">
    <div class="body">
      <div class="header">
        <div class="headcontent">
          <div class="headtitle">ค้นหาข้อมูลสินค้า</div>
          <div class="form">
            <input @keyup.enter="showstocklist" v-model="search" autofocus>
            <div class="carddiscount">
              <md-icon>search</md-icon>
            </div>
          </div>
        </div>
        <div class="box" style="padding-left:20px">
          <div class="boxid">ลำดับ</div>
          <div class="boxtitle">รหัสสินค้า</div>
          <div class="boxname">ชื่อสินค้า</div>
          <div class="boxunit">หน่วยนับ</div>
          <div class="boxgrade">เกรด</div>
          <div class="boxstatus">สถานะ</div>
        </div>
      </div>
      <div class="content">
        <div
          class="box"
          v-for="(val,index) in dataall"
          :key="index"
          @click="seedetail(val)"
          v-if="index >=pagesleft && index <=pagesright"
        >
          <div class="boxid">{{index+1}}</div>
          <div class="boxtitle">{{val.itemcode}}</div>
          <div class="boxname">&nbsp;&nbsp;&nbsp;&nbsp;{{val.itemname}}</div>
          <div class="boxunit">{{val.UnitCode}}</div>
          <div class="boxgrade">{{val.Mygrade}}</div>
          <div class="boxstatus">{{val.itemstatus}}</div>
        </div>
        <div
          class="text-xs-center"
          style="    width: 80%;
    margin: 0 auto;"
          v-if="dataall.length != 0"
        >
          <v-pagination v-model="pagination.page" :length="pages" class="para"></v-pagination>
        </div>
      </div>
    </div>
  </div>
</template>
 

<script>
import api from "../../service/service.js";

export default {
  name: "showstocklist",
  components: {},
  data() {
    return {
      dataall: [],
      search: "",

      pagination: {
        page: 1,
        rowsPerPage: 20
      }
    };
  },
  computed: {
    pages() {
      return this.pagination.rowsPerPage
        ? Math.ceil(this.dataall.length / this.pagination.rowsPerPage)
        : 0;
    },
    pagesleft() {
      if (this.pagination.page == 1) {
        return 0;
      }
      return (this.pagination.page - 1) * this.pagination.rowsPerPage;
    },
    pagesright() {
      return this.pagination.page * this.pagination.rowsPerPage;
    }

    // listFilter() {
    //   return this.dataall.filter(post => {
    //     if (post.doc_no.toLowerCase().includes(this.searched.toLowerCase())) {
    //       return post.doc_no
    //         .toLowerCase()
    //         .includes(this.searched.toLowerCase());
    //     } else if (
    //       post.ar_code.toLowerCase().includes(this.searched.toLowerCase())
    //     ) {
    //       return post.ar_code
    //         .toLowerCase()
    //         .includes(this.searched.toLowerCase());
    //       sale_name;
    //     } else if (
    //       post.ar_name.toLowerCase().includes(this.searched.toLowerCase())
    //     ) {
    //       return post.ar_name
    //         .toLowerCase()
    //         .includes(this.searched.toLowerCase());
    //     } else if (
    //       post.sale_name.toLowerCase().includes(this.searched.toLowerCase())
    //     ) {
    //       return post.sale_name
    //         .toLowerCase()
    //         .includes(this.searched.toLowerCase());
    //     }
    //   });
    // }
  },
  methods: {
    seedetail(val) {
      this.$router.push({ name: "showstock", params: { id: val.itemcode } });
    },
    showstocklist() {
      if (this.search == "") {
        this.$router.push({ name: "login" });
        return;
      }
      this.pagination.page = 1;
      let payload = {
        keyword: this.search
      };
      api.showstocklist(
        payload,
        result => {
          this.isLoading = false;
          console.log(JSON.stringify(result));
          this.dataall = result.data;
        },
        error => {
          this.isLoading = false;
          console.log(JSON.stringify(error));
          alertify.error("Data ข้อมูลการจัดสรรผิดพลาด");
        }
      );
    }
  },
  mounted() {
    this.docnoid = this.$route.params.id;
    this.search = this.$route.params.id;
    console.log(this.docnoid);
    if (this.docnoid == "" || this.docnoid == 0 || this.docnoid == null) {
      this.$router.push({ name: "login" });
      return;
    }
    if (this.dataall.length > 0) {
      this.dataall = [];
    }
    let payload = {
      keyword: this.docnoid
    };
    api.showstocklist(
      payload,
      result => {
        this.isLoading = false;
        console.log(JSON.stringify(result));
        this.dataall = result.data;
      },
      error => {
        this.isLoading = false;
        console.log(JSON.stringify(error));
        alertify.error("Data ข้อมูลการจัดสรรผิดพลาด");
      }
    );
  }
};
</script>
<style lang="scss" scoped>
.para {
  button :active {
    color: #000000;
    background: #000000;
  }
}

.box {
  float: left;
  width: 100%;
  /* height: 60px; */
  background-color: #ffffff;
  padding: 10px;
  margin-bottom: 1px;
  margin-top: 1px;
  box-shadow: inset 0 -1px 0 0 rgba(100, 121, 143, 0.122);
  font-size: large;
  .boxid {
    width: 5%;
    float: left;
    text-align: center;
  }
  .boxtitle {
    width: 15%;
    float: left;
    text-align: center;
  }
  .boxname {
    width: 45%;
    float: left;
  }
  .boxunit {
    width: 10%;
    float: left;
    text-align: center;
  }
  .boxgrade {
    width: 5%;
    float: left;
    text-align: center;
  }
  .boxstatus {
    width: 15%;
    float: right;
    text-align: center;
  }
}
.box:hover {
  -webkit-box-shadow: inset 1px 0 0 #dadce0, inset -1px 0 0 #dadce0,
    0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
  box-shadow: inset 1px 0 0 #dadce0, inset -1px 0 0 #dadce0,
    0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
  z-index: 1;
}

.index {
}
.body {
  padding-top: 88px;
}
.content {
  margin: 20px auto;
  width: 100%;

  height: auto;
  background-color: hsl(0, 0%, 100%);

  display: table;

  box-shadow: 0px 0px 1px rgb(236, 236, 236),
    0 3px 6px rgba(151, 151, 151, 0.23);
  padding: 0 10px;
  .detailcontent {
    width: 100%;
    justify-content: flex-end;
    min-height: 100%;
    max-height: 100%;
    display: flex;
  }
  .title {
    padding: 10px;
    font-size: 1.4em;
    width: 100%;
    background-color: hsl(0, 0%, 100%);
  }
  .detial {
    width: 48%;
    // box-shadow:0px 0px 1px rgb(236, 236, 236), 0 3px 6px rgba(151, 151, 151, 0.23);
    float: left;
    height: auto;
  }
  .priceitem {
    width: 50%;

    padding: 10px;
    float: right;
    box-shadow: 0px 0px 1px rgb(236, 236, 236),
      0 3px 6px rgba(151, 151, 151, 0.23);
  }
}
.header {
  background-color: hsl(0, 0%, 100%);
  height: auto;

  box-shadow: 0px 0px 1px rgb(236, 236, 236),
    0 3px 6px rgba(151, 151, 151, 0.23);

  color: #000000;
  box-sizing: border-box;
  left: 0;
  right: 0;
  position: fixed;
  text-align: center;
  top: 0;
  z-index: 1;
  .count {
    width: 100%;
  }
}
.headcontent {
  width: 100%;
  height: 100%;
  margin: 0 auto;
  padding: 20px 10px 0 0;
  .headtitle {
    text-align: left;
    font-size: 2em;
    width: auto;
    padding: 10px;
    float: left;
  }
}
.form {
  margin-bottom: 10px !important;
  margin: 0 auto;
  width: 500px;
  position: relative;
  float: left;
  input {
    width: 470px;
    background-color: #e0e0e0;
    //border: 1px solid #b4b0b0;
    box-shadow: 0 3px 8px 0 rgba(132, 132, 132, 0.2),
      0 0 0 1px rgba(0, 0, 0, 0.13);
    //box-shadow: 0 3px 3px -2px rgba(0,0,0,.2), 0 3px 4px 0 rgba(0,0,0,.14), 0 1px 8px 0 rgba(0,0,0,.12);

    padding: 9px 12px;

    border: 0px;
  }
  input:focus {
    width: 470px;
    padding: 9px 12px;
    background-color: rgb(255, 255, 255);
    box-shadow: 0 3px 3px -2px rgba(0, 0, 0, 0.2),
      0 3px 4px 0 rgba(0, 0, 0, 0.14), 0 1px 8px 0 rgba(0, 0, 0, 0.12);
    //box-shadow: 0px 0px 1px rgb(151, 150, 150), 0 3px 6px rgba(151, 151, 151, 0.23);
    // box-shadow: 0 3px 8px 0 rgba(0,0,0,0.2), 0 0 0 1px rgba(0,0,0,0.08);
  }
  .carddiscount {
    color: #fff;
    font-size: 14px;
    padding: 7.7px 10px;
    position: absolute;
    top: 0px;
    right: 3%;
    /* border-radius: 50%; */
    border-radius: 0 15px 15px 0;
    /* border-right: 15px; */
    /* border-bottom-right-radius: 20px; */
    /* border-bottom-left-radius: 20px; */
    /* opacity: 0.7; */
    -webkit-transition: opacity 0.25s ease-in-out;
    transition: opacity 0.25s ease-in-out;
  }
}
@media (max-width: 1150px) {
  .body {
    padding-top: 150px;
  }
  .headcontent {
    width: 60%;
    height: 100%;
    margin: 0 auto;
    padding: 10px;
    .headtitle {
      text-align: center;
      font-size: 2em;
      width: 100%;
      padding: 10px;
      float: none;
    }
    .form {
      margin-top: 10px;
      margin-bottom: 10px !important;
      width: 100%;
      float: none;

      input {
        width: 100%;
        //border: 1px solid #b4b0b0;
        box-shadow: 0 3px 8px 0 rgba(132, 132, 132, 0.2),
          0 0 0 1px rgba(0, 0, 0, 0.13);
        //box-shadow: 0 3px 3px -2px rgba(0,0,0,.2), 0 3px 4px 0 rgba(0,0,0,.14), 0 1px 8px 0 rgba(0,0,0,.12);
        width: 100%;
        padding: 9px 12px;
        border-radius: 15px;
        border: 0px;
      }
      input:focus {
        width: 100%;
        padding: 9px 12px;
        border-radius: 15px;
        box-shadow: 0 3px 3px -2px rgba(0, 0, 0, 0.2),
          0 3px 4px 0 rgba(0, 0, 0, 0.14), 0 1px 8px 0 rgba(0, 0, 0, 0.12);
        //box-shadow: 0px 0px 1px rgb(151, 150, 150), 0 3px 6px rgba(151, 151, 151, 0.23);
        // box-shadow: 0 3px 8px 0 rgba(0,0,0,0.2), 0 0 0 1px rgba(0,0,0,0.08);
      }
      .carddiscount {
        color: #fff;
        font-size: 14px;
        padding: 7.5px 10px;
        position: absolute;
        background: #fff;
        top: -1.4%;
        right: 0%;
        /* border-radius: 50%; */
        border-radius: 0 15px 15px 0;
        /* border-right: 15px; */
        /* border-bottom-right-radius: 20px; */
        /* border-bottom-left-radius: 20px; */
        /* opacity: 0.7; */
        -webkit-transition: opacity 0.25s ease-in-out;
        transition: opacity 0.25s ease-in-out;
      }
    }
  }
}
</style>
