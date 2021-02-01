<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    //

    public function __construct()
    {
        
    }

    public function download(Request $request) 
    {       
        
        $zip = new \ZipArchive();
        $url = $request->route('url');
        
        if(!is_null($url) && isset($url)) {
            
            $zip_file = $url . '.zip';
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
            $path = storage_path('app/'.$url);
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            foreach ($files as $name => $file) 
            {
                if (! $file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = basename($filePath);
                    $zip->addFile($filePath, $relativePath);
                }
            }

        } else {

            $zip_file = "curriculos.zip";
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
            
            $path = storage_path('app');
            $files = new \RecursiveIteratorIterator((new \RecursiveDirectoryIterator($path)));
            foreach ($files as $name => $file) 
            {
                if (! $file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = basename($filePath);                    
                    $zip->addFile($filePath, $relativePath);
                }
            }

        }
        
        $zip->close();
        return response()->download($zip_file);
    }
}
