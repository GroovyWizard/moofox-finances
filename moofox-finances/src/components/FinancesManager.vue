<template>
    <FinanceForm :year="year" :month="month" :financeList="financesBackendList" />
</template>

<script>
import FinanceForm from './FinanceForm.vue';
import axios from 'axios';
import { ref } from 'vue';
const financesEditorRef = ref(0);
export default {
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
    components: {
        FinanceForm,
    },
    data() {
        return {
            itemToDelete: {},
            isDeleting: false,
            financesBackendList: [

            ],
            financeList: [

            ],
        };
    },
    created() {
        this.loadItems();
        console.log(this.financesBackendList)
    },
    methods: {
        
        closeDeleteConfirmation() {
            this.isDeleting = false;
            this.itemToDelete = {};

        },
        showDeleteConfirmation(item) {
            this.isDeleting = true;
            this.itemToDelete = item;
        },
        removeSelectedForm(formId) {
            const itemToRemove = this.financeList.findIndex(form => form.id === formId)
            if (itemToRemove !== -1) {
                const deleteResponse = this.deleteItem(formId);
                if (deleteResponse) {
                    //change alert to msg
                    this.financeList.splice(itemToRemove, 1);
                    alert("Deleted");
                    return;
                }
                //change alert to msg
                this.closeDeleteConfirmation();
                alert("Failed to delete, try again");
                return;
            }
        },
        deleteItem(itemId) {
            axios.delete(`http://localhost/api/finance/delete/${itemId}`)
                .then(response => {
                    console.log(response);
                    return true;
                })
                .catch(error => {
                    console.error(error);
                    return false;
                });

        },
        loadItems() {
            axios.get(`http://localhost/api/table/list/${this.$props.year}/${this.$props.month}`)
                .then(response => {
                    console.log(response.data.finances)
                    this.financesBackendList = response.data.finances;
                    this.populateFinanceListFromBackend();
                })
                .catch(error => {
                    console.error(error);
                });

        },
        populateFinanceListFromBackend() {
            if (this.financesBackendList) {
                this.financesBackendList.forEach(element => {
                    console.log(element);
                    const formStructure = {
                        id: element.id,
                        name: element.name,
                        value: element.price,
                        payTo: element.receiver,
                        dueDate: element.dueDate,

                    };
                    this.addNewForm(formStructure);
                });
                return;
            }
            const defaultFormStructure = {
                id: "created" + crypto.randomUUID(),
                name: "",
                value: 0,
                payTo: "",
                dueDate: "",
            }

            this.addNewForm(formStructure);
        },

        addNewForm(formData) {
            const defaultFormStructure = {
                id: crypto.randomUUID(),
                name: "",
                value: 0,
                payTo: "",
                dueDate: "",
            };

            if (!formData) {
                return this.financeList.push(defaultFormStructure);
            }

            return this.financeList.push(formData);
        }
    }

}

</script>

<style></style>