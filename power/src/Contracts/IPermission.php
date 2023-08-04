<?php


namespace LavaBee\Power\Contracts;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use LavaBee\Power\Exceptions\PermissionDeniedException as PermissionDeniedExceptionAlias;

interface IPermission
{
    /**
     * A permission can be applied to roles.
     */
    public function roles(): BelongsToMany;

    /**
     * Find a permission by its name.
     *
     * @param string $name
     * @return IPermission
     * @throws PermissionDeniedExceptionAlias
     */
    public static function findByName(string $name) :self;

    /**
     * Find a permission by its id.
     *
     * @param int $id
     * @return IPermission
     * @throws PermissionDeniedExceptionAlias
     */
    public static function findById(int $id): self;

}
