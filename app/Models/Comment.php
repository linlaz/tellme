<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Comment extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded = ['id'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['user_id', 'ipuser', 'story_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('comment');
    }
    public function story()
    {
        $this->belongsTo(Story::class, 'id');
    }
    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
