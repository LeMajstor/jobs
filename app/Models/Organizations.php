<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizations extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;
    
    public $fillable = [
        'name',
        'url'
    ];

    public function offers()
    {
        return $this->hasMany(Offers::class);
    }

    protected static function boot() 
    {
        parent::boot();
        static::deleted(function($organization){
            $organization->offers()->delete();
        });
    }

}
