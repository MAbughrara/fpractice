<template>

</template>

<script>
    import favorite from './Favorite.vue';
    export default {
        props:['data'],
        components:{favorite},
        data(){
            return {
                editing: false,
                body:this.data.body
            };
        },

        methods:{
            update(){
                axios.patch('/replies/'+ this.data.id,{
                    body: this.body

                });

                this.editing=false;

                flash('updated successfully');
            },
            destroy(){
                axios.delete('/replies/'+ this.data.id);
                $(this.$el).fadeOut(300,()=>{
                    flash('updated successfully');
            });
            },
        }

    }
</script>
