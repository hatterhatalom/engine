<?php

namespace Hatterhatalom\Engine\Events\PlayerEvents;

use Hatterhatalom\Engine\Events\Arguments\PlayerDeath;

class PlayerIsBeingKilled extends PlayerEvent
{
    public function __construct(PlayerDeath $payload)
    {
        parent::__construct($payload);
    }
}
