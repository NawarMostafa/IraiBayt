<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function UploadImg(Request $request)
    {
        $name = $request->file('upload')->store('/images');
        echo "<span class='p-3'>تم الرفع</span>";
    }
    public function fileBrowse()
    {
        $pathes = glob(storage_path('/app/images/*'));
        $fileNames = [];
        foreach ($pathes as $path) {
            $fileNames[] = basename($path);
        }

        return view('layouts.browse', compact('fileNames'));
    }
}
