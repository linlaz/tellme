<?php

namespace App\Models;


use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded = ['id'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'text', 'Category.name', 'publish'])
            ->useLogName('blog')
            ->logOnlyDirty();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
