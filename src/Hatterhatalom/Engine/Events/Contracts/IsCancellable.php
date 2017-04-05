<?php

namespace Hatterhatalom\Engine\Events\Contracts;

interface IsCancellable
{
    /**
     * Cancels an event.
     */
    public function cancel();

    /**
     * Gets a value indicating whether the event has been cancelled.
     *
     * @return bool
     */
    public function isCancelled();
}
