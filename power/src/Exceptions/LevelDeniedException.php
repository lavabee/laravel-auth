<?php


namespace LavaBee\Power\Exceptions;

class LevelDeniedException extends LavaBeePowerException
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
