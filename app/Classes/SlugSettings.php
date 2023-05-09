<?php

namespace App\Classes;

final class SlugSettings
{
    public string $slugSourceColumn = 'name';

    public string $slugTargetColumn = 'slug';

    public static function create(): SlugSettings
    {
        return new SlugSettings();
    }

    public function setSlugSourceColumn(string $slugSourceColumn): self
    {
        $this->slugSourceColumn = $slugSourceColumn;

        return $this;
    }

    public function setSlugTargetColumn(string $slugTargetColumn): self
    {
        $this->slugTargetColumn = $slugTargetColumn;

        return $this;
    }
}
