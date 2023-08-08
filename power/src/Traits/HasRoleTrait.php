<?php


namespace LavaBee\Power\Traits;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use LavaBee\Power\Models\Permission;
use LavaBee\Power\Models\Role;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
 * Trait HasRoleTrait
 * @property Role $roles
 * @package LavaBee\Power\Traits
 */
trait HasRoleTrait
{

    /**
     * @return Role
     */
    public function roleInstance(): Role
    {
        $role = config('power.models.role');
        return app($role);
    }

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

    public function hasRoles($roles, $option = 'all') : bool
    {
        $roleModel = $this->roles->pluck('name');
        $roleCheck = collect($this->prepareRoleAsArray($roles))->pluck('name');
        if($option == 'all'){
            return $roleCheck->diff($roleModel)->isEmpty();
        }else{
            return $roleCheck->intersect($roleModel)->isNotEmpty();
        }
    }

    /**
     * Return array of role
     * @param string|int|array|Role|\Illuminate\Support\Collection $roles
     * @return Role[]|\Illuminate\Support\Collection
     */
    private function prepareRoleAsArray($roles): array|Collection
    {
        if(is_string($roles) || is_int($roles)){
            $roles = array($roles);
        }elseif ($roles instanceof Collection) {
            $roles = $roles->all();
        }
        return array_map(function ($role) {
            if ($role instanceof Role) {
                return $role;
            }
            if(is_string($role)){
                return $this->roleInstance()->where(['name' => $role])->first();
            }
            if(is_int($role)){
                return $this->roleInstance()->where(['id' => $role])->first();
            }
        }, $roles);
    }

}
