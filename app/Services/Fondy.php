<?php

namespace App\Services;

use App\Models\Executor;
use App\Models\Package;
use Cloudipsp\Checkout;
use Cloudipsp\Configuration;

class Fondy
{
    public static function buy($id, $executor_id)
    {
        Configuration::setMerchantId(env('SET_MERCHANT_ID_FONDY'));
        Configuration::setSecretKey(env('SET_SECRET_KEY_FONDY'));

        $package = Package::findOrFail($id);
        $executor = Executor::findOrFail($executor_id);

        $data = [
            'order_desc' => "Package payment: " . $package->name,
            'currency' => 'UAH',
            'amount' => round($package->price) * 100,
            'response_url' => route('responseurl'),
            'server_callback_url' => route('callbackurl'),
            'sender_email' => $executor->email,
            'lang' => app()->getLocale(),
            'product_id' => $package->id,
            'lifetime' => 36000,
            'merchant_data' => array(
                'executor_id' => $executor_id,
            )
        ];

        $url = Checkout::url($data);
        $url->toCheckout();

    }
}
