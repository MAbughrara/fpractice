<template>

        <div :id="'reply-'+id" class="card card-default">
            <div class="card-header">
                <div class="level">
                    <h5 class="flex">
                        <a :href="'/profiles/'+data.owner.name" v-text="data.owner.name">
                        </a>  said {{data.created_at}}..
                    </h5>

                    <div>
                        <!--<favorite :reply="{{reply}}"></favorite>-->

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div v-if='editing'>
                    <div class="form-group">
                 <textarea name="body" v-model="body" class="form-control">
            </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" @click="update">Update</button>
                    <button class="btn btn-sm btn-link" @click="editing=false">Cancel</button>

                </div>
                <div v-else v-text="body">
                </div>

            </div>

            <!--@can('update',$reply)-->
            <!--<div class="card card-footer">-->

                <!--<div class="level">-->
                    <!--<button class="btn btn-sm mr-2" @click="editing=true">Edit</button>-->
                    <!--<button class="btn btn-sm btn-danger mr-2" @click="destroy">Delete</button>-->

                <!--</div>-->

            <!--</div>-->
            <!--@endcan-->
        </div>
</template>

<script>
    import Favorite from './Favorite.vue';
    export default {
        props:['data'],
        components:{Favorite},
        data(){
            return {
                editing: false,
                id:this.data.id,
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
