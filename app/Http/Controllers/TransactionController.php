<?php

namespace App\Http\Controllers;

use App\MtnPayment;
use App\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Bmatovu\MtnMomo\Products\Collection;

class TransactionController extends Controller
{
    public $momoTransactionId;

    public function index()
    {
        $transacts= Donation::all();
        return view('mtn-mom.view',['transacts'=>$transacts]);
    }

    public function create()
    {
        return view('mtn-mom.supportform');
    }


    /**
     * @param Request $request
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'user_id' => ['uuid','min:30',],
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

        $payer = 'Payer transaction history message';
        $payee = 'Payee transaction history message';

        $transact = MtnPayment::create([
//             'user_id'=>Str::uuid()->toString(),
            'party_id'=>$request->partyid,
            'amount'=>$request->amount,

        ]);
        $transact->save();

        try {
            $collection = new Collection();
        } catch (\Exception $e) {
        }
        $transactionId = env('MOMO_COLLECTION_ID');


        $momoTransactionId =  $collection->transact($transactionId, $transact->party_id, $transact->amount, 'payer_message','payee_note');

        $transactionStatus = $collection->getTransactionStatus($momoTransactionId);

        $this->store_payment($momoTransactionId,$transactionStatus,$transact);
//        return response()->json($transactionStatus);
    }

    public function store_payment($momoTransactionId,$transactionStatus,$transact)
    {
//        dd($transactionStatus);
        $momopayment = Donation::create([
            'donation_id'=>$transact['id'],
            'status'=>$transactionStatus['status'],
            'id'=>$momoTransactionId,
            'amount'=>$transactionStatus['amount'],
            'currency'=>$transactionStatus['currency'],
            'reason'=>$transactionStatus['reason'],
            'payer_message'=>$transactionStatus['payerMessage'],
            'payee_note'=>$transactionStatus['payeeNote'],
            'party_id_type'=>$transactionStatus['payer']['partyIdType'],
            'party_id'=>$transactionStatus['payer']['partyId'],
        ]);
        $momopayment->save();
        dd($momopayment);
        $this->update($momopayment);
//       return dd($transactionStatus);
//        return response()->json([dd($transactionStatus)]);
//        return redirect()->route('update_paths');
    }

//    public function update($momopayment)
//    {
//        $momo_payments = Donation::find(1);
//        $donations = MtnPayment::create([]);
//        $donations->mtn_id =$momo_payments->id;
//        $donations->update();
//        return response()->json($donations);
//    }
}
