<template>
    <div class="chat-app">
        <Conversation v-if="!loading" :proposal="proposal" :user="user" :contact="contact" :messages="messages" @new="saveNewMessage"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';

    export default {
        props: {
            user: {
                type: Object,
                required: true
            },
            proposal: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                messages: [],
                contact: {},
                loading: true,
            };
        },
        async mounted() {
            await this.startConversationWith();

            Echo.private(`messages.${this.user.id}.${this.proposal.id}`)
                .listen('NewMessage', (e) => {
                    this.handleIncoming(e.message);
                });
        },
        methods: {
            async startConversationWith() {

                await axios.get(this.$routes.route('shop.message.get-contact', { proposal_id: this.proposal.id }))
                .then((response) => {
                    this.contact = response.data[0];
                });

                await axios.get(this.$routes.route('shop.message.get-messages', { from_id: this.contact.id, proposal_id: this.proposal.id }))
                .then((response) => {
                    this.messages = response.data;
                    this.loading = false;
                });

            },
            saveNewMessage(message) {
                this.messages.push(message);
            },
            handleIncoming(message) {
                if (this.contact && message.from == this.contact.id) {
                    this.saveNewMessage(message);
                    return;
                }
            }
        },
        components: {Conversation}
    }
</script>


<style lang="scss" scoped>
.chat-app {
    display: flex;
}
@media screen and (max-width: 600px){
    .chat-app {
        flex-direction: column;
    }
}
</style>
