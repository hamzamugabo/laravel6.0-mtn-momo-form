@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card">
                <div class="card-header" style="font-size: 20px; background-color: darkgrey;">{{ __('Support Us') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('store_path')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Party ID Type') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="partyidtype" value="" required autocomplete="partyidtype" placeholder="MSISDN" autofocus>


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="produce name" class="col-md-4 col-form-label text-md-right">{{ __('Party ID') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="partyid" value="" required autocomplete="partyid" placeholder="Phone Number" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Currency') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control " name="currency" required autocomplete="currency" value="" placeholder="EUR">


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control " name="amount" required autocomplete="amount" value="100" placeholder="100">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Payer Message') }}</label>
                            <textarea class="form-control rounded-0" id="" name="payermessage" rows="3"></textarea>

                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Payee Note') }}</label><textarea class="form-control rounded-0" id="" name="payeenote" rows="3"></textarea>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark" value="donate" >
                                    {{ __('Donate') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>


    </div>
@endsection