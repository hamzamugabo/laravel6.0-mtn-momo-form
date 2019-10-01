@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($mtn_payments as $mtn_payment)
    <div class="card">
        <div class="card-header">
            Transaction was Successful
        </div>

        <div class="card-body">
           <span class="font-weight-bold">Phone Number: </span>{{$mtn_payment->party_id}}<br>
           <span class="font-weight-bold">Status: </span>{{$mtn_payment->status}}<br>
            <span class="font-weight-bold">Reason:</span> {{$mtn_payment->reason}}<br>

        </div>
            @endforeach
    </div>
</div>
@endsection
