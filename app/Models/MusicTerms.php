<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicTerms extends Model
{
    use HasFactory;

    protected $table = 'music_source';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
    ];
}
