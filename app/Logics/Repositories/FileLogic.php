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
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'e',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'y',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sch',
            'ь' => '',
            'ы' => 'y',
            'ъ' => '',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',
            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',
            'Ё' => 'E',
            'Ж' => 'Zh',
            'З' => 'Z',
            'И' => 'I',
            'Й' => 'Y',
            'К' => 'K',
            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',
            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',
            'Ф' => 'F',
            'Х' => 'H',
            'Ц' => 'C',
            'Ч' => 'Ch',
            'Ш' => 'Sh',
            'Щ' => 'Sch',
            'Ь' => '',
            'Ы' => 'Y',
            'Ъ' => '',
            'Э' => 'E',
            'Ю' => 'Yu',
            'Я' => 'Ya',
        );
        $name = strtr($name, $alf);
        $name = mb_strtolower($name);
        $name = mb_ereg_replace('[^-0-9a-z]', '.', $name);
        $name = mb_ereg_replace('[-]+', '-', $name);
        $name = trim($name, '-');

        return $name;
    }
}
