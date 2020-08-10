<template>
    <div class="conversation">
        <div v-if="messages.length != 0" class="block_openContact">
            <a :href="$routes.route('user.profile.shop.show', {id: contact.id})">
                <div class="btn_openContact">
                <i class="fas fa-phone"></i>
                <p>показать контакты</p>
            </div>
            </a>
        </div>
        <MessagesFeed :user="user" :contact="contact" :messages="messages"/>
        <MessageComposer @sendtext="sendMessage" @sendfile="SendFileMessage"/>
    </div>
</template>

<script>
    import MessagesFeed from './MessagesFeed';
    import MessageComposer from './MessageComposer';

    export default {
        props: {
            contact: {
                type: Object,
                default: {}
            },
            messages: {
                type: Array,
            },
            user: {
                type: Object,
                required: true
            },
            proposal: {
                type: Object,
                required: true
            },
            admin: {
                type: Object,
                required: true
            }
        },
        methods: {
            sendMessage(text) {
                if (!this.contact) {
                    return;
                }
                
                axios.post(this.$routes.route('admin.message.send-text'), {
                    from: this.user.id,
                    to: this.contact.id,
                    admin_id: this.admin.id,
                    proposal_id: this.proposal.id,
                    text: text,
                }).then((response) => {
                    this.$emit('new', response.data);
                })
            },
            SendFileMessage(file) {

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };

                let form = new FormData();

                form.append('file_message', file);
                form.append('to', this.contact.id);
                form.append('proposal_id', this.proposal.id);
                form.append('from', this.user.id);
                form.append('admin_id', this.admin.id);

                axios.post(this.$routes.route('admin.message.send-file'), form, config, {
                    onUploadProgress: (itemUpload) => {
                        this.file_progress = Math.round( (itemUpload.loaded / itemUpload.total) * 100 );
                    }
                })
                .then((response) => {

                    if (!this.contact) {
                        return;
                    }

                    this.messages.push(response.data);

                })

            },
        },
        components: {MessagesFeed, MessageComposer}
    }
</script>

<style lang="scss" scoped>
.conversation {
    width: 350px!important;
    margin-left: 13px;
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
}
.block_openContact{
    display: flex;
    justify-content: center;
    .btn_openContact{
        position: relative;
        display: flex;
        justify-content: center;
        cursor: pointer;
        margin-top: 10px;
        i {
            transform: rotate(90deg);
        }
        &:hover{
            &::after{
                box-shadow: 1px 1px 10px #a2a0a0;
            }
        }
        &::before{
            content: "";
            position: absolute;
            top: -107px;
            left: -37%;
            width: 175%;
            height: 170px;
            background: #fef9e8;
            -webkit-clip-path: polygon(100% 57%, 85% 80%, 15% 80%, 0 58%);
            clip-path: polygon(100% 57%, 85% 80%, 15% 80%, 0 58%);
        }
        &::after{
            content: "";
            position: absolute;
            background: #fceaae;
            cursor: pointer;
            border-radius: 16px;
            border: 1px solid #e3d7ae;
            width: 180px;
            height: 28px;
            box-shadow: 1px 1px 10px #ccc;
            top: -5px;
            -webkit-transition: 0.3s ease;
            transition: 0.3s ease;
        }
        p{
            color: #575652;
            font-family: "ProximaNova";
            font-size: 14px;
            margin-bottom: 0;
            line-height: 1.3;
            z-index: 100;
        }
        i{
            margin-right: 10px;
            transform: rotate(94deg);
            color: #535353;
            font-size: 17px;
            z-index: 100;
        }
    }
}
@media screen and (max-width: 600px) {
    .conversation{
        margin-left: 0;
    }
}
</style>
