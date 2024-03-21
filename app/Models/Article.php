<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    public function scopeSorting($query,$sort_type){
        
        switch($sort_type){
            case 'newest':
                return $query -> orderBy('updated_at','desc');
            case 'oldest':
                return $query -> orderBy('updated_at','asc'); 
            case 'most_viewed':
                return $query -> orderBy('view','desc');
            default :
                $query;
        }

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
