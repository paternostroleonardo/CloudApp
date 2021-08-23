<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Folder;
use App\Models\Objeto;
use App\Models\User;
use Inertia\Inertia;
use App\Models\File;

class FileController extends Controller
{


    public function index(Request $request){
          //$objeto = Objeto::with('descendants.objeto')->get('id')->values();
          $objeto = Objeto::isRoot()->with('objeto')->get()->values();
          //$ancestors = Objeto::with('ancestorsAndSelf.objeto')->get()->values();
        return Inertia::render('Files/Index', [
            'childrens' => Objeto::tree(),
            'objetos' => $objeto
        ]);
    }

    public function store(Request $request)
    {
        $name = $request->name;
        Folder::create(['name' => $name]);
       $folder = Folder::latest('id')->first();
       $folder->objetos()->create();
        return Redirect::route('files');
    }

    public function fileUpload(Request $request){

        $request->validate([
            'file' => 'required|mimes:csv, txt, xls, xls, pdf|max:2048'
        ]);

        $fileModel = new File;
          if($request->file()){
              $fileName = time().'_'.$request->file->getClientOriginalName();
              $filePath = $request->file('file')->StoreAs('uploads', $fileName, 'public');
              $fileModel->name = time().'_'.$request->file->getClientOriginalName();
              $fileModel->path = '/storage/'.$filePath;
              $fileModel->size = $request->file->getSize();
              $fileModel->save();
          }
            $file = File::latest('id')->first();
            $file->objeto()->create();
            return Redirect::route('files');
    }

    public function download(File $file){
        $this->authorize('download', $file);
        return Storage::disk('local')->download($file->path, $file->name);
    }
}
