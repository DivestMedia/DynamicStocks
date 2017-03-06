<template lang="html">
    <div id="tab-admin">
        <div class="section content">
            <div class="container">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Transaction Entry
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="columns is-multiline">
                            <div class="column is-full">
                                <modal btnText="NEW CLIENT" btnClass="button is-pulled-right is-link is-small" :minimal="true" :minheight="false">
                                    <h2>New Client</h2>
                                    <form @submit.prevent="onCreateClientSubmit" @reset.prevent="onCreateClientReset">
                                        <div class="columns is-multiline">
                                            <div class="column is-one-third">
                                                <label class="label">Title</label>
                                                <p class="control">
                                                    <span class="select" name="title">
                                                        <select v-model="clientNew.title">
                                                            <option>Mr.</option>
                                                            <option>Ms.</option>
                                                            <option>Mrs.</option>
                                                            <option>Dr.</option>
                                                        </select>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="column is-one-third">
                                                <label class="label">First Name</label>
                                                <p class="control">
                                                    <input class="input" type="text" name="firstname" placeholder="John" v-model="clientNew.firstname" required>
                                                </p>
                                            </div>
                                            <div class="column is-one-third">
                                                <label class="label">Last Name</label>
                                                <p class="control">
                                                    <input class="input" type="text" name="lastname" placeholder="Doe" v-model="clientNew.lastname" required>
                                                </p>
                                            </div>

                                            <hr />

                                            <div class="column is-two-thirds">
                                                <label class="label">Company Name</label>
                                                <p class="control">
                                                    <input class="input" type="text" placeholder="Exosphere" v-model="clientNew.companyname">
                                                </p>
                                            </div>
                                            <div class="column is-one-third">
                                                <label class="label">Position</label>
                                                <p class="control">
                                                    <input class="input" type="text" placeholder="Office Manager" v-model="clientNew.position">
                                                </p>
                                            </div>
                                            <div class="column is-full">
                                                <label class="label">Company Address</label>
                                                <p class="control">
                                                    <input class="input" type="text" placeholder="BLK32 Pensville Drive Tanzania, Metropolis" v-model="clientNew.companyaddress">
                                                </p>
                                            </div>
                                            <div class="column is-one-third">
                                                <label class="label">City</label>
                                                <p class="control">
                                                    <input class="input" type="text" placeholder="San Francisco"  v-model="clientNew.city">
                                                </p>
                                            </div>
                                            <div class="column is-one-third">
                                                <label class="label">State</label>
                                                <p class="control">
                                                    <input class="input" type="text" placeholder="California" v-model="clientNew.state">
                                                </p>
                                            </div>
                                            <div class="column is-one-third">
                                                <label class="label">Country</label>
                                                <p class="control">
                                                    <input class="input" type="text" placeholder="United States" v-model="clientNew.country">
                                                </p>
                                            </div>
                                            <div class="column is-one-third">
                                                <label class="label">Office #</label>
                                                <p class="control">
                                                    <input class="input" type="text" placeholder="(000) 000-0000" v-model="clientNew.officenum">
                                                </p>
                                            </div>
                                            <div class="column is-one-third">
                                                <label class="label">Mobile #</label>
                                                <p class="control">
                                                    <input class="input" type="text" placeholder="(000) 000-0000" v-model="clientNew.mobilenum">
                                                </p>
                                            </div>
                                            <div class="column is-one-third">
                                                <label class="label">Email Address</label>
                                                <p class="control">
                                                    <input class="input" type="email" placeholder="johndoe@email.com" v-model="clientNew.email" required>
                                                </p>
                                            </div>
                                            <div class="column is-full">
                                                <label class="label">Notes</label>
                                                <p class="control">
                                                    <textarea class="input is-minheight-100" rows="4" placeholder="Important notes about this client..." v-model="clientNew.notes"></textarea>
                                                </p>
                                            </div>

                                            <hr />

                                            <div class="column is-one-third">
                                                <label class="label">Username</label>
                                                <p class="control">
                                                    <input class="input" type="text" placeholder="johndoe" v-model="clientNew.username" required>
                                                </p>
                                            </div>
                                            <div class="column is-one-third">
                                                <label class="label">Password</label>
                                                <p class="control">
                                                    <input class="input" type="password" v-model="clientNew.password" required>
                                                </p>
                                            </div>
                                            <div class="column is-one-third">
                                                <label class="label">Confirm Password</label>
                                                <p class="control">
                                                    <input class="input" type="password" v-model="clientNew.password_confirmation" required>
                                                </p>
                                            </div>
                                            <div class="column is-full" v-if="clientSaveError">
                                                <div class="notification is-danger">
                                                    <ul>
                                                        <li v-for="error in clientSaveError">{{ error }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="column is-full" v-if="clientSaveSuccess">
                                                <div class="notification is-success">
                                                    Client created successfully.
                                                </div>
                                            </div>
                                            <div class="column">
                                                <button class="button is-primary" type="submit" :class="{ 'is-loading' : clientSaving }">Save Client</button>
                                                <button class="button" type="reset">Reset Form</button>
                                            </div>
                                        </div>
                                    </form>
                                </modal>

                            </div>

                        </div>
                        <form class="columns is-multiline" @submit.prevent="onCreateRecordSubmit" @reset.prevent="onCreateRecordReset">
                            <div class="column is-full">
                                <label class="label">Client Name</label>
                                <p class="control">
                                    <input type="hidden" v-model="record.username" required>
                                    <autocomplete
                                    url="/api/v1/client/search"
                                    anchor="username"
                                    label="fullname"
                                    placeholder="e.g. John"
                                    class-name="input"
                                    :onSelect="setClientName"
                                    :onInput="resetNameValidity"
                                    :onBlur="checkNameValidity"
                                    :onHide="checkNameValidity"
                                    :required="true"
                                    ></autocomplete>
                                </p>
                            </div>
                            <div class="column is-one-third">
                                <label class="label">Stock Symbol</label>
                                <p class="control">
                                    <input class="input" type="text" placeholder="e.g. YHOO" v-model="record.symbol" required>
                                </p>
                            </div>
                            <div class="column is-one-third">
                                <label class="label">Property Name</label>
                                <p class="control">
                                    <input class="input" type="text" placeholder="e.g. Yahoo! Inc." v-model="record.name" required>
                                </p>
                            </div>
                            <div class="column is-one-third">
                                <label class="label">Exchange Name</label>
                                <p class="control">
                                    <input class="input" type="text" placeholder="e.g. NMS" v-model="record.exchange">
                                </p>
                            </div>
                            <div class="column is-one-third">
                                <label class="label">Transaction Type</label>
                                <p class="control">
                                    <span class="select" name="type">
                                        <select v-model="record.type">
                                            <option>BUY</option>
                                            <option>SELL</option>
                                        </select>
                                    </span>
                                </p>
                            </div>
                            <div class="column is-one-third">
                                <label class="label">Reminder</label>
                                <p class="control">
                                    <input class="input" type="text" placeholder="e.g. Notes" v-model="record.notes">
                                </p>
                            </div>
                            <div class="column is-one-third">
                                <label class="label">Purchased Date</label>
                                <p class="control">
                                    <input class="input" type="datetime-local" placeholder="e.g. Equity" v-model="record.date" required>
                                </p>
                            </div>
                            <div class="column is-one-third">
                                <label class="label">Purchased Price</label>
                                <p class="control">
                                    <input class="input" type="number" min="0" v-model="record.price" step="any"  required >
                                </p>
                            </div>
                            <div class="column is-one-third">
                                <label class="label">Purchased Quantity</label>
                                <p class="control">
                                    <input class="input" type="number" min="0" v-model="record.quantity" required step="any" >
                                </p>
                            </div>
                            <div class="column is-one-third">
                                <label class="label">Total Purchased</label>
                                <p class="control">
                                    <input class="input" type="number" min="0" readonly :value="record.price * record.quantity">
                                </p>
                            </div>
                            <div class="column is-one-third">
                                <label class="label">Account Value</label>
                                <p class="control">
                                    <input class="input" type="number" min="0" required v-model="record.account" step="any" >
                                </p>
                            </div>
                            <div class="column is-one-third">
                                <label class="label">Cash Value</label>
                                <p class="control">
                                    <input class="input" type="number" min="0" required v-model="record.cash" step="any" >
                                </p>
                            </div>
                            <div class="column is-full" v-if="recordSaveError">
                                <div class="notification is-danger">
                                    <ul>
                                        <li v-for="error in recordSaveError">{{ error }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="column is-full" v-if="recordSaveSuccess">
                                <div class="notification is-success">
                                    Record created successfully.
                                </div>
                            </div>
                            <div class="column is-full">
                                <button class="button is-primary" type="submit" :class="{ 'is-loading' : recordSaving }">Save Record</button>
                                <button class="button" type="reset">Reset Form</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Transaction Log
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client</th>
                                        <th>Symbol</th>
                                        <th>Name</th>
                                        <th>Exchange</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Client</th>
                                        <th>Bought</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="transactions.length > 0">
                                        <tr v-for="transaction in transactions">
                                            <td v-html="transaction.serial"></td>
                                            <td>{{ transaction.user.fullname }}</td>
                                            <td>{{ transaction.symbol }}</td>
                                            <td>{{ transaction.name }}</td>
                                            <td>{{ transaction.exchange }}</td>
                                            <td>{{ transaction.type }}</td>
                                            <td v-html="transaction.priceFormatted"></td>
                                            <td v-html="transaction.qtyFormatted"></td>
                                            <td v-html="transaction.totalFormatted"></td>
                                            <td>{{ transaction.user.fullname }}</td>
                                            <td><span :title="transaction.updated_at">{{ transaction.bought }}</span></td>
                                            <td>
                                                <a class="button has-icon is-small">
                                                    <span class="icon is-small ">
                                                        <i class="fa fa-pencil"></i>
                                                    </span>
                                                </a>
                                                <a class="button has-icon is-small is-danger" @click.prevent="deleteTransaction(transaction.id)">
                                                    <span class="icon is-small ">
                                                        <i class="fa fa-trash"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    </template>
                                    <template v-if="transactions.length == 0">
                                        <td colspan="12" class="has-text-centered">
                                            No transactions yet.
                                        </td>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import Modal from './utils/Modal.vue';
import Axios from 'axios';
import Events from './Events.js';
import Autocomplete from 'vue2-autocomplete-js';

var autocomplete = Vue.extend({
    mixins: [Autocomplete],
    data : function(){
        return {
            inputValid : false
        };
    },
    props: {
        required : {
            type : Boolean,
            default : false
        }
    },
    mounted: function(){
        var self = this;
        var elem = self.$el.children[0];
        elem.className = 'input autocomplete-input';
        if(self.required){
            elem.setAttribute("required", "required");
        }
    }
});
export default {
    data : function(){
        return {
            record : {
                quantity : 100,
                price : 1000,
                type : 'BUY',
                date: moment().format('YYYY-MM-DDThh:mm'),
                account: 0,
                cash : 0
            },
            clientNew : {},
            clientSaving : false,
            clientSaveError : false,
            clientSaveSuccess : false,
            recordSaving : false,
            recordSaveError : false,
            recordSaveSuccess : false,
            api : {
                storeClient : hostname + "/api/v1/client/create/",
                storeRecord : hostname + "/api/v1/transaction/create/",
                getTransactionList : hostname + "/api/v1/transactions",
                deleteTransaction : hostname + "/api/v1/transaction/delete",
            },
            page : 1,
            transactions : []
        };
    },
    components : {
        'modal' : Modal,
        autocomplete,
    },
    methods : {
        resetNameValidity(){
            this.$children[1].inputValid = false;
        },
        checkNameValidity(){
            var self = this;
            var elem = this.$children[1].$el.children[0];
            if(!this.$children[1].inputValid){
                // elem.value = '';
                self.record.username = elem.value;
            }
        },
        onCreateClientSubmit(){
            var self = this;
            self.clientSaving = true;
            self.clientSaveSuccess = false;
            self.clientSaveError = false;

            Axios.post(self.api.storeClient, { client :  self.clientNew } ).then(function(response){
                if(response.data.error.length){
                    self.clientSaveError = response.data.error;
                }else{
                    self.clientSaveError = false;
                    self.clientSaveSuccess = true;
                    self.onCreateClientReset();
                }
                self.clientSaving = false;
            }).catch(function (error) {
                self.clientSaving = false;
            });
        },
        onCreateRecordSubmit(){
            var self = this;
            self.recordSaving = true;
            self.recordSaveSuccess = false;
            self.recordSaveError = false;

            Axios.post(self.api.storeRecord, { record :  self.record } ).then(function(response){
                if(response.data.error.length){
                    self.recordSaveError = response.data.error;
                }else{
                    self.recordSaveError = false;
                    self.recordSaveSuccess = true;
                    self.onCreateClientReset();
                    self.getTransactionList();
                }
                self.recordSaving = false;
            }).catch(function (error) {
                if(error.response.data.error.length){
                    self.recordSaveError = error.response.data.error;
                }
                self.recordSaving = false;
            });
        },
        onCreateClientReset(){
            this.clientNew = {};
            this.recordSaving = false;
        },
        onCreateRecordReset(){
            this.record = {
                quantity : 100,
                price : 1000
            };
            this.recordSaving = false;
            this.recordSaveSuccess = false;
            this.recordSaveError = false;
        },
        setClientName(data){
            this.record.username = data.username;
            this.$children[1].inputValid = true;
        },
        getTransactionList(){
            var self = this;
            Axios.get(self.api.getTransactionList + '?page=' + self.page).then(function(response){
                self.transactions = response.data.data.data;
            }).catch(function (error) {

            });
        },
        deleteTransaction(id){
            var self = this;
            if (confirm("Are you sure you want to delete this transaction?")) {
                Axios.post(self.api.deleteTransaction, { id :  id } ).then(function(response){
                    self.getTransactionList();
                });
            }
        }
    },
    created(){
        this.page = 1;
        this.getTransactionList();
    },
}
</script>

<style lang="css">
</style>
