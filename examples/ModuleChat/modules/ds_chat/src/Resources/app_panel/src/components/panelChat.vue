<template>
    <div class="panel-chat">
      <div class="row" v-if="showEmptyMsg">
        <div class="col-sm-12">
          <b-alert show variant="info">This employee don't have any messages</b-alert>
        </div>
      </div>
        <div class="row">
        <div class="col-sm-4">

            <div class="text-left">

            </div>

            <div class="text-left" v-for="(item, i) in items" :key="`${i}-${item.name}`">

                <b-button variant="primary" @click="getChatUser(item.id, item.token)" class="w-100 text-left" v-if="item.unreaded_count>0">
                  <span v-if="!item.name">{{unknownCustomer}}</span>
                  <span v-if="item.name">{{item.name}}</span>
                 <span class="float-right">
                    <b-badge pill variant="success" v-if="item.unreaded_count>0">NEW {{item.unreaded_count}}</b-badge> 
                    <b-badge pill variant="secondary">{{item.countMessage}}</b-badge> 
                 </span>
                    <!-- <b-badge pill variant="success">new message</b-badge> -->
                </b-button>

                <b-button variant="secondary" @click="getChatUser(item.id, item.token)" class="w-100 text-left" v-if="item.unreaded_count==0">
                  <span v-if="!item.name">{{unknownCustomer}}</span>
                  <span v-if="item.name">{{item.name}}</span>
                 <span class="float-right">
                    <b-badge pill variant="success" v-if="item.unreaded_count>0">NEW {{item.unreaded_count}}</b-badge> 
                    <b-badge pill variant="secondary">{{item.countMessage}}</b-badge> 
                 </span>
                </b-button>
            </div>
            <!-- <b-table striped hover :items="items"></b-table> -->
        </div>

        <div class="col-sm-8">
            
            <div class="window-ds-chat" v-if="showChat">
                <div class="ds-chat-content">
                    <div v-for="(item, i) in conversation" v-bind:key="`${i}-${item.user}`" class="inline-block">

                        <div v-bind:message="item.message"
                        class="float-right talk-bubble tri-left round left-in" v-if="item.owner == 'employee'">
                            <div class="talktext">
                                <p class="text-bold" v-if="item.employee">{{item.employee}}</p>
                                <p class="text-bold" v-if="!item.employee">{{unknownCustomer}}</p>
                                <p v-html="convertToHtml(item.message)" />
                                <p class="msg-time">{{item.added_time}}</p>
                            </div>
                        </div>
                        <div v-bind:message="item.message"
                        class="float-right talk-bubble tri-left round left-in" v-if="item.owner == 'bot'">
                            <div class="talktext">
                                <p class="text-bold">SmartBot</p>
                                <p v-html="convertToHtml(item.message)" />
                                <p class="msg-time">{{item.added_time}}</p>
                            </div>
                        </div>

                        <div v-bind:message="item.message"
                        class="float-left talk-bubble tri-right round right-in" v-if="item.owner == 'customer'">
                            <div class="talktext">
                                <p class="text-bold" v-if="item.customer">{{item.customer}}</p>
                                <p class="text-bold" v-if="!item.customer">{{unknownCustomer}}</p>
                                <p>{{item.message}}</p>
                                <p class="msg-time">{{item.added_time}}</p>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="ds-chat-input">
                    <textarea  v-model="commentText"></textarea>
                    <button @click="send" class="btn">send</button>
                </div>
            </div>

        </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import $ from 'jquery'
import showdown from 'showdown'

export default {
    name: 'panelChat',
    props: {
      turnOn: Boolean
    },
    data(){
        return {
            urlGetAllChat: '',
            urlGetChatUser: '',
            urlSetMessage: '',
            urlFullChat: '',
            showChat: false,
            showEmptyMsg: false,
            ownerName: 'brak-nazwy',
            customerId: 0,
            customerToken: '',
            commentText: '',
            tempMessage: '',
            unknownCustomer: 'Unlogged customer',
            items: [ ],
            conversation: [ ]
        }
    },
    mounted(){
        let data = $('#app-dschat').data()
        this.urlSetMessage = data['urlSetMessage']
        this.urlFullChat = data['urlFullChat']
        this.ownerName = data['employeeName']

        this.getChat()
        $('#app-ds-chat-panel').on('click', '.btn-menu-chat', (el)=> {
          let val = $(el.currentTarget).text()
          this.sendUserChose(val)
        })
        this.scrollDownContent()
    },
    created(){
      this.converter = new showdown.Converter()

      if (this.turnOn) {
          this.refreshChat()
      }
    },
    methods:{
        refreshChat(){
          let self = this
          setTimeout(()=>{
            self.getChat()
            self.refreshChat()
          }, 5000)
          if (this.turnOn) {
              this.$emit('blockingRefreshingChar');
          }
        },
        sortUserList(list){
          return list.sort((a,b)=> {
            if (a.unreaded_count < b.unreaded_count) return 1
            if (a.unreaded_count > b.unreaded_count) return -1
            return 0
          })
        },
        async getChat(){
          try {
            let res = await $.ajax({
                url: this.urlFullChat,
                method: 'POST',
                data: { id: this.customerId, token: this.customerToken }
            })
            if (res.users) {
               this.items = this.sortUserList(res.users)
            }
            if (this.items.length == 0) {
              this.showEmptyMsg = true
            }
            if (res.conversation && res.conversation.length) {
              this.conversation = res.conversation
              this.showChat = true
            }
            this.scrollDownContent()

          } catch (error) {
            console.error(error);
          }
        },
      convertToHtml(message){
          let text = '', nameButton, subText, substrMenu

          if (message.indexOf('[menu]') != -1) {
            let msg = message.match(/(.*)(\[menu\])(.*)(\[\/menu\])(.*)/)

            substrMenu = msg[2] + msg[3] + msg[4]
            subText = msg[3] ? msg[3].split('" "') : []

            for (let i in subText) {
              nameButton = subText[i].replace(/['"]+/g, '')
              text += '<button type="button" class="btn-menu-chat btn btn-primary btn-lg btn-block">'+ nameButton +'</button>'
            }
            message = message.replace(substrMenu, text)
          }
          text = this.converter.makeHtml(message)

          return `${text}`
      },
      sendUserChose(text=''){
        this.tempMessage = text
        this.send()
      },
      async getChatUser(id, token){
          this.customerId = id || this.customerId
          this.customerToken = token || this.customerToken
          this.getChat()
        },
        async send(){
            let res = await $.ajax({
                url: this.urlSetMessage,
                method: 'POST',
                data: {
                  id: this.customerId,
                  message: this.tempMessage || this.commentText,
                  token: this.customerToken,
                }
            })
            this.commentText = ''
            this.tempMessage = ''
            this.getChatUser()
        },
        scrollDownContent(){
            setTimeout(()=>{
              var messageBody = document.querySelector('.ds-chat-content');
              if (messageBody)
                messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
            }, 500)
        }
    }
}
</script>

<style lang="scss" scoped>
.panel-chat {
  width:100%;
}
.window-ds-chat {
    box-shadow: 5px 5px 9px #0000006e;
    padding:10px;
    border-radius: 10px;
    background-color: #ffffff;
}
.ds-chat-content {
    max-height: 400px;
    overflow: auto;
}
.inline-block {
    display: inline-block;
    width:100%;
}
.msg-time {
    float:right;
    margin: 5px;
    font-size: 11px;
    color: #ffffff;
}
.talktext {
  color:white;
  padding: 1em;
	text-align: left;
  line-height: 1.5em;
  p {
    overflow-wrap: break-word;
    /* remove webkit p margins */
    -webkit-margin-before: 0em;
    -webkit-margin-after: 0em;
  }
}

.ds-chat-input  {
  display:inline-block;
  position:relative;
  width:100%;
  padding:10px;
  
  button {
    position:absolute;
    bottom:20px;
    right:20px;
    color:#ffffff;
    background: #b55757;
    &:focus, &:hover {
        color:#ffffff;
    }
  }

  textarea {
    width:100%;
    height: 100px;
    padding: 14px;
    display:block;
    border-radius:15px;
    border: 1px solid #d8d8d8;

    &:focus {
      outline: none !important;
      border-color: #719ECE;
      box-shadow: 0 0 10px #719ECE;
    }
  }
}

.talk-bubble {
    margin: 10px 5px;
  /* display: inline-block; */
  position: relative;
	width: 50%;
    border-radius: 20px;
	height: auto;
	background-color: #007aff;
}
.talk-bubble.right-in {
  left: 20%;
}
.talk-bubble.left-in {
  left: -15%;
}
.tri-right.border.right-in:before {
	content: ' ';
	position: absolute;
	width: 0;
	height: 0;
  left: auto;
	right: -40px;
  top: 30px;
	bottom: auto;
	border: 20px solid;
	border-color: #666 transparent transparent #666;
}
.tri-right.right-in:after{
	content: ' ';
	position: absolute;
	width: 0;
	height: 0;
  left: -20px;
	right: auto;
  top: 10px;
	bottom: auto;
	border: 12px solid;
	border-color:  #007aff #007aff transparent transparent;
}

.tri-left.border.left-in:before {
	content: ' ';
	position: absolute;
	width: 0;
	height: 0;
  left: -40px;
	right: auto;
  top: 30px;
	bottom: auto;
	border: 20px solid;
	border-color: #666 transparent transparent #666;
}
.tri-left.left-in:after{
    	content: ' ';
	position: absolute;
	width: 0;
	height: 0;
  left: auto;
	right: -20px;
  top: 10px;
	bottom: auto;
	border: 12px solid;
	border-color: #007aff transparent transparent #007aff;


}
</style>