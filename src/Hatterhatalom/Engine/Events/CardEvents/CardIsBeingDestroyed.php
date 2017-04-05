<?php

namespace Hatterhatalom\Engine\Events\CardEvents;

use Hatterhatalom\Engine\Events\Arguments\CardAction;

class CardIsBeingDestroyed extends CardEvent
{
    public function __construct(CardAction $payload)
    {
        parent::__construct($payload);
    }
}
