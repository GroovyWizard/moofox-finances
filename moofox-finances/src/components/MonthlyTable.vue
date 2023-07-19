<template>
  <v-data-table v-model:items-per-page="itemsPerPage" :headers="headers" :items="items" item-value="id"
    class="elevation-1"></v-data-table>
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
          title: '#',
          align: 'end',
          sortable: true,
          key: 'id',
        },
        { title: 'Name', align: 'start', key: 'name' },
        { title: 'Price', align: 'end', key: 'price' },
        { title: 'Receiver', align: 'center', key: 'receiver' },
        { title: 'Due Date', align: 'center', key: 'dueDate' },
      ],
      items: [

      ],
    }
  },
}
</script>


<style></style>