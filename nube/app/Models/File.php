<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'size',
        'path',
        'uuid'
    ];

    public function sizeForHumans(){
        $bytes = $this->size;

        $units = ['b', 'kb', 'gb', 'tb'];

        for($i = 0; $bytes > 1024; $i++){
            $bytes /= 1024;
        }

        return round($bytes, 2) . $units[$i];
    }

    public static function booted(){
        static::creating(function ($model){
            $model->uuid = Str::uuid();
        });
        static::deleting(function ($model){
            Storage::disk('local')->delete($model->path);
        });
    }

    public function objetos(){
        return $this->morphMany('App\Models\Objeto', 'objeto');
    }
}
