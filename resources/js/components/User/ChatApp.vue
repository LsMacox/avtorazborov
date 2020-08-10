<template>
    <div class="chat-app">
        <ContactsList ref="contactList" :contacts="contacts" @selected="startConversationWith" :messages="messages"/>
        <Conversation :proposal="proposal" :user="user" :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactsList from './ContactsList';

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
                selectedContact: {},
                messages: [],
                file_progress: null,
                contacts: [],
            };
        },
        async mounted() {

            await axios.get(this.$routes.route('user.message.get-contacts', { proposal_id: this.proposal.id }))
            .then((response) => {
                console.log(response.data);
                this.contacts = response.data;
                this.contacts.length > 0 ? this.$refs.contactList.selectContact(this.contacts[0]) : '';
            });

            Echo.private(`messages.${this.user.id}.${this.proposal.id}`)
                .listen('NewMessage', (e) => {
                    this.handleIncoming(e.message);
                });

        },
        methods: {
            async startConversationWith(contact) {

                this.updateUnreadCount(contact, true);
                this.selectedContact = contact;

                await axios.get(this.$routes.route('user.message.get-messages', { from_id: contact.id, proposal_id: this.proposal.id }))
                .then((response) => {
                    this.messages = response.data;
                });

            },
            saveNewMessage(message) {
                this.messages.push(message);
            },
            handleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }

                this.updateUnreadCount(message.from, false);
            },
            updateUnreadCount(contact, reset) {

                this.contacts = this.contacts.map((single) => {

                    if (single.id !== contact.id) {
                        return single;
                    }

                    if (reset)
                        single.unread = 0;
                    else
                        single.unread += 1;


                    return single;
                });

            }
        },
        components: {Conversation, ContactsList}
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
