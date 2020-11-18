<template>
  <b-modal id="bv-modal-example" hide-footer>
    <template #modal-title>
      <h3>{{modalTitle}}</h3>
    </template>
    <div class="text-center font-weight-bold h2">Index: {{className}}</div>
    <div class="d-block text-center" id="modalBody" ref="form" v-on:submit.prevent="submit">
          <dot-loader></dot-loader>
    </div>
    <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-example')">Close Me</b-button>
  </b-modal>

</template>

<script>
import $ from 'jquery'
import axios from 'axios'
import DotLoader from 'vue-spinner/src/DotLoader'

export default {
    name: 'ModalTab',
    props: {
      openModal: Boolean
    },
    components: {
      DotLoader
    },
    data(){
      return {
        url_update_tab: '',
        formValues: {},
        className: '',
        modalTitle: 'Edit tab'
      }
    },
    mounted: function(){
      this.url_update_tab = $('#trans').data('url-update-tabs')
    },
    methods: {
      async submit(e) {
        this.$bvModal.hide('bv-modal-example')
        let self = this
        let f = new FormData(e.srcElement);
        // let data = {}
        // for (let [key, val] of f.entries()) {
        //     Object.assign(data, {[key]: val})
        // }
        // console.log('data',data)
        axios({
          method: 'post',
          url: this.url_update_tab,
          data: f,
          headers: {'Content-Type': 'multipart/form-data' }
        })
        .then(function (response) {
            if (response.data && response.data.info === 'success') {
              self.$emit('showRows')
            }
        })
        .catch(function (response) {
            console.warn(response);
        });

      },
      async loadForm(trans){
        var params = new URLSearchParams();
        let name = trans.name || ''
        this.className = trans.className
        params.append('name', name);
        var {data} = await axios.post(this.url_update_tab, params)
        this.$refs.form.innerHTML = data.html
        if (name === '') {
          this.modalTitle = 'Add new tab'
        }
      },
    }
}
</script>

<style>
#modalBody {
  min-height: 400px;
}
</style>