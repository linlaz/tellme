<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(user::class, 'id');
    }
    public function story()
    {
        return $this->belongsTo(Story::class, 'destination_id');
    }
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'destination_id');
    }
}
