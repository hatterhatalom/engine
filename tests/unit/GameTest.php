<?php

use Hatterhatalom\Engine\Game;
use Hatterhatalom\Engine\Events\CardWasPlayedEvent;

class GameTest extends PHPUnit_Framework_TestCase
{
    public function test_if_on_method_subscribes_to_an_event_and_trigger_fires_it_properly()
    {
        $testValue = '';

        $game = new Game();

        $game->on(
            CardWasPlayedEvent::class,
            function ($payload) use (&$testValue) {
                $testValue = $payload;
            }
        );

        $game->trigger(new CardWasPlayedEvent("mia is love"));

        $this->assertSame("mia is love", $testValue);
    }
}