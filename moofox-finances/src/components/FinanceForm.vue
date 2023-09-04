<template>
    <v-container class="form-container">
        <v-form class="pa-5">
            <div v-for="item in loadedFinanceList" :key="item.product_id">
                <v-row>
                    <v-col cols="12">
                        <h3> {{ item.name }} <span>

                                <btn type="button" @click="deleteItem(item.id)"> <v-icon small color="red"> mdi-delete
                                    </v-icon> </btn>

                            </span></h3>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field variant="solo" v-model="item.name" label="Item name"></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field variant="solo" v-model="item.price" label="Item value"></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="6">

                        <v-text-field variant="solo" v-model="item.receiver"
                            label="Who will receive the money:"></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field variant="solo" v-model="item.dueDate" label="Due date of this item"></v-text-field>

                    </v-col>
                </v-row>

            </div>
            <v-row>
                <v-col class="mx-auto" cols="6">
                    <v-btn type="button" color="success" class="" @click="saveList">
                        Save
                    </v-btn>
                </v-col>
                <v-col cols="6" class="mx-auto">
                    <v-btn type="button" color="info" class="" @click="addNewItem">
                        Add
                    </v-btn>
                </v-col>
            </v-row>
        </v-form>
    </v-container>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        year: {
            type: Object,
            required: true
        },
        month: {
            type: Object,
            required: true
        },
        financeList: {
            type: Array,
            required: true,
            default: []
        }
    },
    watch: {
        financeList(value) {
            if (value.length > 0) {
                this.loadedFinanceList = value;
            }
        }
    },
    created() {
        this.pushNewItemIfListHas0Length();
    },
    data() {
        return {
            loadedFinanceList: [],
            defaultFinanceForm: {
                id: 0,
                product_id: "created-" + crypto.randomUUID(),
                name: "New Item",
                price: "",
                receiver: "",
                dueDate: "",
            }
        }
    },
    methods: {
        pushNewItemIfListHas0Length() {
            if (this.$props.financeList.length <= 0) {
                this.loadedFinanceList.push(this.defaultFinanceForm);
            }
        }, 
        deleteItem(itemId) {
            const itemToRemove = this.loadedFinanceList.findIndex(form => form.id === itemId)

            if (itemToRemove !== -1) {
                //change alert to msg
                this.financeList.splice(itemToRemove, 1);
            }

            if (itemId !== 0) {
                axios.delete(`http://localhost/api/finance/delete/${itemId}`)
                    .then(response => {
                        console.log(response);
                        alert("Deleted");
                        return true;
                    })
                    .catch(error => {
                        console.error(error);
                        return false;
                    });
            } else {
                alert("Deleted");
            }
            this.pushNewItemIfListHas0Length();

        },
        addNewItem() {
            let newItem = {
                id: 0,
                product_id: "created-" + crypto.randomUUID(),
                name: "New Item",
                price: "",
                receiver: "",
                dueDate: "",
            };

            this.loadedFinanceList.push(newItem);
        },
        saveList() {
            axios.post(`http://localhost/api/table/save/${this.$props.year}/${this.$props.month}`,
                { 'items': this.loadedFinanceList })
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

    }
}

</script>

<style>
@media (max-width: 600px) {
    .form-container {
        width: 100% !important;
    }
}

.form-container {
    width: 50%;
    background-color: rgba(231, 219, 219, 0.527)
}
</style>