<?php

namespace Hatterhatalom\Engine;

use Hatterhatalom\Engine\Events\Arguments\Turn;
use Hatterhatalom\Engine\Events\Dispatcher;
use Hatterhatalom\Engine\Events\Event;
use Hatterhatalom\Engine\Events\TurnHasStarted;

/**
 * Class Game represents a match between two players.
 */
class Game
{
    /**
     * The event dispatcher of the game instance.
     *
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * Key of the current player in the players array.
     *
     * @var int
     */
    protected $currentPlayerKey;

    /**
     * The players of the game.
     *
     * @var Player[]
     */
    protected $players = [];

    /**
     * The turn counter that indicates the current turn.
     * Starts from one.
     *
     * @var int
     */
    protected $turnCount = 1;

    /**
     * Game constructor.
     *
     * @param array      $players
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher = null)
    {
        // Initialize dispatcher
        $dispatcher = $dispatcher ?: new Dispatcher();
        $this->dispatcher = $dispatcher;
    }

    /**
     * Adds a player to the game.
     *
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        $this->players[] = $player;
    }

    /**
     * Subscribes a listener to a game event.
     *
     * @param string|mixed   $event
     * @param callable|array $listener
     */
    public function on($event, $listener)
    {
        $this->dispatcher->subscribe($event, $listener);
    }

    /**
     * Triggers an event in the game.
     *
     * @param Event|string $event
     * @param mixed|null   $payload
     */
    public function trigger($event, $payload = null)
    {
        return $this->dispatcher->fire($event, $payload);
    }

    /**
     * Gets the players of the game.
     *
     * @return Player[]
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Gets the player of the game who has the turn.
     *
     * @return Player
     */
    public function currentPlayer()
    {
        return $this->players[$this->currentPlayerKey];
    }

    /**
     * Gets the player of the game who does not have the turn.
     *
     * @return Player
     */
    public function anotherPlayer()
    {
        // 1 <=> 0
        $anotherPlayerKey = abs($this->currentPlayerKey - 1);

        return $this->players[$anotherPlayerKey];
    }

    /**
     * Gets the current turn. Starts from one.
     *
     * @return int
     */
    public function turn()
    {
        return $this->turnCount;
    }

    /**
     * Starts the next turn in the game.
     */
    public function startNextTurn()
    {
        $this->turnCount++;
        $this->swapPlayers();

        $this->trigger(
            new TurnHasStarted(
                new Turn($this->currentPlayer(), $this->turnCount)
            )
        );
    }

    /**
     * Swaps the players.
     */
    protected function swapPlayers()
    {
        $this->currentPlayerKey = abs($this->currentPlayerKey - 1);
    }
}
