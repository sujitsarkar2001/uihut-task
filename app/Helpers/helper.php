<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('fileUpload')) {

    /**
     * upload file
     *
     * @param  object $file
     * @param  string $folder
     * @param  string $current
     */
    function fileUpload($file, $folder, $current = null) : string
    {
        $filename = Str::random() . '.' . $file->getClientOriginalExtension();

        if ($current != null) uploadedFileDelete($current);

        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        return $file->storeAs($folder, $filename, 'public');
    }
}

if (!function_exists('uploadedFile')) {

    /**
     * get uploaded file
     *
     * @param  string $file
     */
    function uploadedFile($file) : string|null
    {
        if ($file != null && Storage::disk('public')->exists($file)) {
            return Storage::disk('public')->url($file);
        }
        return null;
    }
}

if (!function_exists('deleteUploadedFile')) {

    /**
     * delete uploaded file
     *
     * @param  string $file
     */
    function deleteUploadedFile($file) : bool
    {
        if ($file != null && Storage::disk('public')->exists($file)) {
            Storage::disk('public')->delete($file);
        }
        return true;
    }
}
