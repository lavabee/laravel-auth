<?php


namespace LavaBee\Power\Traits;



use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\App;
use LavaBee\Power\Exceptions\PermissionDeniedException;
use LavaBee\Power\Models\Permission;

/**
 * Trait HasPermissionTrait
 * @property BelongsToMany permissions
 * @package LavaBee\Power\Traits
 */
trait HasPermissionTrait
{


    public function permissionInstance()
    {
        $permission = config('power.models.permission');
        return app($permission);
    }

    /**
     * A model may have multiple direct permissions.
     */
    public function permissions(): BelongsToMany
    {
        return $this->morphToMany(
            config('power.models.permission'),
            'model',
            config('power.table_names.model_has_permissions'),
            config('power.column_names.model_morph_key'),
            config('power.column_names.permission_pivot_key')
        );
    }


    public function AllPermissions() {
        $permissionDirect = $this->permissions;

    }

    /**
     * @param  string|int|array|Permission|\Illuminate\Support\Collection  $permissions
     *
     */
    public function parseToPermission($permissions): array
    {
        if(is_string($permissions) || is_int($permissions)){
            $permissions = array($permissions);
        }elseif ($permissions instanceof Collection) {
            $permissions = $permissions->toArray();
        }
        return array_map(function ($permission) {
            if ($permission instanceof Permission) {
                return $permission;
            }
            if(is_string($permission)){
                return $this->permissionInstance()->where(['name' => $permission])->get();
            }
            if(is_int($permission)){
                return $this->permissionInstance()->where(['id' => $permission])->get();
            }
        }, $permissions);
    }

    /**
     * Determine if the model may perform the given permission.
     *
     * @param  string|array|Permission $permissions
     *
     * @throws \LavaBee\Power\Exceptions\PermissionDeniedException
     */
    public function hasPermission($permissions) : bool
    {
        return true;

    }






}
