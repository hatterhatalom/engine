<?php

namespace Hatterhatalom\Engine\Events\PlayerEvents;

use Hatterhatalom\Engine\Player;

class PlayerDied extends PlayerEvent
{
    public function __construct(Player $payload)
    {
        parent::__construct($payload);
    }
}
