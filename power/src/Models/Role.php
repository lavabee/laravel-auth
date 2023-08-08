<?php


namespace LavaBee\Power\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    /**
     * A role may be given various permissions.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            config('power.models.permission'),
            config('power.table_names.role_has_permissions'),
            'role_id',
            'permission_id'
        );
    }

}
