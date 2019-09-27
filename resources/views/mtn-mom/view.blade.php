@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        @foreach($transacts as $transact)
        <div class="card-header">
            Transaction
        </div>

        <div class="card-body">
           <span class="font-weight-bold">User ID: </span>{{$transact->user_id}}<br>
            <span class="font-weight-bold">Mtn external ID:</span> {{$transact->mtn_external_id}}<br>
            <span class="font-weight-bold"> Status:</span> {{$transact->status}}<br>
            <span class="font-weight-bold">Party ID type:</span>{{$transact->party_id_type}}<br>
            <span class="font-weight-bold"> Phone Number: </span>{{$transact->phone_number}}<br>
            <span class="font-weight-bold">Currency:</span>{{$transact->currency}}<br>
            <span class="font-weight-bold"> Amount:</span>{{$transact->amount}}<br>
            <span class="font-weight-bold">Payer message:</span>{{$transact->payer_message}}<br>
            <span class="font-weight-bold">payee note:</span>{{$transact->payee_note}}<br>

        </div>
            @endforeach
    </div>
</div>
@endsection
