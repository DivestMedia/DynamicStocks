<template lang="html">
    <div id="tab-clients">
        <div class="section content">
            <div class="container">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Client List
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fullname</th>
                                    <th>Username</th>
                                    <th>Company</th>
                                    <th>Position</th>
                                    <th>Country</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="users.length > 0">
                                    <tr v-for="user in users">
                                        <td>{{ user.id }}</td>
                                        <td>{{ user.fullname }}</td>
                                        <td>{{ user.username }}</td>
                                        <td>{{ user.infos.companyname }}</td>
                                        <td>{{ user.infos.position }}</td>
                                        <td>{{ user.infos.country }}</td>
                                        <td>{{ user.joined }}</td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Modal from './utils/Modal.vue';
import Axios from 'axios';

export default {
    data: function(){
        return {
            page : 1,
            clientNew : {},
            clientSaving : false,
            clientSaveError : false,
            clientSaveSuccess : false,
            api : {
                getClientList : hostname + "/api/v1/clients",
                storeClient : hostname + "/api/v1/client/create/",
            },
            users : []
        };
    },
    created(){
        this.page = 1;
        this.getClientList();
    },
    components : {
        'modal' : Modal,
    },
    methods: {
        getClientList(){
            var self = this;
            Axios.get(self.api.getClientList + '?page=' + self.page).then(function(response){
                self.users = response.data.data.data;
            }).catch(function (error) {

            });
        }
    }
}
</script>

<style lang="css">
</style>
