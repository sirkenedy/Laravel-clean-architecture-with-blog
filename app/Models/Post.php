<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'keywords',
        'image',
        'image_size',
        'user_id',
    ];

    public $appends = ['url', 'size_in_kb'];

    public function getUrlAttribute()
    {
        return Storage::disk('s3')->url($this->image);
    }

    public function getSizeInKbAttribute()
    {
        return round($this->image_size / 1024, 2);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
