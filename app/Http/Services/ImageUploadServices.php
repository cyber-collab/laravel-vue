<?php

namespace App\Http\Services;

use Illuminate\Http\UploadedFile;

class ImageUploadServices
{
    public function uploadImage(UploadedFile $file)
    {
        $fileName = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('images', $fileName, 'public');
        return $fileName;
    }
}
