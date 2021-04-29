<?php

namespace Tests\Unit;

use App\Models\Stay;
use App\Services\FileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\Cases\TestCaseUnit;

class FileServiceTest extends TestCaseUnit
{
    /**
     * @return void
     */
    public function testShouldStoreFile()
    {
        Storage::fake('local');
        $file = UploadedFile::fake()->image('image.jpg');

        $filePath = FileService::storeRequestFile($file, 'test/store');

        Storage::assertExists($filePath);
    }
}
