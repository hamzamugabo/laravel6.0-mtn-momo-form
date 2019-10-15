<?php

namespace App\Http\Controllers;


use App\MtnPayment;
use App\Donation;
use App\User;
use Illuminate\Support\Facades\DB;
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
            'phone_number' => ['string', 'min:10'],
            'amount' => 'sometimes|required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user1 = Auth::user();
        $donate = Donation::create([
            'user_id' => isset($user1['id']) ? $user1['id'] : null,
            'remarks' => $request->remark,
            'phone_number' => $request->phone,
            'amount' => $request->amount,
        ]);
        $donate->save();

        try {
            $collection = new Collection();
        } catch (\Exception $e) {
        }

        $transactionId = env('MOMO_COLLECTION_ID');

        $momoTransactionId = $collection->transact($transactionId, $request->input(['phone']), $donate->amount, 'payer_message', 'payee_note');

        $transactionStatus = $collection->getTransactionStatus($momoTransactionId);


        return $this->store_payment($momoTransactionId, $transactionStatus, $donate, $user1);
    }

    /**
     * @param $momoTransactionId
     * @param $transactionStatus
     * @param $donate
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store_payment($momoTransactionId, $transactionStatus, $donate, $user1)
    {
        $mtn_payment = MtnPayment::create([
            'donation_id' => $donate['id'],
            'status' => $transactionStatus['status'],
            'id' => $momoTransactionId,
            'amount' => $transactionStatus['amount'],
            'currency' => $transactionStatus['currency'],
            'reason' => isset($transactionStatus['reason']) ? $transactionStatus['reason'] : null,
            'payer_message' => $transactionStatus['payerMessage'],
            'payee_note' => $transactionStatus['payeeNote'],
            'party_id_type' => $transactionStatus['payer']['partyIdType'],
            'party_id' => $transactionStatus['payer']['partyId'],
        ]);

        $mtn_payment->save();


        return $this->index($mtn_payment);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($mtn_payment)
    {
        $mtn_payments = DB::table('mtn_payments')->latest()->first();
//        dd($mtn_payments->status);
        return view('mtn-mom.view',['mtn_payments'=>$mtn_payments]);
    }

    public function display()
    {
        $users = User::all();
        $donations = Donation::all();
        return view('welcome', compact('donations', 'users'));
    }

}
