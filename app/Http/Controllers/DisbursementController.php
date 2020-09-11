<?php

namespace App\Http\Controllers;

use App\Disbursement;
use App\Util\FlipAPIService;
use Illuminate\Http\Request;

class DisbursementController extends Controller
{

    protected $apiService;

    public function __construct(FlipAPIService $service)
    {
        $this->apiService = $service;
    }

    public function index()
    {
        return view('index');
    }

    public function send(Request $request)
    {
        
        $request->validate([
            'bank_code' => 'required',
            'account_number' => 'required',
            'amount' => 'required',
            'remark' => 'required',
        ]);
        
        $data = [
            'bank_code' => $request->bank_code,
            'account_number' => $request->account_number,
            'amount' => $request->amount,
            'remark' => $request->remark
        ];
        
        $result = json_encode($this->apiService->sendDisbursement($data));
        $body = collect();

        try {
            $disbursement = new Disbursement();
    
            $disbursement->id = $body->id;
            $disbursement->amount = $body->amount;
            $disbursement->status = $body->status;
            $disbursement->bank_code = $body->bank_code;
            $disbursement->account_number = $body->account_number;
            $disbursement->beneficiary_name = $body->beneficiary_name;
            $disbursement->remark = $body->remark;
            $disbursement->receipt = $body->receipt;
            $disbursement->time_served = $body->time_served;
            $disbursement->fee = $body->fee;
            $disbursement->timestamp = $body->timestamp;

            $output = $disbursement->save();
        } catch (\Throwable $th) {
            //throw $th;
        }
        return redirect()->back();
    }

    public function check($id)
    {
        $result = $this->apiService->getDisbursementStatus($id);

        
        try {
            $body = collect();
    
            $disbursement = Disbursement::findOrFail($id);
    
            $disbursement->id = $body->id;
            $disbursement->amount = $body->amount;
            $disbursement->status = $body->status;
            $disbursement->bank_code = $body->bank_code;
            $disbursement->account_number = $body->account_number;
            $disbursement->beneficiary_name = $body->beneficiary_name;
            $disbursement->remark = $body->remark;
            $disbursement->receipt = $body->receipt;
            $disbursement->time_served = $body->time_served;
            $disbursement->fee = $body->fee;
            $disbursement->timestamp = $body->timestamp;
    
            $output = $disbursement->save();
    
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
