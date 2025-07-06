<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Album;

class Photo extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'album_id',
        'title',
        'file_path',
        'description'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
