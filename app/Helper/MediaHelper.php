<?php // Code within app\Helpers\Helper.php

namespace App\Helper;

use FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use Buglinjo\LaravelWebp\Facades\Webp;
use Illuminate\Support\Str;

class MediaHelper
{
    /**
     * Store a image in storage path.
     *
     */
    public static function imageSave($file, $path, $filePrefix)
    {
        if (!empty($file)) {
            $fileName = $filePrefix . '_' . time() . '_' . strtolower(Str::random(6)) . '.' . $file->getClientOriginalExtension();
            if ($file->storeAs($path, $fileName, 'public')) {
                return $fileName;
            }
            return null;
        }
    }
}
