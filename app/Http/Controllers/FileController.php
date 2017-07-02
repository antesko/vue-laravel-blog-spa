<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class FileController extends Controller
{
    public $imagesDir = '/uploads/images/';


    public function uploadImage (Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $image = $request->file('image');

        $imageName = str_random(20) . '_' .
            time() . '.' .
            $image->getClientOriginalExtension();

        $image->move(public_path() . $this->imagesDir, $imageName);

        return response()->json([
            'success' => true,
            'path'    => $this->imagesDir . $imageName
        ]);
    }
}
