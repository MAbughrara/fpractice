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
                </div>
            </div>

            <div class="row ">
                <div class="col-md-8">
                    @foreach( $thread->replies as $reply)
                        @include('threads.reply')
                    @endforeach
                </div>
            </div>
        <hr>
        @if(auth()->check())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{$thread->path().'/replies'}}" method="post">
                        {{csrf_field()}}

                        <div class="form-group">
                        <textarea name="body" class="form-control" placeholder="Any word?!!"></textarea>
                        </div>
                        <button class="btn btn-default" type="submit">Reply</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <p class="text-center">Please <a href='{{route('login')}}'>sign in </a>to participate in this discussion.</p>
    @endif
@endsection
