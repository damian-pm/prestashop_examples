<template>
  <div>
  <div id="app-ds-chat" v-if="showChat">
    <span class="icon-chat-hide">
      <p class="h1 mb-2"><b-icon icon="x" @click="hideChat()" variant="secondary"></b-icon></p>
    </span>
    <div class="ds-chat-content">

      <div v-for="(item, i) in conversation" v-bind:key="`${i}-${item.user}`"
      v-bind:comment="item.comment">
        <div v-if="item.owner == 'customer'"
        class="float-left talk-bubble tri-right round right-in" >
          <div class="talktext">
            <p class="text-bold" v-if="item.customer">{{item.customer}}</p>
            <p class="text-bold" v-if="!item.customer">{{userName}}</p>
            <p>{{item.message}}</p>
            <p class="msg-time">{{item.added_time}}</p>
          </div>
        </div>

        <div v-if="item.owner == 'employee'"
        class="float-right talk-bubble tri-left round left-in" >
          <div class="talktext">
            <p class="text-bold">{{item.employee}}</p>
            <p v-html="convertToHtml(item.message)" />
            <p class="msg-time">{{item.added_time}}</p>
          </div>
        </div>

        <div v-if="item.owner == 'bot'"
        class="float-right talk-bubble tri-left round left-in" >
          <div class="talktext">
            <p class="text-bold">SmartBot</p>
            <p v-html="convertToHtml(item.message)" />
            <p class="msg-time">{{item.added_time}}</p>
          </div>
        </div>

      </div>

    </div>

    <div class="ds-chat-input" >
        <b-alert variant="danger" v-if="error" show>{{error}}</b-alert>
      <textarea  v-model="commentText"></textarea>
      <button @click="send" class="btn">send</button>
      <!-- <button @click="getMessages" class="btn">get all</button> -->
    </div>
  </div>

  <span class="icon-chat-show blob" v-if="!showChat" @click="displayChat()">
     <a hrf="#" class="h1 mb-2"><b-icon icon="chat-dots-fill" variant="success"></b-icon></a>
  </span>

  </div>
</template>

<script>
import $ from 'jquery'
import cookie from 'js-cookie'
import showdown from 'showdown'

export default {
  name: 'App',
  data(){
    return {
      showChat: false,
      token: '', //45bh5y6nyn6y656nsfds
      customer_id: 1,
      url_get_all: '',
      url_send_msg: '',
      error: '',
      commentText:'',
      tempMessage:'',
      userName:'You',
      conversation: [],
      showdown: {}
    }
  },
  created(){
    this.converter = new showdown.Converter()
  },
  mounted(){
    let data = $('#app-ds-chat-customer').data()
    // console.log(data)
    this.url_get_all = data['getAllMsg']
    this.url_send_msg = data['sendMsg']
    this.token = cookie.get('dschat-token') || ''
    this.getMessages()
    this.refreshChat()

    $('#app-ds-chat-customer').on('click', '.btn-menu-chat', (el)=> {
      let val = $(el.currentTarget).text()
      console.log('click', val)
      this.sendUserChose(val)
    })

  },
  methods:{
    displayChat(){
      this.showChat = true
    },
    hideChat(){
      this.showChat = false
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
    refreshChat(){
      let self = this
      setTimeout(()=> {
        self.getMessages()
        self.refreshChat()
      }, 5000)
    },
    async getMessages(){
      let res = await $.ajax({
        method: 'POST',
        url: this.url_get_all,
        data: {
          token: this.token,
        }
      })
      res = JSON.parse(res);
      if (res.error) {
        this.error = res.error
      } else {
        let convLen = this.conversation.length 
        this.conversation = res.data
        if (convLen < res.data.length) {
          this.scrollDownContent()
        }
        if (res.token != cookie.get('dschat-token')) {
          cookie.set('dschat-token', res.token)
        }
        this.token = cookie.get('dschat-token')
      }

    },
    async send(){
      let res = await $.ajax({
        method: 'POST',
        url: this.url_send_msg,
        data: {
          token: this.token,
          message: this.tempMessage || this.commentText,
        }
      })
      res = JSON.parse(res);
      if (res.error) {
        this.error = res.error
      } else {
        this.getMessages()
      }
      this.commentText = ''
      this.tempMessage = ''

      this.scrollDownContent()
    },
    scrollDownContent(){
      setTimeout(function(){
        var messageBody = document.querySelector('.ds-chat-content');
        if (messageBody)
          messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
      }, 500)

    }
  }
}
</script>

<style lang="scss" scoped>

@import 'node_modules/bootstrap/scss/bootstrap.scss';
@import 'node_modules/bootstrap-vue/src/index.scss';

#app-ds-chat {
    width: 300px;
    height: auto;
    background: #ffffff;
    border-radius: 10px;
    position: fixed;
    right: 75px;
    bottom: 16px;
    z-index: 2;
    border: 1px solid #dedede;
    box-shadow: 5px 5px 8px #4c4c4c;

    .ds-chat-content {
      height:300px;
      overflow: auto;
      width: auto;
    }

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
    margin-bottom:0px;
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
	width: 200px;
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
  left: auto;
	right: -20px;
  top: 10px;
	bottom: auto;
	border: 12px solid;
	border-color: #007aff transparent transparent #007aff;
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
  left: -20px;
	right: auto;
  top: 10px;
	bottom: auto;
	border: 12px solid;
	border-color:  #007aff #007aff transparent transparent;
}


</style>