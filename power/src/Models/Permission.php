<?php


namespace LavaBee\Power\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use LavaBee\Power\Contracts\IPermission;

/**
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Permission extends Model implements IPermission
{


    public function roles(): BelongsToMany
    {
        $this->belongsToMany(
            config('power.models.role'),
            config('power.table_names.role_has_permissions'),
            config('power.column_names.permission_pivot_key'),
            config('power.column_names.role_pivot_key')
        );
    }

    public static function findByName(string $name): Permission
    {
        return static::where(['name' => $name])->first();
    }

    public static function findById(int $id): Permission
    {
        return static::where(['id' => $id])->first();
    }
}
