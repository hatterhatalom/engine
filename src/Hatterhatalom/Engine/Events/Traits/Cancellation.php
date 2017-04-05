<?php

namespace Hatterhatalom\Engine\Events\Traits;

trait Cancellation
{
    protected $isCancelled = false;

    /**
     * Cancels the event.
     */
    public function cancel()
    {
        $this->isCancelled = true;
    }

    /**
     * Gets a value indicating whether the event has been cancelled.
     *
     * @return bool
     */
    public function isCancelled()
    {
        return $this->isCancelled();
    }
}
