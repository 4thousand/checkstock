import api from "../service/service.js";
import Loading from "vue-loading-overlay";
export default {
  name: "setting",
  data() {
    return {
      id: "",
      confirmDialog: false,
      msg: "",
      star: true,
      Search: "",
      setting_saleType: "",
      setting_feeType: "",
      setting_taxRate: 7.0,
      isLoading: false,
      company_id: "",
      branch_id: "",
      tax_type: "",
      tax_rate: "",
      logo_path: "",
      tax_type: "",
      depart_id: "",
      def_sale_wh_id: "",
      def_sale_shelf_id: "",
      def_buy_wh_id: "",
      stock_status: "",
      sale_tax_type: "",
      buy_tax_type: "",
      sale_bill_type: "",
      buy_bill_type: "",
      use_address: "",
      pos_def_cust_id: "",
      pos_def_stock: "",
      def_cust_id: "",
      create_by: "",
      create_time: "",
      edit_by: "",
      edit_time: "",
      branch_name: "",
      address: "",
      telephone: "",
      fax: "",
    };
  },
  components: {
    Loading,
  },
  methods: {
    showedit() {
      /*if (this.id == 0) {
        // alert('หนักหลัก')
        return;
      }*/
      // alert('แก้ไข')
      // แก้ไข

      console.log("id = ",this.id)
      let payload = {
        id: parseInt(this.id)
      };
      this.isLoading = true;
      console.log(payload);
      api.showSetting(
        payload,
        result => {
          this.isLoading = false;
          console.log(JSON.stringify(result.data));
          //console.log(JSON.stringify(result.length.data));
          // this.dproducts = []
          //this.id = id;
          this.company_id = result.data.company_id;
          this.branch_id = result.data.branch_id;
          this.tax_type = result.data.tax_type;

          this.tax_rate = result.data.tax_rate;
          this.logo_path = result.data.logo_path;
          this.taxtype = result.data.tax_type;
          this.depart_id = result.data.depart_id;
          this.def_sale_wh_id = result.data.def_sale_wh_id;
          this.def_sale_shelf_id = result.data.def_sale_shelf_id;
          this.def_buy_wh_id = result.data.def_buy_wh_id;
          this.def_buy_shelf_id  = result.data.def_buy_shelf_id;
          this.stock_status = result.data.stock_status;
          this.sale_tax_type = result.data.sale_tax_type;
          this.buy_tax_type = result.data.buy_tax_type;
          this.sale_bill_type = result.data.sale_bill_type;
          this.buy_bill_type = result.data.buy_bill_type;
          this.use_address = result.data.use_address;
          this.pos_def_cust_id = result.data.pos_def_cust_id;
          this.pos_def_stock = result.data.pos_def_stock;
          this.def_cust_id = result.data.def_cust_id;
          this.create_by = result.data.create_by;
          this.create_time = result.data.create_time;
          this.edit_by = result.data.edit_by;
          this.edit_time = result.data.edit_time;
          this.branch_name =  result.data.branch_name;
          this.address = result.data.address;
          this.telephone = result.data.telephone;
          this.fax = result.data.fax;
        },
        error => {
          this.isLoading = false
          console.log(JSON.stringify(error))
          alertify.error('ข้อมูลเกิดข้อผิดพลาด');
      }
      );
    },
    setdone(id){
      console.log("id = ",this.id)
      let payload = {
        /*req.CompanyId,
        req.BranchId,
        req.TaxType,
        req.TaxRate,
        req.LogoPath,
        req.DepartId,
        req.DefSaleWhId,
        req.DefSaleShelfId,
        req.DefBuyWhId,
        req.DefBuyShelfId,
        req.SrockStatus,
        req.SaleTaxType,
        req.BuyTaxType,
        req.SaleBillType,
        req.BuyBillType,
        req.UseAddress,
        req.PosDefCustId,
        req.PosDefStock,
        req.DefCustId,
        req.CreateBy,
        req.CreateTime,
        req.EditBy,
        req.EditTime,*/
        id: parseInt(this.id), // edit by id
        company_id: parseInt(this.company_id),
        branch_id: parseInt(this.branch_id),
        tax_type: this.tax_type,
        tax_rate: this.tax_rate,
        logo_path: this.logo_path,
        taxtype: this.tax_type,
        depart_id: this.depart_id,
        def_sale_wh_id: this.def_sale_wh_id,
        def_sale_shelf_id: this.def_sale_shelf_id,
        def_buy_wh_id: this.def_buy_wh_id,
        def_buy_shelf_id : this.def_buy_shelf_id,
        stock_status: parseInt(this.stock_status),
        sale_tax_type: this.sale_tax_type,
        buy_tax_type: this.buy_tax_type,
        sale_bill_type: this.sale_bill_type,
        buy_bill_type: this.buy_bill_type,
        use_address: parseInt(this.use_address),
        pos_def_cust_id: parseInt(this.pos_def_cust_id),
        pos_def_stock: parseInt(this.pos_def_stock),
        def_cust_id: this.def_cust_id,
        create_by: this.create_by,
        create_time: this.create_time,
        edit_by: this.edit_by,
        edit_time: this.edit_time,
        //branch_name:  this.branch_name,
        //address: this.address,
        //telephone: this.telephone,
        //fax: this.fax,
      };
      //console.log(JSON.stringify(id));
      //console.log(this.id)
      api.createSetting(payload,
        result => {
          console.log(result)
          alertify.success('บันทึกสำเร็จ ');
      },
        error => {
          console.log(JSON.stringify(error))
          //Customerall
          alertify.error('เกิดข้อผิดพลาด');
      })
    }
  },
  mounted() {
    this.id = this.$route.params.id;
    this.showedit();
  },
};
