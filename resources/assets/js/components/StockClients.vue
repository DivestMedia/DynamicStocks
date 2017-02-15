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

import Axios from 'axios';

export default {
    data: function(){
        return {
            page : 1,
            api : {
                getClientList : hostname + "/api/v1/clients"
            },
            users : []
        };
    },
    created(){
        this.page = 1;
        this.getClientList();
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
