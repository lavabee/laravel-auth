<?php


namespace LavaBee\Power\Traits;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoleTrait
{

    public function roles(): BelongsToMany
    {
        return $this->morphToMany(
            config('power.models.role'),
            'model',
            config('power.table_names.model_has_roles'),
            config('power.column_names.model_morph_key'),
            config('power.column_names.role_pivot_key')
        );
    }

    public function hasRoles($roles)
    {

    }

}
