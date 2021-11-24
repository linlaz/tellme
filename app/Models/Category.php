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

    protected $guarded = ['id'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug'])
            ->useLogName('category')
            ->logOnlyDirty();
    }
    public function story()
    {
        return $this->hasMany(Story::class, 'category_id');
    }
    public function blog()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}
