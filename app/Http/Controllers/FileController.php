<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Folder;

class FileController extends Controller
{
    

    /**
     * File upload form
     */
    public function upload(){

        return view( 'file-management.upload' );

    }



    public function store( Request $request ){

        $fileIn = $request->file( 'file' );

        $dir = 'documents';
        if( $request->folder ){
            $folder = Folder::where( 'id', '=', $request->folder )->first();
            if( $folder )
                $dir = $folder->path;
        }

        $path =  $fileIn->store( $dir, 'private' );
        
        if( $path ){
            $file = new File;
            
            $file->path             = $path;
            $file->original_name    = $fileIn->getClientOriginalName();
            $file->file_name        = $fileIn->getClientOriginalName();
            $file->extension        = $fileIn->extension();
            $file->user_id          = $request->user()->id;
            $file->folder_id        = $request->folder;

            $file->save();

        }


        return redirect()->back()->with( 'message',  $path );

    }


    public function download( File $file ){



    }


}
