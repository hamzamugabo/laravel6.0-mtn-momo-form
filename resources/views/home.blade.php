@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 20px; background-color: darkgrey;">{{ __('Support Us') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form method="POST" action="{{route('store_path')}}" >
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Party ID Type') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control" id="partyidtype" name="partyidtype">
                                            <option>msisdn</option>
                                            <option disabled>email</option>
                                            <option disabled>party_code</option>
                                        </select>
                                    </div>
                                </div>

                            <div class="form-group row">
                                <label for="produce name" class="col-md-4 col-form-label text-md-right">{{ __('Party ID') }}</label>

                                <div class="col-md-6">
                                    <input list="contact" name="partyid" class="form-control">
                                    <datalist id="contact">
                                        <option value="46733123450">
                                        <option value="46733123451">
                                        <option value="46733123452">
                                        <option value="46733123453">
                                        <option value="46733123454">
                                    </datalist>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Currency') }}</label>

                                <div class="col-md-6">

                                    <input  type="text" class="form-control " name="currency" required autocomplete="currency" value="EUR" placeholder="EUR">


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control " name="amount" required autocomplete="amount" value="100" placeholder="100">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="status" name="status">
                                        <option>pending</option>
                                        <option>queue</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Payer Message') }}</label>
                                <div class="col-md-6">
                                <textarea class="form-control rounded-0" id="" name="payermessage" rows="3" disabled></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Payee Note') }}</label>
                                <div class="col-md-6">
                                <textarea class="form-control rounded-0" id="" name="payeenote" rows="3" disabled></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 mr-5">
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
</div>
@endsection
