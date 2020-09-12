<?php

namespace App\Jobs;

use App\Disbursement;
use App\Util\FlipAPIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DisbursementRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $apiService;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->apiService = new FlipAPIService();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $body = $this->apiService->sendDisbursement($this->data);

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

        return $disbursement;
    }
}
