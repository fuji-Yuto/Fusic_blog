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

    public static function IndexSortingHandle($sort_type){
        $articles = [];
        switch($sort_type){
            case 'newest':
                $articles = self::orderBy('updated_at','desc')->get();
                break;
            case 'oldest':
                $articles = self::orderBy('updated_at','asc')->get();
                break; 
            case 'most_viewed':
                $articles = self::orderBy('view','desc')->get();
                break;
        }
        return $articles;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
