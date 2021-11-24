<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Story extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $guarded = ['id'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['slug', 'stories'])
            ->useLogName('story')
            ->logOnlyDirty();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function ipuser()
    {
        return $this->belongsTo(IPuser::class, 'id');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class, 'story_id');
    }
    public function views()
    {
        return $this->hasMany(Views::class, 'destination_id');
    }
    public function saves()
    {
        return $this->hasMany(save::class, 'destination_id');
    }
}
