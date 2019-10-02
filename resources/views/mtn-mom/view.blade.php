@extends('layouts.app')

@section('content')
<div class="container">
    {{--@foreach($mtn_payments as $mtn_payment)--}}
    <div class="card">
        <div class="card-header">
            message
        </div>

        <div class="card-body">
            Dial *165# and select approval option.<br>

           {{--<span class="font-weight-bold"> </span>{{$mtn_payment->amount}}<br>--}}
           {{--<span class="font-weight-bold">Status: </span>{{$mtn_payment->status}}<br>--}}
            {{--<span class="font-weight-bold">Reason:</span> {{$mtn_payment->reason}}<br>--}}
            {{--<span class="font-weight-bold">Transaction Id:</span> {{$mtn_payment->id}}<br>--}}

        </div>
            {{--@endforeach--}}
        <a href="{{url('/')}}">
            <button type="button" class="btn btn-success">Back Home</button>
        </a>
    </div>
</div>
@endsection
