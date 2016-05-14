<?php

namespace Hatterhatalom\Engine\Events\PlayerEvents;

use Hatterhatalom\Engine\Events\Event;
use Hatterhatalom\Engine\Player;

class PlayerDied extends Event
{
    public function __construct(Player $payload)
    {
        parent::__construct($payload);
    }
}
