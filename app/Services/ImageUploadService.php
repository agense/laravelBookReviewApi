<?php

namespace App\Services;

use Image; //intervention image class
use Illuminate\Support\Facades\Storage;

class ImageUploadService{

    private $path = 'public/images/';
     
    /**
     * Upload Image to storage
     *
     * @param  string base_64 $img 
     * @param string $location - folder to which to upload file: appended to path 'storage/images/'
     * @return string $filename
     */
    public function uploadImage(string $img, string $location = null){

        if(is_string($img) && preg_match('/data:image/', $img)){  
            
            $mimetype  = mime_content_type ($img);
            $ext = explode('/', $mimetype)[1];

            //create file name and upload location
            $filename = uniqid().'.'.$ext;
            if($location){
                $filepath = $this->path.$location.'/'.$filename;
            }else{
                $filepath = $this->path.$filename;
            }
            
            //Prepare image
            $image = Image::make($img);
            if($image->width() > 500){
                $image->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }elseif($image->height() > 500){
                $image->resize(null, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image = $image->encode($ext);
        
            //store in Storage
            if(Storage::put($filepath, $image)){
                return $filename;
            }
            return null;
        }
        return null;
    }

    /**
     * Delete Image from storage
     *
     * @param  string $img 
     * @param string $location - folder to which the file was uploaded: appended to path 'storage/images/'
     * @return bool
     */
    public function deleteImage(string $img, string $location = null){
        if($location){
            $filepath = $this->path.$location.'/'.$img;
        }else{
            $filepath = $this->path.$img;
        }
         if( Storage::exists($filepath)){
             Storage::delete($filepath);
             return true;
         }
         return false;
     }
}