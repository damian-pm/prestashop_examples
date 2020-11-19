<template>
  <div id="app">
    <button v-if="showBtn" v-on:click="showForm" class="btn btn-primary">add comment</button>
    <FormHandler v-if="initialized" v-bind:product="product"/>
    <div class="loader-commant" v-if="showLoader">
      <Jawn></Jawn>
    </div>
    <div class="comm-container">
      <div class="comm-row" v-for="(item) in comments" v-bind:key="item.id">
        <div class="row">
          <div class="col-sm-12 col-lg-3">
              <p  :class="'heart-box heart-size-' + item.rating">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                </svg>
              </p>
              <p class="h4 text-break-all">{{item.customer}}</p>
              <p class="h6">{{item.date_add}}</p>
          </div>
          <div class="col-sm-12 col-lg-9">
            <p class="h5 font-weight-bold text-break-all">{{item.title}} </p>
            <p class="text-break-all">{{item.description}}</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import FormHandler from './components/FormHandler'
import $ from 'jquery';
import {Jawn } from 'vue-loading-spinner'

export default {
  name: 'App',
  data: function(){
    return {
      showLoader: false,
      initialized: false,
      url: 'http://' + window.location.host + '/pl/module/ds_comment/fetchComments',
      comments: [],
      showBtn: true,
      product: {}
      };
  },
  components: {
    FormHandler,
    Jawn
  },
  mounted(){
    this.product = $('#product_comments').data()
    this.url += '?id_product=' + this.product.id
    this.refreshComments();

  },
  methods: {
    showForm(){
      this.initialized = true;
      this.showBtn = false;
    },
    refreshComments(){
      var self = this;
      this.showLoader = true;
      $.post(this.url, function(response){
        let res = JSON.parse(response);
         if (res.data && res.data.comments) {
           self.comments = res.data.comments;
            self.showLoader = false;

         }
      });
    }
  }
}
</script>

<style lang="scss">

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
.comm-container {
  margin:10px;
}
.comm-row {
  display: block;
  margin: 15px;
  border-bottom: 1px solid #e4e4e4;
}
.comm-col-left, .comm-col-right{
  display: inline-block;
  padding:10px;
}
.comm-col-left{
  width:20%;
}
.comm-col-right {
  width:80%;
}
@for $i from 1 through 5 {
  .heart-size-#{$i} {
    font-size: #{1+$i*6}px;
  }
}
.heart-box {
  float: right;
  color:#ec4b4b;
}
.text-break-all {
  word-break: break-all;
}
.loader-commant {
  margin:25px;
}
</style>
