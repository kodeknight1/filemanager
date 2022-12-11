<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FolderController extends Controller
{
    
    /**
     * 
     */
    public function index(){

        $folders = Folder::where( 'parent_id', '=', 0 )->get();
        $files = File::where( 'folder_id', '=', 0  )->get();

        return view( 'file-management.files', [ 'folders' => $folders, 'files' => $files ] );

    }

    /**
     * 
     */
    public function folder( Folder $folder ){

        $breadCrumbs = $this->get_ancestors( $folder );

        $subFolders = Folder::where( 'parent_id', '=', $folder->id )->get();
        $files = File::where( 'folder_id', '=', $folder->id  )->get();

        return view( 'file-management.folder', 
                        [ 
                        'folder'        => $folder, 
                        'subFolders'    => $subFolders, 
                        'files'         => $files,
                        'breadCrumbs'   => $breadCrumbs
                        ] );
    }


    /**
     * Form to create folder
     */
    public function create(){

        return view( 'file-management.create-folder' );

    }

    /**
     * 
     */
    public function store( Request $request ){

        $request->validate([
            'folder_name' => 'required',  
        ]); 

        $path = 'documents/';

        if( $request->parent ){
            $parent = Folder::where( 'id', '=', $request->parent )->first();
            $path = $parent->path.'/';
        }

        
        $dirExists = Storage::disk( 'private' )->exists( $path.$request->folder_name );
        
        if( ! $dirExists ){

            $dir = Storage::disk( 'private' )->makeDirectory( $path.$request->folder_name );

            if( $dir ){
                Folder::create(
                    [
                        'name'      => $request->folder_name,
                        'parent_id' => $request->parent,
                        'disk'      => 'private',
                        'path'      => $path.$request->folder_name
                    ]
                );
            }
        }

        return redirect()->back();

    }


    private function get_ancestors( Folder $folder ){


        $ancestors = [];
        $parent = $folder->parent_id;
        while( $parent > 0 ){
            $f = Folder::where( 'id', '=', $parent )->first();
            $ancestors[] = $f;
            $parent = $f->parent_id;
        }

        return $ancestors;
    }
}
