<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Traits\DateTimeTrait;
use Illuminate\Support\Facades\Storage;

class Comment extends Model
{
    use HasFactory;
    use DateTimeTrait;

    protected $fillable = [
        'title', 'body', 'user_id', 'post_id', 'image'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function getImagePathAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
