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
                                <label for="title">Thread Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Thread body</label>
                                <textarea name="body"  class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Publish</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
