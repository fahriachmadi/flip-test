<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
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
            
        
        $body = $this->apiService->sendDisbursement($data);
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
            $disbursement->save();
            
            return ApiBaseMethod::sendResponse($disbursement, null);
        } catch (\Exception $e) {
            return ApiBaseMethod::sendError($e->getMessage(), [], 500);
        }
    }

    public function status($id)
    {
        try {
            $disbursement = Disbursement::where('id', $id)->first();

            if(!$disbursement) {
                return ApiBaseMethod::sendError('Transaction Not Found');
            }

            $body = $this->apiService->getDisbursementStatus($id);

            $disbursement->status = $body->status;
            $disbursement->receipt = $body->receipt;
            $disbursement->time_served = $body->time_served;
            $output = $disbursement->save();

            return ApiBaseMethod::sendResponse($disbursement, null);
        } catch (\Exception $e) {
            return ApiBaseMethod::sendError($e->getMessage(), [], 500);
        }
    }
}
