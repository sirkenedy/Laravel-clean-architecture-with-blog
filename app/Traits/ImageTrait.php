<?php
  
namespace App\Traits;
  
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
  
trait ImageTrait {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function imageUploadS3($data, $directory = 'images/' ) {
        $file = $data['image'];
        $image_name = Str::random(20);
        $ext = strtolower($file->getClientOriginalName()); // You can use also getClientOriginalName()
        $image_full_name = $directory.$image_name.'-'.$ext;
        Storage::disk('s3')->put($image_full_name, file_get_contents($file));  
        $data['image'] = $image_full_name;
        $data['image_size'] = $file->getSize();
        return $data;  
    }

    public function imageRemoval($imagePath)
    {
        //
    }

    public function multipleImageUpload($file_array, $directory = 'images')
    {
        //

    }

  
}