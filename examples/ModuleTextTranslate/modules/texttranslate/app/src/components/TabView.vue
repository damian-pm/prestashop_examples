<template>

    <b-container fluid class="container-trans">
    <b-row>
        <b-col>
            <!-- <b-button class="float-left" @click="$bvModal.show('bv-modal-example'); edit(0)">Add new tab</b-button> -->
            <div class="ttloader">
                <dot-loader :loading="showTransLoader" :size="size"></dot-loader>
            </div>
        </b-col>
    </b-row>
    <b-row v-if="showTranslations">
        <b-col>
            <b-table striped hover show-empty :fields="fieldsTabs" :items="filtered" >
                <template slot="top-row" slot-scope="{ fields }">
                <td v-for="field in fields" :key="field.key">
                    <input v-model="filters[field.key]" :placeholder="field.label">
                </td>
                </template>

            <template #cell(action)="row">
                <b-button variant="primary" @click="$bvModal.show('bv-modal-example'); edit(row.item.name)">Edit</b-button>
            </template>
            </b-table>
            <ModalTab ref="modalTab" v-on:showRows="showRows"/>
        </b-col>
    </b-row>
    </b-container>
</template>

<script>
import ModalTab from './ModalTab'
import axios from 'axios'
import $ from 'jquery'
import DotLoader from 'vue-spinner/src/DotLoader'

export default {
    name: 'TabView',
      data: function(){
        return {
            showTranslations: false,
            size: "30",
            fieldsTabs: [
                { key: 'className', label: 'Index', sortable: true},
                { key: 'lang', label: 'Language', sortable: true},
                { key: 'name', label: 'Name', sortable: true},
                { key: 'module', label: 'Module', sortable: true},
                { key: 'action', label: 'Action'},
            ],
            filters: {className:'', lang:'', name:'', module:''},
            url_get_tabs: '',
            url_del_tabs: '',
            tabs: []
        }
    },
    components: {
        ModalTab,
        DotLoader
    },
    computed: {
        filtered () {
            const filtered = this.tabs.filter(item => {
                return Object.keys(this.filters).every(key =>
                    String(item[key]).includes(this.filters[key]))
            })
            return filtered.length > 0 ? filtered : [{ lang:'', module:'', name:'', className:'' }]
        }
    },
    created(){
        this.url_get_tabs = $('#trans').data('url-get-tabs')
        this.url_del_tabs = $('#trans').data('url-del-tabs')
        this.showRows();
    },
    methods: {
        async edit(name){
            
            let trans = this.tabs;
            for (let i in trans) {
                if (trans[i]['name'] === name) {
                this.$refs.modalTab.loadForm(trans[i])
                return;
                }
            }
            this.$refs.modalTab.loadForm('')
            },
        async showRows(){
            this.showTranslations = false
            this.showTransLoader = true

            var {data} = await axios.get(this.url_get_tabs)
            if (data.result) {
                this.tabs = data.result.tab_langs
            }
            this.showTranslations = true
            this.showTransLoader = false

            }
    }
}
</script>

<style>
.container-trans {
    min-height: 700px;
}
</style>