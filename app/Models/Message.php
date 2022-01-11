<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Message extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = ['message', 'user_id', 'receiver_id', 'is_seen'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('message');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
