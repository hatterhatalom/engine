<?php

namespace Hatterhatalom\Engine\Events\Arguments;

use Hatterhatalom\Engine\Player;

/**
 * Class Turn
 */
class Turn
{
    /**
     * The turn counter that indicates which turn has just started.
     * Count starts from one.
     *
     * @var int
     */
    public $turnCount;

    /**
     * The player whose turn just started.
     *
     * @var Player
     */
    public $player;

    /**
     * Turn constructor.
     *
     * @param Player $player
     * @param int    $turnCount
     */
    public function __construct(Player $player, $turnCount)
    {
        $this->player = $player;
        $this->turnCount = $turnCount;
    }
}
