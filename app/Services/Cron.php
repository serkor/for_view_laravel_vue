<?php

namespace App\Services;

use App\Models\Bid;
use App\Models\Executor;
use App\Models\Package;
use App\Notifications\Executor\ExecutorRequiredCloseBidNotification;
use App\Notifications\Executor\ExecutorDisablePackageNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Cron
{
    //todo => NEED TO TURN ON CRON IN SERVER by link

    public static function disable_package()
    {
        $today = Carbon::now()->format('Y-m-d');
        $executors = Executor::where('package_id', 2)
            ->where('verified', 1)
            ->whereHas('payments', function ($query) use ($today) {
                $query->where('finish', '<=', $today);
            })->get();

        $package = Package::findOrFail(2);

        foreach ( $executors as $executor ) {
            $executor->package_id = 1;
            $executor->save();

            get_user($executor->id)
                ->notify(new ExecutorDisablePackageNotification($package));
        }
    }

    public static function requiredCloseBid()
    {
        $today = Carbon::now()->subDays(20)->format('Y-m-d');

        $bids = Bid::where('status_id', 2)
            ->where('selection_date', '<=', $today)
            ->get();

        foreach ( $bids as $bid ) {
            get_user($bid->executor->id)
                ->notify(new ExecutorRequiredCloseBidNotification($bid));
        }
    }

    public static function clear_limit_package()
    {
        DB::table('executor_offers')->delete();
    }
}
