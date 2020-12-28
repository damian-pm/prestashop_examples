<template>
  <div id="app-ds-chat-panel">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
            <p v-if="showBot" class="text-center h3">Bot configuration</p>
            <p v-if="showChat" class="text-center h3">User message</p>
            <p v-if="showMain" class="text-center h3">Welcome to Chat DS</p>
        </div>
      </div>
    <div class="row">
        <div class="col-sm-6">
          <b-button-group>
            <b-button variant="secondary"  @click="toggleShowMain()">Configuration</b-button>
            <b-button variant="primary"  @click="toggleShowChat()">User mesage</b-button>
            <b-button variant="secondary" @click="toggleShowBot()">Bot configuration</b-button>
          </b-button-group>
        </div>
        <div class="col-sm-6">
          <span class="h6">TIP: Employeer and bot can write in <a href="https://www.markdownguide.org/basic-syntax/">markdown syntax</a></span>
        </div>
      
    </div>
    <div class="row">
      <div class="space"></div>
    </div>
    <div class="row">
        <panelBot v-if="showBot"/>
        <mainPage v-if="showMain"/>
        <panelChat v-if="showChat" v-bind:turnOn="turnOn" v-on:blockingRefreshingChar="blockingRefreshingChar"/>
    </div>
    </div>

  </div>
</template>

<script>
import panelBot from './components/panelBot'
import panelChat from './components/panelChat'
import mainPage from './components/mainPage'
import $ from 'jquery'

export default {
  name: 'AppPanel',
  data(){
    return {
      colorBtnChat: 'secondary',
      colorBtnBot: 'secondary',
      showChat: false,
      showBot: false,
      showMain: true,
      turnOn: true,
    }
  },
  components:{
    panelBot,
    panelChat,
    mainPage
  },
  methods:{
    blockingRefreshingChar(){
      this.turnOn = false
    },
    toggleShowChat(){
      this.showChat = true
      this.showBot = false
      this.colorBtnChat= 'primary'
      this.showMain = false;
    },
    toggleShowBot(){
      this.showBot = true;
      this.showChat = false;
      this.showMain = false;
    },
    toggleShowMain(){
      this.showBot = false;
      this.showChat = false;
      this.showMain = true;
    },

  }
}
</script>

<style lang="scss" scoped>
@import 'node_modules/bootstrap/scss/bootstrap.scss';
@import 'node_modules/bootstrap-vue/src/index.scss';

.space {
  margin:10px;

}

</style>