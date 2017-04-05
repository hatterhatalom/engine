<?php

namespace Hatterhatalom\Engine\Events\PlayerEvents;

use Hatterhatalom\Engine\Events\Arguments\PlayerHealthDifference;

class PlayerIsBeingHealed extends PlayerEvent
{
    public function __construct(PlayerHealthDifference $payload)
    {
        parent::__construct($payload);
    }
}
