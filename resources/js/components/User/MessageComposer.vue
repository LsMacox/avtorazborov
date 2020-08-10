<template>
    <div class="composer" style="display: flex; width: 100%;">
        <i class="attach_file fas fa-paste" @click="$refs.file.click()"></i>
        <input ref="file" class="sendFile" type="file" @change="sendFile">
        <textarea v-model="message" @keydown.enter="sendText" placeholder="Напишите ваш ответ здесь"></textarea>
        <i @click="sendText" class="sent_icon fab fa-telegram-plane"></i>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            };
        },
        methods: {
            sendText(e) {
                e.preventDefault();
                
                if (this.message == '') {
                    return;
                }

                this.$emit('sendtext', this.message);
                this.message = '';
            },
            sendFile() {
                var file = event.target.files[0];            
                this.$emit('sendfile', file);
            }
        }
    }
</script>

<style lang="scss" scoped>
.composer{
    position: relative;
    display: flex;
    width: 100%;
}
.composer textarea {
    width: 95%;
    height: 32px;
    margin-top: 10px;
    margin-left: 11px;
    margin-right: 6px !important;
    resize: none;
    border-radius: 3px;
    padding-left: 12px;
    padding-top: 4px;
    overflow-y: hidden;
    border: 1px solid #cccccca1;
    box-shadow: 8px 4px 15px #ccccccd4;
    &::placeholder{
        font-family: "ProximaNova";
        color: #000;
        opacity: 0.7;
    }
    &:focus{
            box-shadow: 8px 4px 15px #ccccccad;
    }
}
.sendFile{
    display: none;
}
.sent_icon{
    cursor: pointer;
    float: right;
    color: #ffffff;
    font-size: 22px;
    font-weight: 400;
    box-shadow: 1px 1px 0px #b99000;
    border-radius: 3px;
    background-color: #f6bf00;
    padding: 6px 11px 3px 10px;
    width: 44px;
    height: 30px;
    margin-top: 11px;
}
.attach_file{
    float: left;
    opacity: 0.32;
    color: #f6bf00;
    font-size: 20px;
    margin-top: 16px;
    cursor: pointer;
}
@media screen and (max-width: 600px) {
    .composer{
        margin-bottom: 13px;
    }
}
</style>

