<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class LocateServiceProvider extends ServiceProvider {

    public function register() {

        if (App::runningInConsole()) {
            echo 'Running in console (i.e. migration).  Disabling LocateServiceProvider' . PHP_EOL;
            return;
        }

        try {
            DB::connection()->getPdo();
            if ( Schema::hasTable( 'languages' ) ) {

                $language_default = DB::table( 'languages' )
                    ->where( 'default', 1 )
                    ->first();

                config( [ 'app.locale' => "$language_default->locate_code" ] );

                $languages = DB::table( 'languages' )->get();

                config( [
                    'laravellocalization.supportedLocales' => [
                        "$languages->locate_code" => array(
                            'name'   => "$languages->name",
                            'script' => "$languages->script",
                            'native' => "$languages->native"
                        ),
                    ],
                    'laravellocalization.useAcceptLanguageHeader' => true,
                    'laravellocalization.hideDefaultLocaleInURL' => true
                ] );
            }
        } catch ( \Exception $e ) {
            return;
        }
    }

}
