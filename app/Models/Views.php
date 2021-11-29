<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['user'];
    public function story()
    {
        return $this->belongsTo(story::class, 'destination_id');
    }
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'destination_id');
    }
    public function user()
    {
        return $this->belongsTo(user::class, 'visitor');
    }
    public function ipuser()
    {
        return $this->hasMany(IPuser::class, 'visitor');
    }
}
