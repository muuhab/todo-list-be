<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoAttachment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['path','todo_id','name'];

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
