<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IT extends Model
{
    use HasFactory;

    protected $table = 'its';

    protected $fillable =  [
        'id',
        'nama_file',
        'preview_media',
        'user_id',
    ];

    public function getFileUrlAttribute()
    {
        return asset('storage/images/' . $this->preview_media);
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }   
}


