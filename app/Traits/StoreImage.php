<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

trait StoreImage
{
    /**
     * @param array|UploadedFile $icon
     * @return string
     */
    private function StoreImage(array|UploadedFile $icon): string
    {
        $path = "uploads/" . Carbon::now()->format("Y") . "/" .
            Carbon::now()->format("d") . "/" .
            Carbon::now()->format("h");

        $IconName = Str::random() .
            "." . $icon->getClientOriginalExtension();

        $icon->move(public_path($path), $IconName);
        return $path . "/" . $IconName;
    }
}
