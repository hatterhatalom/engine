<?php

namespace Hatterhatalom\Engine\Events;

/**
 * Class Event represents an event dispatched by the Dispatcher.
 */
class Event
{
    /**
     * The event payload.
     *
     * @var mixed
     */
    public $payload;

    /**
     * Event constructor.
     *
     * @param null|mixed $payload
     */
    public function __construct($payload = null)
    {
        $this->payload = $payload;
    }
}
