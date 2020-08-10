<template>
    <div class="contacts-list">
        <ul>
            <li v-if="contacts.length == 0" class="contact_none">
                <img src="/cabinet/images/clock.png" alt="img"/>
                <p>Скоро здесь появятся
                    ответы от авторазборок</p>
            </li>
            <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected': contact == selected }">
                <div class="avatar">
                    <img :src="'/cabinet/storage/images/smalls/100x100/' + `${contact.avatar[0].name != undefined ? contact.avatar[0].name : '/cabinet/images/avatar.png'}`" class="rounded-circle" alt="Изоображение">
                </div>
                <div class="contact">
                    <p class="name">{{ contact.settings.name != undefined ? contact.settings.name : ''}}</p>
                </div>
                <span class="badge badge-pill badge-info unread" v-if="contact.unread">{{ contact.unread }}</span>
            </li>
        </ul>
    </div>
</template>

<script> 
    export default {
        props: {
            contacts: {
                type: Array,
                default: []
            },
            messages: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                selected: {},
            };
        },
        methods: {
            selectContact(contact) {
                this.selected = contact;
                this.$emit('selected', contact);
            }
        },
        computed: {
            sortedContacts() {
                return _.sortBy(this.contacts, [(contact) => {
                    return contact.unread;
                }]).reverse();
            }
        }
    }
</script>

<style lang="scss" scoped>
.contacts-list {
    min-width: 270px;
    max-width: 270px;
    background: #fafafa;
    overflow-y: scroll;
    &::-webkit-scrollbar { 
        width: 0;
    }
    ul{
        padding: 0 !important;
        margin: 0 !important;
        position: relative;
        li{
            cursor: pointer;
            position: relative;
            margin-top: 10px;
            display: flex;
            list-style: none;
            width: 110%;
            height: 70px; 
            .contact{
                .name{ 
                    margin-left: 12px;
                }
            }
            .avatar{
                position: relative;
                border-radius: 50%;
                margin-left: 21px;
                img{
                    width: 41px;
                    margin-top: 14px;
                    height: 41px;
                    overflow: hidden;
                    border: 1px solid #fff;
                    -webkit-transform: scale(1.3);
                    transform: scale(1.3);
                }
                .rounded-circle {
                    border: 2px solid rgb(255, 255, 255); z-index: 1;
                }
            }

            .unread{
                height: 16px;
                margin-left: 8px;
                padding-right: 0.6em!important;
                padding-left: 0.5em!important;
                background-color: #3a7cd1!important;
            }
            
            .contact{
                margin-top: 17px;
                color: #535353;
                font-family: "ProximaNova";
                font-size: 14px;
                font-weight: 600;
                margin-left: 2px;
            }
        }
        .selected{
            background: #fdf2cc;
            width: 110%;
            height: 70px;
            -webkit-clip-path: polygon(0% 0%, 75% 0%, 81% 50%, 75% 100%, 0% 100%);
            clip-path: polygon(0% 0%, 75% 0%, 81% 50%, 75% 100%, 0% 100%);
            &:after{
                content: "";
                position: absolute;
                background: #fdf2cc;
                width: 20%;
                height: 100%;
                left: 100%;
                top: 0px;
                -webkit-clip-path: polygon(50% 50%, 0 0, 0 100%);
                clip-path: polygon(50% 50%, 0 0, 0 100%);
            }   
        }
    }
    .contact_none{
        background: #fdf2cc;
        width: 110%;
        height: 70px;
        -webkit-clip-path: polygon(0% 0%, 75% 0%, 81% 50%, 75% 100%, 0% 100%);
        clip-path: polygon(0% 0%, 75% 0%, 81% 50%, 75% 100%, 0% 100%);
        &:after{
            content: "";
            position: absolute;
            background: #fdf2cc;
            width: 16%;
            height: 100%;
            left: 100%;
            -webkit-clip-path: polygon(50% 50%, 0 0, 0 100%);
            clip-path: polygon(50% 50%, 0 0, 0 100%);
        }   
        img{
            width: 25px;
            height: 25px;
            margin-top: 24px;
            margin-left: 10px;
            margin-right: 8px;
        }
        p{
            margin-bottom: 0;
            font-family: "ProximaNova";
            line-height: 1.2;
            font-weight: 600;
            color: #63625e;
            margin-top: 18px;
            font-size: 14.25px;
            white-space: pre-line;
        }
    }
}
@media screen and (max-width: 600px) {
    .contacts-list{
        height: 87px;
        width: 100%;
    }
    .selected{   
        width: 100%!important;
        &:after{
            display: none;
        }   
    }
    .contact_none{
        width: 100%!important;
        &:after{ 
            display: none;
        }   
        p{
            margin-top: 22px;
            margin-left: 10px;
        }
    }
}
@media screen and (max-width: 402px) {
    .contact_none{
        p{
           margin-top: 15px; 
        }   
    }
}

</style>

