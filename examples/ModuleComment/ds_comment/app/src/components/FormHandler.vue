<template >
  <div>
    <div ref="form" v-on:submit.prevent="onSubmit">
      <div class="loader" v-if="showLoader"></div>

      <div class="comment-error" v-for="info in info" v-bind:key="info.type">
        <div v-bind:class="[alertClass, info.type]" role="alert" >
          {{info.message}}
        </div>
      </div>
    
    </div>
  </div>
</template>

<script>

import $ from 'jquery';

export default {
  name: 'FormHandler',
  data: function(){
    return {
      isSubmit: false,
      url: 'http://' + window.location.host + '/pl/module/ds_comment/comment',
      showLoader: true,
      alertClass: 'alert',
      info: []
    };
  },
  props: {
    product: {}
  },
  mounted(){
    this.loadForm();
    this.url += '?id_product=' + this.product.id;
  },
  methods: {
    onSubmit () {
      this.isSubmit = true;
      let data      = $(this.$refs.form).find('form').serialize();
      this.loadForm(data);
    },
    loadForm(data = {}){
      var self = this;
      $.post(this.url, data, function(response, status){
        let res = JSON.parse(response);
        if (status == 'success' && res.data.html != '') {
            self.$refs.form.innerHTML = res.data.html;
            if (self.isSubmit) {
              self.$parent.refreshComments();
              self.isSubmit = false;
          }
        } else if (res.data.info != []) {
          self.info = res.data.info
          self.showLoader = false;
        }

      });
    }
  }

}
</script>

<style>

#form_comment .row {
    margin-top: 10px;
}
.comment-error {
  margin-top: 10px;
}
</style>
