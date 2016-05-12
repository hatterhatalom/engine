<?php

namespace Hatterhatalom\Engine;

use Hatterhatalom\Engine\Events\Dispatcher;
use Hatterhatalom\Engine\Events\Event;

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
     * Game constructor.
     *
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher = null)
    {
        // Initialize dispatcher
        $dispatcher = $dispatcher ?: new Dispatcher();
        $this->dispatcher = $dispatcher;
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
}
