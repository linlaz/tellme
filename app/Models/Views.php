<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function story()
    {
        return $this->belongsTo(story::class, 'destination_id');
    }
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'destination_id');
    }
}
