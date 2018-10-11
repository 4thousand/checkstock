import api from "../service/service.js"

export default {
  name: 'quotation',
  data () {
    return {
     msg:'',
     star:true,
     Search:'',
     payload:[{
         head:'Q',
         topic:'S01-BHN5901-0005',
         detail:'รหัสลูกค้า: 069112891 หจก. ภูซางรัตนกิจ สำนักงานใหญ่ ประเภทการเสนอราคา: ขายสินค้าเงินสด รวมมูลค่าสินค้าทั้งหมด : 451,726.000 บาท',
        date:'25/01/2559',
        star:true
     },
     {
        head:'S',
        topic:'S01-BHN5901-0005',
        detail:'รหัสลูกค้า: 069112891 หจก. ภูซางรัตนกิจ สำนักงานใหญ่ ประเภทการเสนอราคา: ขายสินค้าเงินสด รวมมูลค่าสินค้าทั้งหมด : 451,726.000 บาท',
       date:'25/01/2559',
       star:true
    },
    {
        head:'D',
        topic:'S01-BHN5901-0005',
        detail:'รหัสลูกค้า: 069112891 หจก. ภูซางรัตนกิจ สำนักงานใหญ่ ประเภทการเสนอราคา: ขายสินค้าเงินสด รวมมูลค่าสินค้าทั้งหมด : 451,726.000 บาท',
       date:'25/01/2559',
       star:true
    },
    {
        head:'Q',
        topic:'S01-BHN5901-0005',
        detail:'รหัสลูกค้า: 069112891 หจก. ภูซางรัตนกิจ สำนักงานใหญ่ ประเภทการเสนอราคา: ขายสินค้าเงินสด รวมมูลค่าสินค้าทั้งหมด : 451,726.000 บาท',
       date:'25/01/2559',
       star:true
    },
    {
        head:'S',
        topic:'S01-BHN5901-0005',
        detail:'รหัสลูกค้า: 069112891 หจก. ภูซางรัตนกิจ สำนักงานใหญ่ ประเภทการเสนอราคา: ขายสินค้าเงินสด รวมมูลค่าสินค้าทั้งหมด : 451,726.000 บาท',
       date:'25/01/2559',
       star:true
    },
    {
        head:'S',
        topic:'S01-BHN5901-0005',
        detail:'รหัสลูกค้า: 069112891 หจก. ภูซางรัตนกิจ สำนักงานใหญ่ ประเภทการเสนอราคา: ขายสินค้าเงินสด รวมมูลค่าสินค้าทั้งหมด : 451,726.000 บาท',
       date:'25/01/2559',
       star:true
    },
    {
        head:'D',
        topic:'S01-BHN5901-0005',
        detail:'รหัสลูกค้า: 069112891 หจก. ภูซางรัตนกิจ สำนักงานใหญ่ ประเภทการเสนอราคา: ขายสินค้าเงินสด รวมมูลค่าสินค้าทั้งหมด : 451,726.000 บาท',
       date:'25/01/2559',
       star:true
    },
    {
        head:'Q',
        topic:'S01-BHN5901-0005',
        detail:'รหัสลูกค้า: 069112891 หจก. ภูซางรัตนกิจ สำนักงานใหญ่ ประเภทการเสนอราคา: ขายสินค้าเงินสด รวมมูลค่าสินค้าทั้งหมด : 451,726.000 บาท',
       date:'25/02/2561',
       star:true
    },
    {
        head:'S',
        topic:'S01-BHN5901-0005',
        detail:'รหัสลูกค้า: 069112891 หจก. ภูซางรัตนกิจ สำนักงานใหญ่ ประเภทการเสนอราคา: ขายสินค้าเงินสด รวมมูลค่าสินค้าทั้งหมด : 451,726.000 บาท',
       date:'30/03/2561',
       star:true
    },
    {
        head:'D',
        topic:'S01-BHN5901-0005',
        detail:'รหัสลูกค้า: 069112891 หจก. ภูซางรัตนกิจ สำนักงานใหญ่ ประเภทการเสนอราคา: ขายสินค้าเงินสด รวมมูลค่าสินค้าทั้งหมด : 451,726.000 บาท',
       date:'15/05/2561',
       star:true
    },
    {
        head:'S',
        topic:'S01-BHN5901-0005',
        detail:'รหัสลูกค้า: 069112891 หจก. ภูซางรัตนกิจ สำนักงานใหญ่ ประเภทการเสนอราคา: ขายสินค้าเงินสด รวมมูลค่าสินค้าทั้งหมด : 451,726.000 บาท',
       date:'14/01/2561',
       star:true
    },
    {
        head:'S',
        topic:'S01-BHN5901-0005',
        detail:'รหัสลูกค้า: 069112891 หจก. ภูซางรัตนกิจ สำนักงานใหญ่ ประเภทการเสนอราคา: ขายสินค้าเงินสด รวมมูลค่าสินค้าทั้งหมด : 451,726.000 บาท',
       date:'13/01/2561',
       star:true
    },
     ],
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
        localStorage.iddocno = val.id
        this.$router.push("/quotation");
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
