<?php

use Illuminate\Support\Facades\File;

function uploadImage($image, $folder = '')
{
    $imageName = rand() . time() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('images/' . $folder), $imageName);
    return $imageName;
}

function deleteImage($imageName, $folder = '')
{
    file::delete(public_path('images/' . $folder . '/' . $imageName));
    return true;
}
