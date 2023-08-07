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
}
