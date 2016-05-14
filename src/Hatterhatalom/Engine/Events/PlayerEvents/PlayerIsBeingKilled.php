<?php

namespace Hatterhatalom\Engine\Events\PlayerEvents;

use Hatterhatalom\Engine\Events\Arguments\PlayerDeath;
use Hatterhatalom\Engine\Events\Event;

class PlayerIsBeingKilled extends Event
{
    public function __construct(PlayerDeath $payload)
    {
        parent::__construct($payload);
    }
}
