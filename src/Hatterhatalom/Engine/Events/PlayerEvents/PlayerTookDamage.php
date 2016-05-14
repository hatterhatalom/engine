<?php

namespace Hatterhatalom\Engine\Events\PlayerEvents;

use Hatterhatalom\Engine\Events\Arguments\PlayerHealthDifference;
use Hatterhatalom\Engine\Events\Event;

class PlayerTookDamage extends Event
{
    public function __construct(PlayerHealthDifference $payload)
    {
        parent::__construct($payload);
    }
}
