@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <a href="#">{{$thread->creator->name}}</a> posted:
                        {{$thread->title}}</div>
                    <div class="card-body">
                        <article>
                            <div class="body">
                                {{$thread->body}}
                            </div>
                        </article>
                    </div>
                </div>

                @foreach( $replies as $reply)
                    @include('threads.reply')
                @endforeach

                {{$replies->links()}}
                <hr>
                @if(auth()->check())

                    <form action="{{$thread->path().'/replies'}}" method="post">
                        {{csrf_field()}}

                        <div class="form-group">
                            <textarea name="body" class="form-control" placeholder="Any word?!!"></textarea>
                        </div>
                        <button class="btn btn-default" type="submit">Reply</button>
                    </form>
            </div>

            <div class="col-md-4">
                <div class="card card-default">
                    <div class="card-header">
                        This Thread publish:
                        {{$thread->created_at->diffForHumans()}}
                        By:
                        <a href="#">{{$thread->creator->name}}</a>, and currently
                         has {{$thread->replies_count}} {{str_plural('comment',$thread->replies_count)}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
        <p class="text-center">Please <a href='{{route('login')}}'>sign in </a>to participate in this discussion.
        </p>
    @endif
@endsection
