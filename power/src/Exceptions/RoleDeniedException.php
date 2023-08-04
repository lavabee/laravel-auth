<?php


namespace LavaBee\Power\Exceptions;


use Exception;

class RoleDeniedException extends LavaBeePowerException
{
    /**
     * Create a new permission denied exception instance.
     *
     * @param string $role
     */
    public function __construct($role)
    {
        $this->message = sprintf("You don't have a required {$role} permission.");
    }
}
