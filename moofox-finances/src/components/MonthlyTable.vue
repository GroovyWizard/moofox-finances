


<template>
  <v-data-table
    v-model:items-per-page="itemsPerPage"
    :headers="headers"
    :items="items"
    item-value="id"
    class="elevation-1"
  ></v-data-table>
</template>
<script>
import axios from 'axios';
export default {
  created() {
    this.loadItems();
  },
  methods: {
    loadItems() {
        axios.get('http://localhost/api/table/list')
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
          title: 'Dessert (100g serving)',
          align: 'start',
          sortable: false,
          key: 'id',
        },
        { title: 'Name', align: 'end', key: 'name' },
        { title: 'Fat (g)', align: 'end', key: 'value' },
      ],
      items: [

      ],
    }
  },
}
</script>


<style></style>