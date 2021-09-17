<template>

    <vs-row>
        <vs-col :key="index" vs-type="flex" vs-justify="center" vs-align="center" vs-w="9" vs-xs="12">
            <vs-row>
                <vs-col :key="index" v-for="col,index in 8" vs-type="flex" vs-justify="center" vs-align="center" vs-w="3" vs-xs="6">
                    <div style="padding: 5px">
                        <vs-card>
                            <div slot="header">
                                <h3>
                                    Hello world !
                                </h3>
                            </div>
                            <div>
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span>
                            </div>
                            <div slot="footer">
                                <vs-row vs-justify="flex-end">
                                    <vs-button type="gradient" color="danger" icon="favorite"></vs-button>
                                    <vs-button color="primary" icon="turned_in_not"></vs-button>
                                    <vs-button color="rgb(230,230,230)" color-text="rgb(50,50,50)" icon="settings"></vs-button>
                                </vs-row>
                            </div>
                        </vs-card>
                    </div>
                </vs-col>
            </vs-row>

        </vs-col>
        <vs-col :key="sale-description" vs-type="flex" vs-justify="center" vs-align="center" vs-w="3" vs-xs="12">
           aqui va la venta
        </vs-col>
    </vs-row>




</template>

<script>
  import axios from '@/axios.js'
  export default {
    name: 'NewSale',
    created () {
    },
    methods: {
      setColumnFilter () {

      }
    },
  }
</script>

<style lang="scss">

</style>
