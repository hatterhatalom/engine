<?php

namespace Hatterhatalom\Engine\Events\Arguments;

use Hatterhatalom\Engine\Player;

class PlayerDeath
{
    public $player;

    public $shouldHappen = true;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }
}
