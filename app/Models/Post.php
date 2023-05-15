<?php

namespace App\Models;

use App\Classes\SlugSettings;
use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    use Slugger;

    protected $fillable = [
        'category_id',
        'thumbnail',
        'title',
        'slug',
        'content'
    ];

    public function getSlugSettings(): SlugSettings
    {
        return SlugSettings::create()
            ->setSlugSourceColumn('title')
            ->setSlugTargetColumn('slug');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
