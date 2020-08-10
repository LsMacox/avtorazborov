<template>
    <div class="composer" style="display: flex; width: 100%;">
        <i class="attach_file fas fa-paste"  @click="$refs.file.click()"></i>   
        <input ref="file" class="sendFile" type="file" @change="sendFile">
        <textarea style="width: 95%; margin-right: 20px" v-model="message" @keydown.enter="sendText" placeholder="Напишите ваш ответ здесь"></textarea>
        <i style="width: 44px; height: 27px; margin-top: 11px;" @click="sendText" class="sent_icon fab fa-telegram-plane"></i>
    </div>
</template>

<script>
    export default { 
        props: {
            user: {
                type: Object,
                required: true
            }
        },
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
            async sendFile() {
                var file = event.target.files[0];            
                await this.$emit('sendfile', file);
            }
        }
    }
</script>

<style lang="scss" scoped>
.composer{
    display: flex;
    position: relative;
    max-width: 600px;
}
.composer textarea {
    width: 95%;
    height: 32px;
    margin-top: 10px;
    margin-left: 14px;
    margin-right: 6px!important;
    resize: none;
    border-radius: 3px;
    padding-left: 12px;
    padding-top: 4px;
    overflow-y: hidden;
    border: 1px solid #cccccca1;
    &::placeholder{
        font-family: "ProximaNova";
        color: #000;
        opacity: 0.7;
    }
    &:focus{
        box-shadow: none;
    }
}
.sent_icon{
    cursor: pointer;
    float: right;
    color: #ffffff;
    height: 30px !important;
    font-size: 22px;
    font-weight: 400;
    box-shadow: 2px 2px 0px #0f6815b3;
    border-radius: 3px;
    background-color: #81cc79;
    padding: 6px 11px 3px 10px;
}
.sendFile{
    display: none;
}
.attach_file{
    float: left;
    color: #daedd2;
    font-size: 20px;
    margin-top: 18px;
    cursor: pointer;
}
@media screen and (max-width: 768px) {
    .composer{
        margin-bottom: 13px;
    }
}
</style>

