<template>

        <div v-if="signedIn">
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
            @click='addReply'>Reply</button>
        </div>
        </div>

</template>

<script>
    export default {
        data(){
            return{
                body:'',
                endpoint:'/threads/modi/14/replies'
            };
        },

        computed:{

            signedIn(){
                return Window.App.signedIn;
            }

        },

        methods:{
            addReply(){

                axios.post(this.endpoint,{
                    body:this.body
                })
                    .then(({data})=>{
                        this.body='';
                        flash('Your reply has been posted');
                        this.$emit('created',data)
                });
            }
        }

    }
</script>
