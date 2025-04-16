<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   Static function savePublicImage($request,$var_name,$folder_name)
   {
        $custom_folder_name = $folder_name.'/'.date('y-m-d');
        $custom_file_name = time().'-'.$request->file($var_name)->getClientOriginalName();
        $request->file($var_name)->storeAs($custom_folder_name, $custom_file_name,'public');

        return $custom_folder_name.'/' . $custom_file_name;
   }
}
