<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Todo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "todos";
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'desc', 'status'];
}
