<template>

    <div>
        <div v-for="(reply ,index) in items">
            <Reply :data="reply" @deteted="remove(index)"></Reply>
        </div>
    </div>
</template>

<script>
    import Reply from './Reply.vue';
    export default {

        props:['data'],
        components:{Reply},


        data(){
            return{
                items: this.data
            }
        },
        methods:{
            remove(index){
                this.items.splice(index,1);
                flash('Reply was delted');
            },
        }
    }
</script>
