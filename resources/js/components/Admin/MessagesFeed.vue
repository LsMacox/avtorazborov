<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'}`" :key="message.id">
                <img :class="`rounded-circle${message.to == contact.id ? ' user-image_sent' : ' user-image_received'}`"
                     :src="`${message.admin ? '/cabinet/images/admin_avatar.png' : message.to != contact.id ? contact.avatar[0] != undefined ?
                     '/cabinet/storage/images/smalls/100x100/' + contact.avatar[0].name :
                     '/cabinet/images/avatar.png' :
                     '/cabinet/images/avatar.png'}`" :alt="contact.settings.name ? contact.settings.name : ''">

                <p v-if="message.admin"><strong>администратор:</strong></p>

                <a v-if="message.file_status" :href="'/cabinet/storage/'+message.file_path" :download="message.file_path" class="text">
                    <img v-if="message.file_status" :src="'/cabinet/storage/'+message.file_path">
                </a>
                <div v-if="!message.file_status" class="text">
                    {{ message.text }}
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
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
            }
        },
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            },
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
               
            },
            messages(messages) {
                this.scrollToBottom();
            }
        }
    }
</script>

<style lang="scss" scoped>
.feed {
    background: #fffdf7;
    height: 300px;
    margin-top: 70px;
    width: 100%;
    max-height: 470px;
    overflow-y: scroll;
    overflow-x: hidden;
    &::-webkit-scrollbar { width: 0; }
    ul {
        list-style-type: none;
        padding: 5px;
        li {
            position: relative;
            &.message {
                margin: 17px 0;
                width: 100%;
                .text {
                    max-width: 71%;
                    border-radius: 3px;
                    padding: 6px;
                    display: inline-block;
                    word-wrap: break-word;
                    font-family: "ProximaNova";
                }
                &.received {
                    text-align: left;
                    .user-image_received{
                        float: left;
                        margin-right: 14px;
                        width: 30px;
                        height: 30px;
                        position: absolute;
                        left: 0;
                        bottom: 0;
                    }
                    .text {
                        position: relative;
                        background: #fef6dc;
                        margin-left: 37px;
                        margin-top: -5px;
                        img {
                            cursor:pointer
                        }
                        &::after{
                            content: "";
                            position: absolute;
                            background: #fef6dc;
                            left: -10px;
                            bottom: 0px;
                            width: 12px;
                            height: 8px;
                            clip-path: polygon(100% 0, 0 100%, 100% 100%);
                        }
                    } 
                }

                &.sent {
                    text-align: right;
                    .user-image_sent{
                        float: right;
                        margin-left: 7px;
                        width: 30px;
                        height: 30px;
                        position: absolute;
                        right: 0;
                        bottom: 0;
                    }
                    .text {
                        position: relative;
                        background: #fef6dc;
                        margin-right: 34px;
                        margin-top: -4px;
                        img {
                            cursor:pointer
                        }
                        &::after{
                            content: "";
                            position: absolute;
                            background: #fef6dc;
                            right: -10px;
                            bottom: 0px;
                            width: 12px;
                            height: 8px;
                            clip-path: polygon(0 0, 0 100%, 100% 100%);
                        }
                    }
                }
            }
        }
    }
}
</style>

