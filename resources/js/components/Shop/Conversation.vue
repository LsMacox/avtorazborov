<template>
    <div class="conversation">
        <div class="info_user_block">
            <img src="/cabinet/images/avatar.png" alt=""/>
            <div class="block_text">
                <p class="name">{{ contact.settings != null  ? contact.settings.name : '' }}</p>
                <p class="phone">{{ contact.login }}</p>
                <p class="mail">{{ contact.settings != null ? contact.settings.email : '' }}</p>
            </div>
            <div class="city">
                <p style="font-weight: bold; font-size: 17px">Город:</p>
                <p>{{contact.settings != null ? contact.settings.city : 'Город не указан'}}</p>
            </div>
        </div>
        <MessagesFeed :user="user" :contact="contact" :messages="messages"/>
        <MessageComposer :user="user" @sendfile="sendFileMessage" @sendtext="sendTextMessage"/>
        <div class="error_block" v-show="contact == undefined">
            <p>Извините, но пользователь удален!</p>
        </div>
    </div>
</template>

<script>
    import MessagesFeed from './MessagesFeed';
    import MessageComposer from './MessageComposer';

    export default { 
        props: {
            user: {
                type: Object,
                required: true
            },
            proposal: {
                type: Object,
                required: true
            },
            contact: {
                type: Object,
                required: true
            },
            messages: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                file_progress: null,
            }
        },
        methods: {
            sendTextMessage(text) {
                if (!this.contact) {
                    return;
                }
                
                axios.post(this.$routes.route('message.send-text'), {
                    to: this.contact.id,
                    text: text,
                    proposal_id: this.proposal.id
                })
                .then((response) => {
                    this.$emit('new', response.data);
                    this.sendMessageOfflineUserOnMail(response.data.text);
                });
            },
            sendFileMessage(file) {

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };

                let form = new FormData();

                form.append('file_message', file);
                form.append('to', this.contact.id);
                form.append('proposal_id', this.proposal.id);

                axios.post(this.$routes.route('message.send-file'), form, config, {
                    onUploadProgress: (itemUpload) => {
                        this.file_progress = Math.round( (itemUpload.loaded / itemUpload.total) * 100 );
                    }
                })
                .then(response => {
                    if (!this.contact) {
                        return;
                    }
                    this.$emit('new', response.data);
                })

            },
            sendMessageOfflineUserOnMail(text) {
                if (!this.contact.online)
                {
                    axios.post(this.$routes.route('message.send-message-on-email-offline-user'), {
                        user_name: this.user.shop_setting.name,
                        msg: text,
                        to_email: this.contact.settings != undefined ? this.contact.settings.email : '',
                        user_status: this.contact.online
                    });
                }
            },
        },
        components: {MessagesFeed, MessageComposer}
    }
</script>

<style lang="scss" scoped>
.conversation {
    width: 550px;
    margin-left: 15px;
    .error_block {
        margin-top: 26%;
        p {
            text-align: center;
            font-family: "ProximaNova";
            font-size: 18px;
            font-weight: 400;
            align-items: center;
        }
    }
    h1 {
        font-size: 20px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed lightgray;
    }
    .final_spare_parts{
        ul{
           list-style: decimal; 
        }
    }
    .info_user_block{
        height: 80px;
        background: #fff9e3;
        img{
            float: left;
            width: 65px;
            height: 65px;
            border: 4px solid #fff;
            border-radius: 50%;
            margin-left: 17px;
            margin-top: 8px;
        }
    }
    .block_text{
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        flex-direction: column;
        float: left;
        line-height: 0.3;
        margin-top: 19px;
        margin-left: 6px;
        font-size: 16px;
        font-weight: 600;
        font-family: "ProximaNova";
        color: #535353;
    }
    .city{
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        flex-direction: column;
        float: right;
        margin-right: 61px;
        margin-top: 10px;
        font-family: "ProximaNova";
        p{
            color: #696969;
            font-size: 18px;
            margin-bottom: 0;
            line-height: 1.2;
        }
    }
}
@media screen and (max-width: 768px) {
    .conversation{
        width: 100%;
        margin-left: 0;
    }
}
@media screen and (max-width: 450px) {
    .city{ 
        margin-right: 40px!important;
    }
}
</style>
