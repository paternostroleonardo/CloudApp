<?php

namespace App\Models;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Objeto extends Model
{
    use HasFactory, HasRecursiveRelationships;
    use \Staudenmeir\LaravelCte\Eloquent\QueriesExpressions;

    public $table = 'objetos';

    protected $fillable = [
        'parent_id', 'objeto_id', 'objeto_type'
    ];

    public static function booted(){
        static::creating(function ($model){
            $model->uuid = Str::uuid();
        });
        static::deleting(function ($model){
            optional($model->objeto)->delete();
            $model->descendants->each->delete();
        });
        static::creating(function ($model){
            $model->user_id = Auth::user()->id;
        });
    }

    public function objeto(){
        return $this->morphTo();
    }

    public static function tree(){
        $allobjetos = Objeto::get();
        $rootobjetos = $allobjetos->whereNull('parent_id');
        /* retorna los hijos que no son parent_id null
        $whitobjetc = $allobjetos->where('parent_id');
        */
        self::formatTree($rootobjetos, $allobjetos);

        return $rootobjetos;
    }

    private static function formatTree($objetos, $allobjetos){
        foreach($objetos as $objeto){
            $objeto->children = $allobjetos->where('parent_id', $objeto->id)->values();
        if($objeto->children->isNotEmpty()){
            self::formatTree($objeto->children, $allobjetos);
        }
        }
    }

}
