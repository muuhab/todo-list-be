<?php

namespace App\Http\Traits;
use Illuminate\Support\Facades\Storage;



trait GeneralTrait {
    use APIsTrait;


    public function saveFile($file,$path){
        $fileNameWithExt = $file->getClientOriginalName();

        // Delete old file
        $exists = Storage::disk('local')->exists($path.$fileNameWithExt);

        if ($exists) {
            Storage::delete( $path . $fileNameWithExt);
        }

        // Upload new file

        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $fileName.time().'.'.$extension;
        $path = $file->move($path , $fileNameToStore);

        return $path ;
    }

}
