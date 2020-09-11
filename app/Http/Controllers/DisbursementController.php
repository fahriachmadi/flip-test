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
        
        $result = $this->apiService->sendDisbursement($data);
        
    }

    public function check($id)
    {
        $result = $this->apiService->getDisbursementStatus($id);

    }
}
