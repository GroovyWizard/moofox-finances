<template>
    <h3> New Item</h3>

    <div v-for="(item, index) in financeList" :key="index">
        {{ item.id }}
        <v-btn @click="showDeleteConfirmation(item)" icon="mdi-delete" color="danger">
        </v-btn>
        <FinanceForm :financeForm="item" />
    </div>
    <v-row class="mt-2">
        <v-col cols="12">
            <v-btn @click="addNewForm" icon="mdi-plus" color="primary">
            </v-btn>
        </v-col>
    </v-row>

    <template>
        <v-dialog v-model="isDeleting" persistent width="auto">
            <v-card>
                <v-card-title class="text-h5">
                    Deleting {{ itemToDelete.name }}
                </v-card-title>
                <v-card-text>
                    Are you sure you want to delete {{ itemToDelete.name }} from the list? This action is irreversible!
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue-darken-1" variant="text" @click="closeDeleteConfirmation()">
                        Cancel
                    </v-btn>
                    <v-btn color="red-darken-1" variant="text" @click="removeSelectedForm(itemToDelete.id)">
                        Delete
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </template>
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
        saveItem(item) {
            axios.post(`http://localhost/api/table/save/${this.$props.year}/${this.$props.month}/${item}`)
                .then(response => {
                    //change alert to msg
                    alert("Saved item to database successfully");
                    console.log(response);
                })
                .catch(error => {
                    //change alert to msg
                    alert("Error saving item to the database, please try again");
                    console.error(error);
                });

        },
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