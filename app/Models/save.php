<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Save extends Model
{
    use LogsActivity;
    use HasFactory;
    protected $guarded = ['id'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['user.name', 'destination','destination_id'])
            ->useLogName('save');
    }
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
