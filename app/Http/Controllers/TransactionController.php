<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transacts= Transaction::all();
        return view('mtn-mom.view',['transacts'=>$transacts]);
    }

    public function create()
    {
        return view('mtn-mom.supportform');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['uuid','min:30',],
            'mtn_external_id' => 'uuid',
            'party_id_type' => 'sometimes|required|string',
            'phone_number' => ['string','min:10'],
            'currency' => 'required|string',
            'status' => 'required|string',
            'amount' => 'required|integer',
            'payer_message' => 'sometimes|required|string',
            'payee_note' => 'sometimes|required|string',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $uuid2 = Str::uuid()->toString();
        $uuid = Str::uuid()->toString();

        $transact = Transaction::create([
             'user_id'=>$uuid2,
             'mtn_external_id'=>$uuid,
            'party_id_type'=>$request->partyidtype,
            'phone_number'=>$request->partyid,
            'currency'=>$request->currency,
            'status'=>$request->status,
            'amount'=>$request->amount,
            'payer_message'=>$request->payermessage,
            'payee_note'=>$request->payeenote,

        ]);
        $transact->save();

        return redirect()->route('display_path');

    }
}
