@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header" style="font-size: 20px; background-color: darkgrey;">{{ __('Enter your donation') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form method="POST" action="{{route('store_path')}}" >
                            @csrf

                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                                <div class="col-md-6">

                                    <div class="input-group">
                                        <input type="text" name="amount" class="form-control mr-auto" aria-label="Amount (to the nearest dollar)" style="text-align:right;">
                                        <div class="input-group-append">
                                            <span class="input-group-text">0.0</span>
                                            <span class="input-group-text">€</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="produce name" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+256</span>
                                        </div>
                                        <input type="text" class="form-control" name="phone" aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>
                                <div class="col-md-6">
                                <textarea class="form-control rounded-0" id="" name="remark" rows="3" ></textarea>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" >Total</div>
                <div class="card-body">
        </div>
    </div>
</div>
@endsection
