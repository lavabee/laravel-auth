<?php


namespace LavaBee\LaravelAuth\Exceptions;


use Exception;

class RoleDeniedException extends Exception
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
