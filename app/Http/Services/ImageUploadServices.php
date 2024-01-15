<?php

namespace App\Http\Services;

use App\Http\Requests\CompanyRequest;
use Illuminate\Http\UploadedFile;

class ImageUploadServices
{
   public function uploadImage(CompanyRequest $request, array $data): void
   {
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $this->storeLogo($file);
            $data['logo'] = $fileName;
        }
   }

   private function storeLogo(UploadedFile $file): string
   {
        $fileName = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('images', $fileName, 'public');
        return $fileName;
   }
}
