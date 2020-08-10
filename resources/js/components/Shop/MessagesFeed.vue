<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.admin ? ' received' : message.to == contact.id ? ' sent' : ' received'}`" :key="message.id">
                <img :class="`rounded-circle${message.admin ? ' user-image_received' : message.to == contact.id ? ' user-image_sent' : ' user-image_received'}`"
                     :src="`${message.admin ? '/cabinet/images/admin_avatar.png' : message.to == contact.id ? userMediaAvatar != undefined ?
                     '/cabinet/storage/images/smalls/100x100/' + userMediaAvatar.name :
                     '/cabinet/images/avatar.png' :
                     '/cabinet/images/avatar.png'}`"
                     :alt="contact.settings != undefined ? contact.settings.name : ''"
                     :style="`${message.admin ? 'margin-right: 11px; margin-left: 10px;' : ''}`">

                <p v-if="message.admin"><strong>администратор:</strong></p>
                <a v-if="message.file_status" :href="`/cabinet/storage/${message.file_path}`" :download="message.file_path"><img v-if="message.file_status" :src="`/cabinet/storage/${message.file_path}`" style="cursor:pointer" class="text"></a>
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
            user: {
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
            },
        },
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            }
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            }
        },
        computed: {
            userMediaAvatar() {
                return _.map(this.user.media, (img) => {
                    if (img.designation == 'avatar') return img;
                })[0];
            }
        },
    }
</script>

<style lang="scss" scoped>
.feed {
    background: #fffdf7;
    height: 320px;
    max-width: 550px;
    width: 100%;
    max-height: 470px;
    overflow-y: scroll;
    overflow-x: hidden;
    &::-webkit-scrollbar { width: 0; }
    ul {
        list-style-type: none;
        padding: 5px;
        li {
            &.message {
                margin: 17px 0;
                width: 100%;
                .text {
                    max-width: 250px;
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
                        margin-right: 18px;
                        margin-top: -3px;
                        width: 30px;
                        height: 30px;
                    }
                    .text {
                        position: relative;
                        background: #f3f1ec;
                        margin-left: 6px;
                        margin-top: -5px;
                        min-width: 60%;
                    }
                }

                &.sent {
                    text-align: right;
                    .user-image_sent{
                        float: right;
                        margin-left: 7px;
                        margin-top: -3px;
                        width: 30px;
                        height: 30px;
                    }
                    .text {
                        position: relative;
                        background: #fff7dc;
                        margin-right: -2px;
                        margin-top: -5px;
                    }
                }
            }
        }
    }
}
</style>

