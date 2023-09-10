<template>
  <v-row>
    <v-col cols="12" class="">
        <p class="text-left"> Total value: <b>  $ {{ totalPriceThisMonth() }} </b> </p> 
    </v-col>
  </v-row>
  <v-row>
    <v-col cols="12">
      <v-data-table v-model:items-per-page="itemsPerPage" :headers="headers" :items="items" item-value="id"
        class="elevation-1">
         <template v-slot:item.price="{ item }">
          <v-chip color="success">
            $ {{ item.columns.price }}
          </v-chip>
    </template>
      </v-data-table>
    </v-col>
  </v-row>
</template>
<script>
import axios from 'axios';
export default {
  expose: ['loadItems'],
  props: {
    year: {
      type: Object,
      required: true
    },
    month: {
      type: Object,
      required: true
    }
  },
  created() {
    this.loadItems();
  },
  methods: {
    totalPriceThisMonth() {
      let totalPrice = 0;
      for (const item of this.items) {
        totalPrice += parseFloat(item.price);
      }
      return totalPrice;

    },
    loadItems() {
      axios.get(`http://localhost/api/table/list/${this.$props.year}/${this.$props.month}`)
        .then(response => {
          console.log(response.data.finances)
          this.items = response.data.finances;
        })
        .catch(error => {
          console.error(error);
        });

    }
  },
  data() {
    return {
      itemsPerPage: 5,
      headers: [
        {
          title: 'Id',
          align: 'end',
          sortable: true,
          key: 'id',
        },
        { title: 'Name', align: 'center', key: 'name' },
        { title: 'Price', align: 'center', key: 'price' },
        { title: 'Receiver', align: 'center', key: 'receiver_name' },
        { title: 'Due Date', align: 'center', key: 'dueDate' },
      ],
      items: [

      ],
    }
  },
}
</script>


<style></style>