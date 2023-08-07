<?php


namespace LavaBee\Power\Traits;



use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\App;
use JetBrains\PhpStorm\Pure;
use LavaBee\Power\Exceptions\PermissionDeniedException;
use LavaBee\Power\Models\Permission;

/**
 * Trait HasPermissionTrait
 * @property BelongsToMany|collection permissions
 * @package LavaBee\Power\Traits
 */
trait HasPermissionTrait
{


    /**
     * @return Permission
     */
    public function permissionInstance(): Permission
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

    /**
     * Check permission direct of model; option all or any
     * @param string|int|array|Permission|\Illuminate\Support\Collection $permissions
     * @param string option
     * @return bool
     */
    public function hasPermissionDirect($permissions, $option = 'all'): bool
    {
        $permissionModel = $this->permissions->pluck('name');
        $permissionArr = collect($this->preparePermissionAsArray($permissions))->pluck('name');
        if($option == 'all'){
            return $permissionArr->diff($permissionModel)->isEmpty();
        }else{
            return $permissionArr->intersect($permissionModel)->isNotEmpty();
        }
    }

    /**
     * Check permission direct through role of model
     * @param string|int|array|Permission|\Illuminate\Support\Collection $permissions
     * @param string $option
     * @return bool
     */
    public function hasPermissionThroughRole($permissions, $option = 'all') : bool
    {
        if(method_exists($this,'hasRole')){
            return $this->hasRole($permissions->roles,$option);
        }
        return false;
    }

    public function hasPermission($permissions) : bool
    {
        return $this->hasPermissionDirect($permissions) || $this->hasPermissionThroughRole($permissions);
    }

    public function getPermissionThroughRole()
    {

    }

    public function getAllPermission()
    {

    }
    
    /**
     * Return array name of permission
     * @param string|int|array|Permission|\Illuminate\Support\Collection $permissions
     * @return Permission[]|\Illuminate\Support\Collection
     */
    private function preparePermissionAsArray($permissions): array|Collection
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
                return $this->permissionInstance()->where(['name' => $permission])->first();
            }
            if(is_int($permission)){
                return $this->permissionInstance()->where(['id' => $permission])->first();
            }
        }, $permissions);
    }






}
