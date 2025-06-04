<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'path',
        'user_id',
         'uid',
        

    ];
     protected $hidden = [
        
        'id',
        
    ];

    Public function user():BelongsTo {
        return $this-> belongsTo(user::class);
    }

}



