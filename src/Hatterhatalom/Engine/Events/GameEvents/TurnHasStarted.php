<?php

namespace Hatterhatalom\Engine\Events\GameEvents;

use Hatterhatalom\Engine\Events\Arguments\Turn;
use Hatterhatalom\Engine\Events\Event;

class TurnHasStarted extends Event
{
    public function __construct(Turn $payload)
    {
        parent::__construct($payload);
    }
}
