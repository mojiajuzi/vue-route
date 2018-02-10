<template>
      <main>
        <el-card class="box-card">
        <el-row class="chat-content">
            <div id="chat-messages" class="card-content" v-html="chatContent">
            </div>
        </el-row>
        <div  v-if="!joined">
            <el-row :gutter="2">
                <el-col :span="9">
                <el-input v-model="username" placeholder="UserName"></el-input>
                </el-col>
                <el-col :span="9">
                <el-input v-model="email" placeholder="Email"></el-input>
                </el-col>
                <el-col  :span="6">
                    <el-button type="primary" @click="join()">Join</el-button>
                </el-col>
            </el-row>
        </div>
        <div v-else>
            <el-row :gutter="1">
                <el-col :span="20">
                    <el-input v-model="newMsg" @keyup.enter="send"></el-input>
                </el-col>
                <el-col :span="3">
                    <el-button type="success"  @click="send">Send</el-button>
                </el-col>
            </el-row>
        </div>
        </el-card>
    </main>
</template>
<script>
export default {
  data() {
      return {
          ws: null,
          newMsg: '',
          chatContent: '',
          email: null,
          username: null,
          joined: false
      }
  },
  created: function(){
      var self = this;
      this.ws = new WebSocket("ws://localhost:9200/ws");
      this.ws.addEventListener('message', function (e) {
            var msg = JSON.parse(e.data)
            self.chatContent += '<div class="chip">'
                + '<img src="' + self.gravatarURL(msg.email) + '" style="width:30px;">'
                + msg.username
            + '</div>'+msg.message+'<br />'

            var element = document.getElementById('chat-messages');
            element.scrollTop = element.scrollHeight;
      });
  },
  methods: {
      send: function(){
            if (this.newMsg != '') {
                this.ws.send(
                    JSON.stringify({
                        email: this.email,
                        username: this.username,
                        message: this.newMsg
                    })
                );
                this.newMsg = '';
            }
      },
        join: function () {
            if (!this.username){
                this.$message("Please Input the user name")
                return
            }

            if(!this.email) {
                this.$message("Please Input the email")
                return
            }
            
            this.email = this.username;
            this.joined = true;
                
        },
        gravatarURL: function(email) {
            return 'http://www.gravatar.com/avatar/sdfdsfdsfdsfdsf';
        }
  }
}
</script>
<style>
  .text {
    font-size: 14px;
  }

  .item {
    padding: 18px 0;
  }

  .box-card {
    width: 480px;
    height: auto;
  }

  .chat-content {
      margin-bottom: 90%;
  }
</style>
