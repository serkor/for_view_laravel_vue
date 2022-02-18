<?php

namespace App\Logics\Interfaces;


interface FileLogicInterface
{

    public function index();

    public function destroy($request);

    public function UploadFilesAccount($files, $id);

    public function UploadLogo($image);

    public function UploadBidFile($file, $id, $bid);

    public function TranslateFile($name);
}
