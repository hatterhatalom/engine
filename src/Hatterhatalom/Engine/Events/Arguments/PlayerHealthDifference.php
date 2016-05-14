<?php

namespace Hatterhatalom\Engine\Events\Arguments;

use Hatterhatalom\Engine\Player;

class PlayerHealthDifference
{
    public $difference;
    public $player;

    public function __construct($difference, Player $player)
    {
        $this->difference = $difference;
        $this->player = $player;
    }
}
