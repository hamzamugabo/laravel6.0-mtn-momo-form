@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            message
        </div>

        <div class="card-body">
           Y'ello.Dial *165*3#, select My Approvals to authorise payment of EURO<br>
           <span class="font-weight-bold"> </span><br>

           <span class="font-weight-bold">Transaction Status: </span>{{$mtn_payments->status}}<br>
            <span class="font-weight-bold">Reason:</span> {{$mtn_payments->reason}}<br>

        </div>

        <a href="{{url('/')}}">
            <button type="button" class="btn btn-success">Back Home</button>
        </a>
    </div>
</div>
@endsection
