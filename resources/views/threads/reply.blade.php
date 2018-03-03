<reply :attributes="{{$reply}}" inline-template  v-cloak>


<div id="reply-{{$reply->id}}" class="card card-default">
    <div class="card-header">
        <div class="level">
            <h5 class="flex">
                <a href="/profiles/{{$reply->owner->name}}" >{{$reply->owner->name}}</a>  said
                {{$reply->created_at->diffForHumans()}}
            </h5>

        <div>
            <form action="/replies/{{$reply->id}}/favorites" method="POST">
                {{csrf_field()}}
                <button type="submit" class="btn btn-default"  {{$reply->isFavorited()? 'disabled':''}}>
                    {{$reply->favorites_count}} {{str_plural('favorite',$reply->favorites_count)}}

                </button>
            </form>
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

    @can('update',$reply)
    <div class="card card-footer">

        <div class="level">
            <button class="btn btn-sm mr-2" @click="editing=true">Edit</button>
            <button class="btn btn-sm btn-danger mr-2" @click="destroy">Delete</button>

        </div>

    </div>
        @endcan
</div>
</reply>