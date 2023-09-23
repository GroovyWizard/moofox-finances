<template>
  <v-row>
    <v-col cols="12" class="">
      <p class="text-left"> Total value: <b> $ {{ totalPriceThisMonth() }} </b> </p>
    </v-col>
  </v-row>
  <v-col class="text-right">
    <v-btn class="text-right" color="green" @click="getCsv"> <v-icon class="mr-2"> mdi-microsoft-excel </v-icon>Export CSV
    </v-btn>
  </v-col>
  <v-row>
    <v-col cols="12">

      <v-data-table v-model:items-per-page="itemsPerPage" :headers="headers" :items="items" item-value="id"
        class="elevation-1">
        <template v-slot:item.price="{ item }">
          <v-chip color="success">
            $ {{ item.columns.price }}
          </v-chip>
        </template>

        <template v-slot:item.dueDate="{ item }">
          <v-chip :color=this.isDue(item.columns.dueDate)>
            {{ item.columns.dueDate }}
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
    isDue(date) {
      const currentDate = new Date();
      const parsedDate = new Date(date);
      if (parsedDate < currentDate) {
        return "red";
      }
      return "success";

    },
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
    },
    getCsv() {
      axios({
        method: 'get',
        url: `http://localhost/api/table/csv/${this.$props.year}/${this.$props.month}`,
        responseType: 'blob'
      })
        .then(response => {
          const blob = new Blob([response.data], { type: 'text/csv' });
          const url = window.URL.createObjectURL(blob);

          const triggerTag = document.createElement('a');
          triggerTag.href = url;
          triggerTag.download = 'your_csv_file.csv';
          document.body.appendChild(triggerTag);
          triggerTag.click();

          window.URL.revokeObjectURL(url);
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