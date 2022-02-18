<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\LanguageLogicInterface;
use App\Models\Language;

class LanguageLogic implements LanguageLogicInterface
{
    protected $language;

    public function __construct(Language $language){

        $this->language = $language;
    }

    public function index(){

        return $this->language->all();
    }

    public function edit( $id ){

        return $this->language->findOrFail($id);
    }

    public function update( $id ) {

        Language::where( 'default', 1 )
            ->first()
            ->update( [ 'default' => NULL ] );

        Language::where( 'id', $id )
            ->first()
            ->update( ['default' => 1]  );
    }

}
