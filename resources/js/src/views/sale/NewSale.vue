<template>

    <vs-row>
        <vs-col  vs-type="flex" vs-justify="center" vs-align="center" vs-w="9" vs-xs="12" v-if="!viewHeadSale">
            <vs-row>
                <vs-col style="padding: 5px" vs-xs="12">
                    <vs-row >
                        <vs-col vs-w="6" vs-xs="12">
                            <vs-input @keyup="filterProduct" id="inputSearch" key="inputSearch" style="width: 100%" icon="search" placeholder="Busca tu producto" v-model="searchValue"/>
                        </vs-col>
                        <vs-col vs-w="6" vs-xs="12">
                            <v-select
                                v-model="selected"
                                label="title"
                                :options="option"
                            />
                        </vs-col>
                    </vs-row>
                </vs-col>
                <vs-col :key="index" v-for="p,index in productsFilter" vs-justify="center" vs-align="center" vs-w="3" vs-xs="6">
                    <div style="padding: 5px; width: 100%">
                        <vs-card>
                            <div slot="media">
                                <template v-if="p.URLImagen !== null">
                                    <img :src="p.URLImagen">
                                </template>
                                <template v-else>
                                    <img src="https://pixinvent.com/demo/vuexy-vuejs-admin-dashboard-template/demo-1/img/03.ada37056.jpg">
                                </template>
                            </div>

                            <div>
                                <h6>{{p.Producto}}</h6>
                                <span  style="font-size: 28px;color: #1b9a59">
                                    S/. {{p.PVenta}}
                                </span>
                            </div>
                            <div slot="footer">
                                <vs-row vs-justify="flex-end">
                                    <vs-button v-on:click="addProduct(p.IDProducto)" type="gradient" color="success" icon="add"></vs-button>
                                </vs-row>
                            </div>
                        </vs-card>
                    </div>
                </vs-col>
            </vs-row>
        </vs-col>
        <vs-col  vs-type="flex" vs-align="top" vs-w="3" vs-xs="12">
            <div style="padding: 5px;     height: 100%;">
                <vs-card>
                    <div slot="header">
                        <h4>
                            Venta Nº : 0
                        </h4>
                    </div>
                    <div>
                        <vs-row>
                            <vs-col vs-w="12">
                                <!-- Append Button -->
                                <vx-input-group>
                                    <vs-input v-model="input2" placeholder="Cliente" />

                                    <template slot="append">
                                        <div class="append-text btn-addon">
                                            <vs-button color="primary">Buscar</vs-button>
                                        </div>
                                    </template>
                                </vx-input-group>
                                <!-- /Append Button -->

                            </vs-col>
                        </vs-row>
                        <div id="detail-container">
                            <vs-list>
                                <vs-list-header icon="shopping_cart" title="Detalle de venta"></vs-list-header>
                                <ul class="list-detail">
                                    <li v-for="item in saleDetail" >
                                        <vs-row>
                                            <vs-col vs-w="7">
                                                <strong>{{item.Producto}}</strong>
                                                P. Venta: S/.{{item.PVenta}}
                                            </vs-col>
                                            <vs-col vs-w="5">
                                                <div class="content-group-btn">
                                                    <div class="btn-add" @click="removeProduct(item.IDProducto)">-</div>
                                                    <div class="result">{{item.cant}}</div>
                                                    <div class="btn-add" @click="addProduct(item.IDProducto)">+</div>
                                                </div>
                                            </vs-col>
                                        </vs-row>

                                    </li>
                                </ul>

                            </vs-list>

                        </div>


                        <vs-divider>
                            Total
                        </vs-divider>
                        <div style="padding-bottom: 15px;">
                            <h3>Total: {{totalSale}}</h3>
                        </div>

                        <vs-button v-if="!viewHeadSale" style="width: 100%" icon="arrow_forward_ios" color="success" type="filled" @click="showHeadSale">Siguiente</vs-button>
                        <vs-button v-else style="width: 100%" icon="arrow_back_ios" color="primary" type="filled" @click="showHeadSale">Atras</vs-button>
                    </div>
                    <div slot="footer">

                    </div>
                </vs-card>
            </div>
        </vs-col>
        <vs-col  vs-type="flex" vs-align="top" vs-w="9" vs-xs="12 " v-if="viewHeadSale">
            <div style="padding: 5px;height: 100%; width: 100%">
                <vx-card title="Tipo Compobante" subtitle="Factura">
                    <vs-input label-placeholder="Default" v-model="value1"/>
                    <vs-input color="success" label-placeholder="Success" v-model="value2"/>
                    <vs-input color="danger" label-placeholder="Danger" v-model="value3"/>
                    <vs-input color="warning" label-placeholder="Warning" v-model="value4"/>
                    <vs-input color="dark" label-placeholder="Dark" v-model="value5"/>
                    <vs-input color="rgb(213, 14, 151)" label-placeholder="RGB: rgb(213, 14, 151)" v-model="value6"/>
                    <vs-input color="#11e988" label-placeholder="HEX: #11e988" v-model="value7"/>
                </vx-card>
            </div>
        </vs-col>
    </vs-row>


</template>

<script>
import API from '../../api'
import vSelect from 'vue-select'

export default {
  components:{
    vSelect
  },
  name: 'NewSale',
  data () {
    return {
      searchValue:'',
      selected: { title: 'Square' },
      option: [{ title: 'Square' }, { title: 'Rectangle' }, { title: 'Rombo' }, { title: 'Romboid' }],
      input2:'',
      productsFilter: [],
      products:[],
      saleDetail:[],
      totalSale:null,
      viewHeadSale: false

    }
  },
  created () {
    this.$vs.loading()
    this.getProducts()
  },
  methods: {
    setColumnFilter () {

    },
    async getProducts () {
      const result = await API.request('product/all', 'GET')
      this.productsFilter = result.data
      this.products = result.data

      this.$vs.loading.close()

    },
    filterProduct() {
      if (this.searchValue.trim() === '') {
        this.productsFilter = this.products
      } else {
        const filterValue = this.searchValue.toLowerCase()
        this.productsFilter = this.products.filter(item => item.Producto.toLowerCase().includes(filterValue))
      }
    },
    addProduct (IDProducto) {
      const product = this.productsFilter.find(item => item.IDProducto == IDProducto)
      const pos = this.saleDetail.findIndex(i => i.IDProducto === product.IDProducto)
      const currentSaleDetail = this.saleDetail
      if (pos != -1) {
        //existe
        currentSaleDetail[pos].cant++
      } else {
        //no existe
        product.cant = 1
        currentSaleDetail.push(product)
      }
      this.saleDetail = currentSaleDetail
      this.calcSale()
    },
    removeProduct (IDProducto) {
      const product = this.productsFilter.find(item => item.IDProducto == IDProducto)
      const currentSaleDetail = this.saleDetail
      const pos = this.saleDetail.findIndex(i => i.IDProducto === product.IDProducto)
      const currentProduct = this.saleDetail[pos]
      if (currentProduct.cant <= 1) {
        currentSaleDetail.splice(pos, 1)
      } else {
        currentSaleDetail[pos].cant--
      }

      this.saleDetail = currentSaleDetail
      this.calcSale()
    },
    calcSale () {
      const vue = this
      let calcElement = 0

      this.saleDetail.forEach(function (element, index) {
        calcElement += (element.PVenta*element.cant)
      })
      vue.totalSale = calcElement
    },
    showHeadSale (){
      this.viewHeadSale = !this.viewHeadSale
    }
  }
}
</script>

<style lang="scss">

    .list-detail{
        padding: 0 5px;
        li{
            margin-top: 10px;
        }
    }

    .content-group-btn{
        display: flex;
        align-items: center;
        height: 100%;
        justify-content: center;
        .btn-add{
            border: 1px solid #636b6f;
            border-radius: 50%;
            width: 15px;
            height: 15px;
            text-align: center;
            font-size: 9px;
            font-weight: bold;
            cursor: pointer;
            &:hover{
                background-color: #c1bfbf;
                border-color: #bfbfbf;
                color: #fff;
            }
        }
        .result{
            margin: 10px;
        }
    }

</style>
