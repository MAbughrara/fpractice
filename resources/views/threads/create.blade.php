@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Crate Forum</div>
                    <div class="card-body">
                        <form action="/threads" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="title">Select Channel</label>
                                <select name="channel_id" id="" class="form-control" required>
                                    <option value="">choas one</option>
                                    @foreach($channels as $channel)
                                        <option value="{{$channel->id}}" {{old('channel_id') == $channel->id?'selected':''}}>
                                            {{$channel->name}}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="title">Thread Title</label>
                                <input type="text"  name="title" class="form-control" value="{{old('title')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Thread body</label>
                                <textarea name="body"  class="form-control" cols="30" rows="10" required>{{old('body')}} </textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Publish</button>
                            </div>
                            @if(count($errors))
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                                </ul>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
