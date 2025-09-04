<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    public static function boot(): void
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->slug ??= str($model->{self::slugFrom()})
                ->append(time())
                ->slug();
        });
    }

    public static function slugFrom(): string
    {
        return 'title';
    }
}
