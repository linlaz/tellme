<?php

namespace App\Models;

use App\Models\Category;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    use LogsActivity;

    public $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title','text', 'Category.name', 'publish'])
            ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}")
            ->useLogName('blog')
            ->logOnlyDirty();
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
