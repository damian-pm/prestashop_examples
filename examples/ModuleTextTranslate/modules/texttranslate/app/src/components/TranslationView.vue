<template>

    <b-container fluid class="container-trans">
    <b-row>
        <b-col class="box-custom-btn">
            <b-button class="float-left" @click="$bvModal.show('bv-modal-example'); edit(0)">Add new translation</b-button>
            <div class="ttloader">
                <dot-loader :loading="showTransLoader" :size="size"></dot-loader>
            </div>
        </b-col>
    </b-row>
    <b-row v-if="showTranslations" >
        <b-col>
            <b-pagination
                v-model="currentPage"
                :total-rows="rows"
                :per-page="perPage"
                aria-controls="translationTable"
                ></b-pagination>

            <b-table striped hover show-empty 
            id="translationTable" :per-page="perPage" :current-page="currentPage" :fields="fieldsTranslation" :items="filtered" >
                <template slot="top-row" slot-scope="{ fields }">
                    <td v-for="field in fields" :key="field.key">
                        <input v-model="filters[field.key]" :placeholder="field.label">
                    </td>
                </template>

            <template #cell(action)="row">

                <b-button variant="primary" @click="$bvModal.show('bv-modal-example'); edit(row.item.id)">Edit</b-button>
                <b-button variant="danger" @click="confirmDel(row.item.id)">Delete</b-button>

            </template>
            </b-table>
            <ModalTranslation ref="modalTranslation" v-on:showRows="showRows"/>
        </b-col>
    </b-row>
    <vue-confirm-dialog></vue-confirm-dialog>
    </b-container>
</template>

<script>
import ModalTranslation from './ModalTranslation'
import axios from 'axios'
import $ from 'jquery'
//http://greyby.github.io/vue-spinner/
import DotLoader from 'vue-spinner/src/DotLoader'

export default {
    name: 'TranslationView',
      data: function(){
        return {
            perPage: '10',
            currentPage: '1',
            showTranslations: false,
            fieldsTranslation: [ 
                { key: 'key', label: 'Text', sortable: true},
                { key: 'lang', label: 'Language', sortable: true},
                { key: 'translation', label: 'Translation', sortable: true},
                { key: 'domain', label: 'Domain', sortable: true},
                { key: 'theme', label: 'Theme', sortable: true},
                { key: 'action', label: 'Action', sortable: false},
            ],
            size:"30",
            filters: {
                 key:'', lang: '',translation:'', domain:'', theme:''
            },
            translation: {},
            image: '/admin-dev/../modules/texttranslate/app/dist/img/',
            url_get_trans: '',
            url_update_trans: '',
            translations: [],
        }
    },
    components: {
        ModalTranslation,
        DotLoader
    },

    computed: {
        rows() {
            return this.filtered.length
        },
        filtered () {
            const filtered = this.translations.filter(item => {
                return Object.keys(this.filters).every(key =>
                    String(item[key]).includes(this.filters[key]))
            })
            return filtered.length > 0 ? filtered : [{
             key:'', translation:'', domain:'', theme:''
            }]
        }
    },
    created(){
        this.url_get_trans = $('#trans').data('url-get-translations')
        this.url_del_trans = $('#trans').data('url-delete-translations')
        this.showRows();
    },
    methods: {
        confirmDel(id){
            let self = this
            this.$confirm({
                message: `Are you sure?`,
                button: { no: 'No', yes: 'Yes'
                },
                callback: confirm => {
                    if (confirm) {
                        self.del(id)
                    }
                }
            })
        },
       async del(id){
             var {data} = await axios.get(this.url_del_trans, {params:{id:id}})
            if (data.status === 'success') {
                this.showRows()
            } else {
                console.warn(data.status)
            }
        },
        async edit(id){
            let trans = this.translations;
            for (let i in trans) {
                if (trans[i]['id'] === id) {
                this.$refs.modalTranslation.loadForm(trans[i])
                return;
                }
            }
            this.$refs.modalTranslation.loadForm(id)
        },
        async showRows(){
            this.showTranslations = false
            this.showTransLoader = true

            var {data} = await axios.get(this.url_get_trans)
            if (data.result) {
                this.translations = data.result.custom_translations
            }
            this.showTranslations = true
            this.showTransLoader = false

        }
    }
}
</script>

<style >

.container-trans {
    min-height: 700px;
}
.box-custom-btn {
    margin-bottom: 10px;
}

</style>