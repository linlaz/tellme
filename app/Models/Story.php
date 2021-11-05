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

    public $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['slug','stories'])
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
            ->useLogName('story')
            ->logOnlyDirty();
    }
    public function user()
    {
        return $this->hasMany(User::class,'id');
    }
}
