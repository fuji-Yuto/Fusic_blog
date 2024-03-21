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
            case 'best':
                return $query -> withCount('good_users')->orderBy('good_users_count','desc');
            default :
                return $query;
        }

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function good_users(){
        return $this->belongsToMany(User::class);

    }


}
