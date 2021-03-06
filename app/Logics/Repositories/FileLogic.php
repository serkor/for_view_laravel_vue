<?php

namespace App\Logics\Repositories;

use App\Logics\Interfaces\FileLogicInterface;
use App\Models\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class FileLogic implements FileLogicInterface
{
    protected $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function index()
    {

        return $this->file->all();
    }

    public function destroy($request)
    {

        $this->file->findOrFail($request['id'])->delete();
    }

    public function UploadFilesAccount($files, $id)
    {
        foreach ($files as $file) {
            $url = $this->TranslateFile(microtime(true) . $file->getClientOriginalName());
            $name = $file->getClientOriginalName();
            $url = Storage::disk('public/files')->put($url, $file);

            $this->file->create([
                'name' => $name,
                'url' => $url,
                'entity' => 'users',
                'item_id' => $id,
            ]);
        }
    }

    public function UploadBidFile($file, $id, $bid)
    {
        $url = $this->TranslateFile(microtime(true) . $file->getClientOriginalName());
        $name = $file->getClientOriginalName();
        $url = Storage::disk('public/files')->put($url, $file);

        $this->file->create([
            'name' => $name,
            'url' => $url,
            'entity' => 'bids',
            'item_id' => $bid->id,
        ]);
    }

    public function UploadBlogArticleImage($image)
    {
        $name = $this->TranslateFile(microtime(true) . $image->getClientOriginalName());

        $new_image = Image::make($image)
            ->resize(1500, 1500, function ($image) {
                $image->aspectRatio();
                $image->upsize();
            })->encode('jpg', 100);

        Storage::disk('public/blog')->put($name, $new_image);

        return $name;
    }

    public function UploadLogo($image)
    {
        $name = $this->TranslateFile(microtime(true) . $image->getClientOriginalName());

        $avatar = Image::make($image)
            ->resize(500, 500, function ($image) {
                $image->aspectRatio();
                $image->upsize();
            })->encode('jpg', 100);

        Storage::disk('public/avatar')->put($name, $avatar);

        return $name;
    }

    public function TranslateFile($name)
    {
        $alf = array(
            '??' => 'a',
            '??' => 'b',
            '??' => 'v',
            '??' => 'g',
            '??' => 'd',
            '??' => 'e',
            '??' => 'e',
            '??' => 'zh',
            '??' => 'z',
            '??' => 'i',
            '??' => 'y',
            '??' => 'k',
            '??' => 'l',
            '??' => 'm',
            '??' => 'n',
            '??' => 'o',
            '??' => 'p',
            '??' => 'r',
            '??' => 's',
            '??' => 't',
            '??' => 'u',
            '??' => 'f',
            '??' => 'h',
            '??' => 'c',
            '??' => 'ch',
            '??' => 'sh',
            '??' => 'sch',
            '??' => '',
            '??' => 'y',
            '??' => '',
            '??' => 'e',
            '??' => 'yu',
            '??' => 'ya',
            '??' => 'A',
            '??' => 'B',
            '??' => 'V',
            '??' => 'G',
            '??' => 'D',
            '??' => 'E',
            '??' => 'E',
            '??' => 'Zh',
            '??' => 'Z',
            '??' => 'I',
            '??' => 'Y',
            '??' => 'K',
            '??' => 'L',
            '??' => 'M',
            '??' => 'N',
            '??' => 'O',
            '??' => 'P',
            '??' => 'R',
            '??' => 'S',
            '??' => 'T',
            '??' => 'U',
            '??' => 'F',
            '??' => 'H',
            '??' => 'C',
            '??' => 'Ch',
            '??' => 'Sh',
            '??' => 'Sch',
            '??' => '',
            '??' => 'Y',
            '??' => '',
            '??' => 'E',
            '??' => 'Yu',
            '??' => 'Ya',
        );
        $name = strtr($name, $alf);
        $name = mb_strtolower($name);
        $name = mb_ereg_replace('[^-0-9a-z]', '.', $name);
        $name = mb_ereg_replace('[-]+', '-', $name);
        $name = trim($name, '-');

        return $name;
    }
}
