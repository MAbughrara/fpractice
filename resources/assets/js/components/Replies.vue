<template>

    <div>
        <div v-for="(reply ,index) in items">
            <Reply :data="reply" @deteted="remove(index)"></Reply>
        </div>

        <new-reply  @created='add'></new-reply>
    </div>
</template>

<script>
    import Reply from './Reply.vue';
    import NewReply from './NewReply.vue';
    export default {

        props:['data'],
        components:{Reply,NewReply},


        data(){
            return{
                items: this.data
            }
        },
        methods:{
            add(reply){
                this.items.push(reply);
            },
            remove(index){
                this.items.splice(index,1);
                flash('Reply was delted');
            },
        }
    }
</script>
