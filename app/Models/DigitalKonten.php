<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalKonten extends Model
{
    use HasFactory;

    protected $table = 'digital_kontens';

    protected $fillable = [
        'id',
        'nama_konten',
        'preview_media',
        'user_id',
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
