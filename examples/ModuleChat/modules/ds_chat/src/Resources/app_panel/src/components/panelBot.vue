<template>
  <div class="col-sm-12">
    <div class="row" v-if="response">
      <div class="col-sm-12">
        <b-alert show>{{response}}</b-alert>
      </div>
    </div>
    <p>
      <a href="#" class="h3" @click="moveScrollToElement('#specia-ds-chat-template')"> >> Go to special templates</a>  
    </p>
      <div class="h1" id="specia-ds-chat-template">Responses</div>   
        <hr>
    <!-- Add -->
    <div class="row">
      <div class="col-sm-5">
        <b-form-input v-model="question" placeholder="Queston"></b-form-input>
      </div>
      <div class="col-sm-5">
        <b-form-textarea v-model="answer" placeholder="Answer"></b-form-textarea>
      </div>
      <div class="col-sm-2">
        <b-button variant="success" @click="addMsg()">Add new message</b-button>
      </div>
    </div>

  <!-- Edit -->
    <div class="row" id="row-edit-bot-msg" v-if="showEdit">
      <div class="col-sm-5">
        <b-form-input v-model="editQuestion" placeholder="Queston"></b-form-input>
      </div>
      <div class="col-sm-5">
        <b-form-textarea v-model="editAnswer" placeholder="Answer"></b-form-textarea>
      </div>
      <div class="col-sm-2">
        <b-button variant="primary"  @click="sendEditMsg()">Edit</b-button>
        <b-button variant="secondary"  @click="showEdit=false">Cancle</b-button>
      </div>
    </div>

  <!-- answers collection  -->
  <div class="row">
      <b-table :fields="fields" striped hover :items="items">
        <template #cell(answer)="row">
            <p v-html="convertToHtml(row.item.answer)"></p>
        </template>
        <template #cell(action)="row">
            <b-button variant="danger" @click="deleteMsg(row.item.id)">Delete</b-button>
            <b-button variant="primary" @click="editMessage(row.item)">Edit</b-button>
        </template>
      </b-table>
  </div>
  <div class="h1" id="specia-ds-chat-template"> Special responses and templates</div>
   <hr>
  <!-- special answers  -->
    <div class="row">
      
            <b-table striped hover :items="itemsHelp">
            <template #cell(action)="row">
                <b-button variant="success" @click="addMsg( row.item.question, row.item.example)">Add template</b-button>
            </template>
            </b-table>
    </div>
</div>  
</template>

<script>
import $ from 'jquery'
import showdown from 'showdown'

export default {
    name: 'panelBot',
    data() {
      return {
        showEdit: false,
        urlDelBotMsg: '',
        urlGetAllBotMsg: '',
        urlAddBotMsg: '',
        urlEditBotMsg: '',
        question:'',
        answer:'',
        editMessageId:'',
        response: '',
        editAnswer: '',
        editQuestion: '',
        fields: [
          {key: 'id', label: 'ID'},
          {key: 'question', label: 'Question'},
          {key: 'answer', label: 'Answer'},
          {key: 'action', label: 'Action'},
        ],
        items: [ ],
        itemsHelp: [
          {question: 'BOT_START_MESSAGE', example:'Hello!', description: '[Special] Add message when user start conversation.', action: ''},
          {question: 'menu', example:'[menu]"Say Hi" "Say something" "Show links"[/menu]', description: 'Add example menu', action: ''},
          {question: 'Say Hi', example:'I am saying hello', description: 'Add example text response', action: ''},
          {question: 'Show link', example:'[home link](/)', description: 'Add example link', action: ''}
        ]
      }
    },
    mounted(){
      this.converter = new showdown.Converter()
      let data = $('#app-dschat').data()
      this.urlGetAllBotMsg = data['urlGetBotMessages']
      this.urlDelBotMsg = data['urlDelBotMessage']
      this.urlAddBotMsg = data['urlAddBotMessage']
      this.urlEditBotMsg = data['urlEditBotMessage']
      this.getBotMessages()
    },
    methods: {
      moveScrollToElement(name){
        $([document.documentElement, document.body]).animate({
                scrollTop: $(name).offset().top
        }, 2000);
      },
      convertToHtml(message){
          let text = '', nameButton, subText, substrMenu

          if (message.indexOf('[menu]') != -1) {
            let msg = message.match(/(.*)(\[menu\])(.*)(\[\/menu\])(.*)/)
            substrMenu = msg[2] + msg[3] + msg[4]
            subText = msg[3] ? msg[3].split('" "') : []

            for (let i in subText) {
              nameButton = subText[i].replace(/['"]+/g, '')
              text += '<button type="button" class="btn btn-primary btn-lg btn-block">'+ nameButton +'</button>'
            }
            message = message.replace(substrMenu, text)
          }
          text = this.converter.makeHtml(message)

          return `${text}`
      },
      editMessage(row){
        this.showEdit = true
        this.editAnswer = row.answer
        this.editQuestion = row.question
        this.editMessageId = row.id
        location.href = "#";
        location.href = "#row-edit-bot-msg";
      },
      async sendEditMsg(){

          try {
            let res = await $.ajax({
                url: this.urlEditBotMsg,
                method: 'POST',
                data: {id:this.editMessageId, question: this.editQuestion, answer: this.editAnswer}
            })

            this.response = res.response || ''
          } catch (error) {
            console.error(error);
          }
          this.getBotMessages()
      },
      async deleteMsg(id){
          try {
            let res = await $.ajax({
                url: this.urlDelBotMsg,
                method: 'POST',
                data: {id:id}
            })
            this.response = res.response || ''
          } catch (error) {
            console.error(error);
          }
          this.getBotMessages()
      },

      async addMsg(question , answer){
        question = question || this.question
        answer = answer || this.answer
          try {
            let res = await $.ajax({
                url: this.urlAddBotMsg,
                method: 'POST',
                data: {question: question, answer: answer}
            })
            this.response = res.response || ''
          } catch (error) {
            console.error(error);
          }
          this.getBotMessages()
      },
      async getBotMessages(){
          try {
            let res = await $.ajax({
                url: this.urlGetAllBotMsg,
                method: 'GET'
            })
            if (res && res.response) {
              this.items = res.response
            }
          } catch (error) {
            console.error(error);
          }
      }
    }
}
</script>