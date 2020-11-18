<template>
  <b-modal id="bv-modal-example" hide-footer>
    <template #modal-title>
      <h3>{{modalTitle}}</h3>
    </template>
    <div class="d-block text-center" id="modalBody" ref="form" v-on:submit.prevent="submit">
          <dot-loader></dot-loader>
    </div>
    <b-button  block @click="$bvModal.hide('bv-modal-example')">Close Me</b-button>
  </b-modal>

</template>

<script>
import $ from 'jquery'
import axios from 'axios'
import DotLoader from 'vue-spinner/src/DotLoader'

export default {
    name: 'ModalTranslation',
    props: {
      openModal: Boolean
    },
    components:{
      DotLoader
    },
    data(){
      return {
        url_update_trans: '',
        formValues: {},
        body: 'body',
        modalTitle: 'Edit translation'
      }
    },
    mounted: function(){
      this.url_update_trans = $('#trans').data('url-update-translations')
    },
    methods: {
      async submit(e) {
        this.$bvModal.hide('bv-modal-example')
        let self = this
        let f = new FormData(e.srcElement);
        axios({
          method: 'post',
          url: this.url_update_trans,
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
        let id = trans.id || 0
        params.append('id', id);
        var {data} = await axios.post(this.url_update_trans, params)
        this.$refs.form.innerHTML = data.html
        if (id === 0) {
          this.modalTitle = 'Add new translation'
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