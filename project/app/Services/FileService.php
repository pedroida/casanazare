<?php

namespace App\Services;

use App\Exceptions\FileNotStoraged;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public static function storagedRequestFile(UploadedFile $file, string $path, string $disk = 'local'): string
    {
        $savedPath = Storage::disk($disk)->putFile($path, $file);

        if (!$savedPath)
            throw new FileNotStoraged(__('exceptions.file_not_storaged'), 500);

        return $savedPath;
    }
}