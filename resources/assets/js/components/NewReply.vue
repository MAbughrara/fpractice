<template>

        <div class="form-group">

            <textarea
                    id="body"
                    name="body"
                    v-model='body'
                    class="form-control"
                    required
                    placeholder="Any word?!!">
            </textarea>
            <button class="btn btn-default"
            type="submit"
            @click='addreply'>Reply</button>
        </div>

</template>

<script>
    export default {

        data(){
            return{
                body:'',
                endpoint:'/threads/molestiae/6'
            };
        },

        methods:{
            addreply(){

                axios.post(this.endpoint,{body:this.body})
                    .then(({data})=>{
                        this.body='';
                        flash('Your reply has been posted');
                        this.$emit('created',data)
                });
            }
        }

    }
</script>
