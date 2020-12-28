<template>
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-8 h2">
                <span class="font-weight-bold">{{employeeName}} - {{employeeEmail}}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p class="h4">Choose employeer who will be recipiant of messages.</p>
            </div>
            <div class="col-sm-6" v-if="response">
                <b-alert variant="danger" v-if="responseType=='danger'" show>{{response}}</b-alert>
                <b-alert variant="success" v-if="responseType=='success'" show>{{response}}</b-alert>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <b-table striped hover  :fields="fields" :items="items">
                    <template #cell(action)="row">
                        <b-button variant="success" @click="changeOwner( row.item.email)">Change</b-button>
                    </template>
                </b-table>
            </div>
        </div>
    </div>
</template>

<script>

import $ from 'jquery'

export default {
    name: 'mainPage',
    data(){
        return {
            newEmail:'',
            employeeName: '',
            employeeEmail: '',
            urlSetOwner: '',
            response: '',
            responseType: 'success',
            urlSummaryEmployee: '',
            items: [],
            fields: [
                {key: 'name', label: 'Employee name'},
                {key: 'email', label: 'E-mail'},
                {key: 'count', label: 'Count messages'},
                {key: 'action', label: 'Action'},
            ],
        }
    },
    mounted(){
        let data = $('#app-dschat').data()
        this.employeeName = data.employeeName
        this.employeeEmail = data.employeeEmail
        this.urlSetOwner = data.urlSetOwner
        this.urlSummaryEmployee = data.urlGetSummaryEmployee
        this.getSummaryEmployee()
    },
    methods:{
        async changeOwner(email){
          try {
            this.response = ''
            let data = await $.ajax({
                url: this.urlSetOwner,
                method: 'POST',
                data: { email: email}
            })
            if (data.res) {
               this.response = data.res
               this.responseType = data.type
               if (data.employee &&  data.employee.name) {
                    this.employeeName = data.employee.name
                    this.employeeEmail = data.employee.email
               }
               this.getSummaryEmployee()
            }
          } catch (error) {
            console.error(error);
          }
        },
        async getSummaryEmployee(){
          try {
            this.response = ''
            let data = await $.ajax({
                url: this.urlSummaryEmployee,
                method: 'GET',
            })
            if (data.response) {
                this.items = data.response
            }
          } catch (error) {
            console.error(error);
          }
        }
    }
}
</script>