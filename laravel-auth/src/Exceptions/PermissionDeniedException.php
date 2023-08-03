<?php


namespace LavaBee\LaravelAuth\Exceptions;

use Exception;

class PermissionDeniedException extends Exception
{
    /**
     * Create a new permission denied exception instance.
     *
     * @param string $permission
     */
    public function __construct($permission)
    {
        $this->message = sprintf("You don't have a required {$permission} permission.");
    }
}
