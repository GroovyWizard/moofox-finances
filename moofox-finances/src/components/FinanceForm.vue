<template>
    <v-container class="form-container">
        <v-dialog persistent width="50%" v-model="showPopupReceivers" style="background-color: rgba(255, 255, 255, 0.171);">
            <v-autocomplete variant="solo" label="Existing Receivers" item-title="name" item-value="name"
                v-model="autoCompleteReceiver" :items="receiverList"></v-autocomplete>
            <v-row class="text-start">
                <v-col class="" cols="12">
                    <v-btn class="me-4" color="success" @click="insertReceiverIntoItem">
                        Select
                    </v-btn>
                    <v-btn color="primary" @click="closePopup">Close</v-btn>
                </v-col>
            </v-row>
        </v-dialog>
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

                        <v-text-field variant="solo" v-model="item.receiver_name" label="Who will receive the money:">
                            <template v-slot:append-inner>
                                <v-btn elevation="0" @click="showPopup(item)">
                                    <v-icon icon="mdi-account-search" />
                                </v-btn>
                            </template>
                        </v-text-field>


                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field class="date-pick-wrapper" variant="solo">
                            <VueDatePicker class="date-pick" :auto-apply="true" :teleport="true" :enable-time-picker=false v-model="item.dueDate">
                            </VueDatePicker>
                        </v-text-field>
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
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'


export default {
    components: { VueDatePicker },
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
        this.populateReceiverList();
    },
    data() {
        return {
            currentItemProductId: undefined,
            selectedDate: undefined,
            showPopupReceivers: false,
            autoCompleteReceiver: "",
            receiverList: [],
            loadedFinanceList: [],
            defaultFinanceForm: {
                id: 0,
                product_id: "created-" + crypto.randomUUID(),
                name: "New Item",
                price: "",
                receiver_name: "",
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
                this.financeList.splice(itemToRemove, 1);
            }

            //Item id 0 only applies to objects not save to the database yet
            //So if the id is equal to 0 there is no reason to send it to backend for deletion
            //then we only delete it in frontend.
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
                receiver_name: "",
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
        populateReceiverList() {
            axios.get(`http://localhost/api/receivers/list?mode="names"`)
                .then(response => {
                    this.receiverList = response.data;
                    console.log(response);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        insertReceiverIntoItem() {
            if (!this.currentItemProductId) {
                return;
            }
            const itemToUpdate =
                this.loadedFinanceList.findIndex(
                    form => form.product_id === this.currentItemProductId
                )


            //Cant use itemToUpdate because it validates 0 as false.
            if (itemToUpdate !== null || itemToUpdate !== undefined) {
                this.loadedFinanceList[itemToUpdate].receiver_name =
                    this.autoCompleteReceiver;
            }
        },
        showPopup(item) {
            this.populateReceiverList();
            this.currentItemProductId = item.product_id;
            this.showPopupReceivers = true;
        },
        closePopup() {
            // Very important, so the product id from the current item gets cleared correctly
            this.currentItemProductId = undefined;
            this.showPopupReceivers = false;
        }

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

.date-pick-wrapper {
    position: relative;
}

.date-pick {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    width: 92%;
}</style>