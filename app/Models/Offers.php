<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offers extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    public $fillable = [
        'title',
        'url',
        'description',
        'organization_id'
    ];

    public function organizations()
    {
        return $this->belongsTo(Organizations::class);
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidates::class);
    }

    protected static function boot() 
    {
        parent::boot();
        static::deleted(function($offer){
            $offer->candidates()->delete();
        });
    }

    
}
