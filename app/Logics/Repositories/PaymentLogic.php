<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\PaymentLogicInterface;
use App\Models\Executor;
use App\Models\Package;
use App\Models\Payment;
use App\Notifications\Admin\NewPaymentNotification;
use App\Notifications\Executor\ExecutorNewPaymentNotification;
use Carbon\Carbon;
use Cloudipsp\Result\Result;
use Illuminate\Support\Facades\Notification;

class PaymentLogic implements PaymentLogicInterface
{

    protected $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function all(){

        $payments = Payment::paginate(20);

        return ['payments' => $payments];
    }

    public function index($id){

        $payments = Payment::where('executor_id', $id)->paginate(10);
        $pro_payment = Payment::where('executor_id', $id)->get()->last();

        return ['payments' => $payments, 'pro_payment' => $pro_payment];
    }

    public function responseurl()
    {
        $result = new Result;
        $data = $result->getData();
        $executor_id = json_decode($data['merchant_data'])->{'executor_id'};
        info($data);
        $package = Package::findOrFail((int)$data['product_id']);

        Notification::send(get_list_admin(), new NewPaymentNotification($data));

        if (check_premium($executor_id)) {
            return false;
        }else{
            Payment::create([
                'payment_id' => $data['payment_id'],
                'order_id' => $data['order_id'],
                'executor_id' => $executor_id,
                'response_signature_string' => $data['response_signature_string'],
                'response_description' => $data['response_description'],
                'amount' => $data['amount'] / 100,
                'type' => $package->name,
                'package_id' => $package->id,
                'response_status' => $data['response_status'],
                'order_status' => $data['order_status'],
                'start' => Carbon::now()->format('Y-m-d'),
                'finish' => Carbon::now()->addDays($package->days)->format('Y-m-d'),
            ]);

            get_user($executor_id)->notify(new ExecutorNewPaymentNotification($data));

            if ($data['order_status'] == 'approved' and $data['response_status'] == 'success') {

                Executor::findOrFail($executor_id)
                    ->update(['package_id' => (int)$data['product_id']]);

                return true;
            } else {
                return false;
            }
        }
    }
//  "rrn" => ""
//  "masked_card" => "444455XXXXXX1111"
//  "sender_cell_phone" => ""
//  "sender_account" => ""
//  "currency" => "UAH"
//  "fee" => ""
//  "reversal_amount" => "0"
//  "settlement_amount" => "0"
//  "actual_amount" => "50000"
//  "response_description" => ""
//  "sender_email" => "executor@executor.executor"
//  "order_status" => "approved"
//  "response_status" => "success"
//  "order_time" => "28.09.2021 14:05:45"
//  "actual_currency" => "UAH"
//  "order_id" => "1396424_662124307552937d405dde5f5f5018db"
//  "tran_type" => "purchase"
//  "eci" => "5"
//  "settlement_date" => ""
//  "payment_system" => "card"
//  "approval_code" => "583909"
//  "merchant_id" => "1396424"
//  "settlement_currency" => ""
//  "payment_id" => "448004481"
//  "card_bin" => "444455"
//  "response_code" => ""
//  "card_type" => "VISA"
//  "amount" => "50000"
//  "signature" => "e812e635ab83e47b3d69dfdfc427a30b87318ce7"
//  "product_id" => "2"
//  "merchant_data" => "{"executor_id":2}"
//  "rectoken" => ""
//  "rectoken_lifetime" => ""
//  "verification_status" => ""
//  "parent_order_id" => ""
//  "response_signature_string" => "**********|50000|UAH|50000|583909|444455|VISA|UAH|5|444455XXXXXX1111|{"executor_id":2}|1396424|1396424_662124307552937d405dde5f5f5018db|approved|28.09.2021 14:05:45|448004481|card|2|success|0|executor@executor.executor|0|purchase

}
