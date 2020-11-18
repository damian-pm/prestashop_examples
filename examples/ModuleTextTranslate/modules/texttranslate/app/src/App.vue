<template>
  <div id="app">
    <div>
      <b-button size="lg" variant="success" :class="{active:showTabs}" @click="show('tab')" >Back office translation</b-button>
      <b-button size="lg" variant="success" :class="{active:showTranslation}" @click="show('translation')" >Custom translation </b-button>
      <b-button size="lg" variant="warning" class="float-right" :href="urlCacheClear" >Clear cache after changed translation</b-button>
    </div>
    <TranslationView v-if="showTranslation"/>
    <TabView v-if="showTabs"/>
  </div>
</template>

<script>
import TranslationView from './components/TranslationView'
import TabView from './components/TabView'
import $ from 'jquery'

export default {
  name: 'App',
  data: function(){
    return {
      loading:true,
      showTranslation: true,
      showTabs: false,
      urlCacheClear: ''
    }
  },
  mounted(){
    this.urlCacheClear = $('#trans').data('url-clear-cache')
  },
  components: {
    TranslationView,
    TabView
  },
  methods: {
    show(type){
      if (type== 'translation') {
        this.showTabs = false
        this.showTranslation = true
      } else if (type== 'tab') {
        this.showTabs = true
        this.showTranslation = false
        }
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.ttloader {
    float: left;
    margin: 0 20px;
}
.container-trans {
    min-height: 700px;
}
</style>
