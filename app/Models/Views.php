<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Views extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $guarded = ['id'];
    protected $with = ['user'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['ipuser', 'destination', 'destination_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('views');
    }
    public function story()
    {
        return $this->belongsTo(Story::class, 'destination_id');
    }
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'destination_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'visitor');
    }
    public function ipuser()
    {
        return $this->hasMany(IPuser::class, 'visitor');
    }
}
