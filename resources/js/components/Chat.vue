<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Message</div>

                    <div class="card-body">
                        <ul class="list-unstyled" style="height:400px;overflow-y:scroll;">
                            <li class="p-2" v-for="(item, i) in messages" :key="i">
                                <strong class="mr-3">{{item.user.name}}</strong>
                                {{item.text}}
                            </li>
                        </ul>
                        <input type="text" v-model="newText" class="form-control" @keyup.enter="sendMessage">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Online user</div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        created(){
            this.fetchMessage();
            Echo.join('chat')
                .listen('MessageSent', (event) => {
                    // console.log(event);
                    this.messages.push(event.message);
                });
        },
        data(){
            return{
                messages: [],
                newText: ''
            }
        },
        methods:{
            fetchMessage(){
                axios.get('/get_chat').then((response) => {
                    this.messages = response.data;
                    // console.log(response.data)
                });
            },
            sendMessage(){
                this.messages.push({
                    user: this.user,
                    text: this.newText
                });
                axios.post('/send_chat', {text: this.newText});
                this.newText = '';
            }
        }
    }
</script>
