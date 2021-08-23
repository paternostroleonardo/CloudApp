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


class ChildrenController extends Controller
{
    public function child(Request $request){
        $ide = $request->id;
        $childrens1 = Objeto::with('children')->firstWhere('id', 1)->all()->where('parent_id', $ide);
       // $child = Objeto::hasParent()->where('id', $request->get('id', Objeto::where('parent_id')
       //  ->first()->id))->firstOrFail()->all();
        $childre = Objeto::with('descendants.objeto')->get()->values();
        //$folder->objetos()->create();
        //$objeto = Objeto::with('descendants.objeto')->get('id')->values();
        //$objeto = Objeto::isRoot()->with('objeto')->get()->values();
        //$ancestors = Objeto::with('ancestorsAndSelf.objeto')->get()->values();
        $l = Objeto::find($ide)->descendantsAndSelf('descendants.objeto')->get()->values();
        $childrens = Objeto::hasChildren()->with('children.objeto')->get()->where('id', $ide)->values();
      return Inertia::render('Files/Child', [
          'childrens' => $childrens
      ]);
  }
}
