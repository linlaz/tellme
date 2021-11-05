<?php

namespace App\Models;

use App\Models\Blog;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use LogsActivity;
    use HasFactory;

    public $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name','slug'])
            ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}")
            ->useLogName('category')
            ->logOnlyDirty();
    }
    public function Blog()
    {
        return $this->hasMany(Blog::class,'user_id');
    }
}
