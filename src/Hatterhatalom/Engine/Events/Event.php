<?php

namespace Hatterhatalom\Engine\Events;

/**
 * Class Event represents an event dispatched by the Dispatcher.
 */
abstract class Event
{
    /**
     * The event payload.
     *
     * @var mixed
     */
    public $payload;
}
