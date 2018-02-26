@extends('layouts.app')

@section('content')
    <div class="container">

        <h3>
            {{$profileUser->name}}
        </h3>
        <div class="row">
            <div class="col-md-8">

                @foreach($threads as $thread)
                <div class="card card-default">
                    <div class="card-header">
                    <div class="level">
                        <span class="flex">
                               <a href="#">{{$thread->creator->name}}</a> posted:
                            {{$thread->title}}

                        </span>
                        <span>
                            {{$thread->created_at->diffForHumans()}}
                        </span>


                    </div>


                    </div>
                    <div class="card-body">
                        <article>
                            <div class="body">
                                {{$thread->body}}
                            </div>
                        </article>
                    </div>
                </div>
                @endforeach
                {{$threads->links()}}
            </div>
        </div>
    </div>

@endsection
