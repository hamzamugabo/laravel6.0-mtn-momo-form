@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{--@foreach($donations as $donation)--}}
                {{$donations->name}}

                {{--@endforeach--}}

        </div>

    </div>
@endsection