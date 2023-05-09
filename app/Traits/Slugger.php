<?php

namespace App\Traits;

use App\Classes\SlugSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Slugger
{
    protected SlugSettings $slugSettings;

    public function getSlugSettings(): SlugSettings
    {
        return SlugSettings::create();
    }

    protected static function bootSlugger(): void
    {
        static::creating(function (Model $model) {
            $model->generateSlug();
        });

        static::updating(function (Model $model) {
            $model->generateSlug();
        });
    }

    protected function generateSlug(): void
    {
        $this->slugSettings = $this->getSlugSettings();

        $this->addSlug();
    }

    protected function addSlug(): void
    {
        $slug = $this->generateNonUniqueSlug();

        $slug = $this->makeSlugUnique($slug);

        $this->{$this->slugSettings->slugTargetColumn} = $slug;
    }

    protected function generateNonUniqueSlug(): string
    {
        return Str::slug($this->getSourceString());
    }

    protected function makeSlugUnique(string $slug): string
    {
        $originalSlug = $slug;
        $i = 1;

        while ($this->otherRecordExistsWithSlug($slug) || $slug === '') {
            $slug = $originalSlug.'-'.$i++;
        }

        return $slug;
    }

    protected function otherRecordExistsWithSlug(string $slug): bool
    {
        $slugField = $this->slugSettings->slugTargetColumn;

        $query = static::where($slugField, $slug);

        if ($this->exists) {
            $query->where($this->getKeyName(), '!=', $this->getKey());
        }

        return $query->exists();
    }

    public function getSourceString(): string
    {
        $slugSourceColumn = $this->slugSettings->slugSourceColumn;

        return $this->$slugSourceColumn;
    }
}
