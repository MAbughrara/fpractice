<template>

    <div>
        <div v-for="reply in items">
            <reply :data="reply"></reply>
        </div>
    </div>
</template>

<script>
    import reply from './reply.vue';
    export default {

        props:['data'],
        components:{reply},


        data(){
            return{
                items: this.data
            }
        }

    }
</script>
