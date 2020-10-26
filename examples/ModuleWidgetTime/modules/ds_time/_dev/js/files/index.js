import Vue from 'vue';
import dstime from './components/dstime';
const vues = document.querySelectorAll(".ds_time");
Array.prototype.forEach.call(vues, (el, index) => 
  new Vue({
    el: '.ds_time',
    components: {
      dstime
    },
    template: '<div><dstime /></div>',
    runtimeCompiler: true,
  })
);
