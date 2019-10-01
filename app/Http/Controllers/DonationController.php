<?php

namespace App\Http\Controllers;

use App\MtnPayment;
use App\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Bmatovu\MtnMomo\Products\Collection;

class DonationController extends Controller
{
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

        $user1 = Auth::user();
        $donate = Donation::create([
            'user_id'=>$user1['id'],
            'currency'=>$request->currency,
            'amount'=>$request->amount,
        ]);

        $donate->save();

        try {
            $collection = new Collection();
        } catch (\Exception $e) {
        }

        $transactionId = env('MOMO_COLLECTION_ID');

        $momoTransactionId =  $collection->transact($transactionId, $request->input(['partyid']), $donate->amount, 'payer_message','payee_note');

        $transactionStatus = $collection->getTransactionStatus($momoTransactionId);

        $this->store_payment($momoTransactionId,$transactionStatus,$donate);

    }

    /**
     * @param $momoTransactionId
     * @param $transactionStatus
     * @param $donate
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store_payment($momoTransactionId,$transactionStatus,$donate)
    {
        $momopayment = MtnPayment::create([
            'donation_id'=>$donate['id'],
            'status'=>$transactionStatus['status'],
            'id'=>$momoTransactionId,
            'amount'=>$transactionStatus['amount'],
            'currency'=>$transactionStatus['currency'],
            'reason' => isset($transactionStatus['reason']) ? $transactionStatus['reason'] : null,
            'payer_message'=>$transactionStatus['payerMessage'],
            'payee_note'=>$transactionStatus['payeeNote'],
            'party_id_type'=>$transactionStatus['payer']['partyIdType'],
            'party_id'=>$transactionStatus['payer']['partyId'],
        ]);

        $momopayment->save();

        return $this->index();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $mtn_payments= MtnPayment::all();
        return view('mtn-mom.view',['mtn_payments'=>$mtn_payments]);
    }

}
