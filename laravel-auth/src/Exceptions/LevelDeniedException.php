<?php


namespace LavaBee\LaravelAuth\Exceptions;


use Exception;

class LevelDeniedException extends Exception
{
    /**
     * Create a new permission denied exception instance.
     *
     * @param string $level
     */
    public function __construct($level)
    {
        $this->message = sprintf("You don't have a required {$level} permission.");
    }
}
