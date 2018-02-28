@extends('layouts.app')

@section('content')
    <div class="container">

        <h3>
            {{$profileUser->name}}
        </h3>
        <div class="row">
            <div class="col-md-8 offset-2">

                @foreach($activities as $date=>$activity)
                   <h3>
                       {{$date}}
                   </h3>
                    @foreach($activity as $record)
                        @include("profiles.activities.{$record->type}",['activity'=>$record])
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

@endsection
