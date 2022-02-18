<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\PaymentTypeLogicInterface;
use App\Models\PaymentType;

class PaymentTypeLogic implements PaymentTypeLogicInterface
{

    protected $payment_type;

    public function __construct(PaymentType $payment_type){

        $this->payment_type = $payment_type;
    }

    public function all()
    {
        return $this->payment_type->paginate(20);
    }

    public function store($request)
    {
        $this->payment_type->create($request);
    }

    public function edit($id)
    {
      return $this->payment_type->findOrFail($id);
    }

    public function update($request, $id)
    {
        $this->payment_type->findOrFail($id)->update($request);
    }

}
