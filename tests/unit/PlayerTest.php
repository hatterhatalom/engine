<?php

use Hatterhatalom\Engine\Cards\Card;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerDied;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerIsBeingKilled;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerIsBeingHealed;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerIsTakingDamage;
use Hatterhatalom\Engine\Player;

class PlayerTest extends \PHPUnit\Framework\TestCase
{
    public function test_if_can_store_and_return_a_card()
    {
        $card = Mockery::mock(Card::class);

        $player = new Player(new \Hatterhatalom\Engine\Game());
        $player->cards()
            ->push($card);

        $this->assertSame($card, $player->cards()
            ->pop());
    }

    public function test_if_card_references_are_being_kept()
    {
        $card = Mockery::mock(Card::class);

        $player = new Player(new \Hatterhatalom\Engine\Game());
        $player->cards()
            ->push($card);

        $this->assertSame($card, $player->cards()
            ->first());
        $this->assertSame($card, $player->cards()
            ->filter(function () {
                return true;
            })
            ->first());
    }

    public function test_if_can_be_damaged_and_damage_can_be_modified()
    {
        $game = new \Hatterhatalom\Engine\Game();
        $player = new Player($game, 20);

        $game->on(PlayerIsTakingDamage::class, function ($damage) {
            $damage->difference -= 1;
        });

        $player->damage(10);

        $this->assertEquals(11, $player->getHealth());
    }

    public function test_if_negative_damage_has_no_effect()
    {
        $game = new \Hatterhatalom\Engine\Game();
        $player = new Player($game, 20);

        $player->damage(-1);

        $this->assertEquals(20, $player->getHealth());
    }

    public function test_if_can_be_healed_and_heal_can_be_modified()
    {
        $game = new \Hatterhatalom\Engine\Game();
        $player = new Player($game, 20);

        $player->damage(15);

        $game->on(PlayerIsBeingHealed::class, function ($damage) {
            $damage->difference -= 1;
        });

        $player->heal(10);

        $this->assertEquals(14, $player->getHealth());
    }

    public function test_if_negative_heal_has_no_effect()
    {
        $game = new \Hatterhatalom\Engine\Game();
        $player = new Player($game, 20);

        $player->heal(-1);

        $this->assertEquals(20, $player->getHealth());
    }

    public function test_if_cannot_be_healed_beyond_max_hp()
    {
        $game = new \Hatterhatalom\Engine\Game();
        $player = new Player($game, 20);

        $isDead = false;

        $player->heal(20);
        $this->assertEquals(20, $player->getHealth());

        $game->on(
            PlayerDied::class,
            function ($deadPlayer) use (&$isDead, $player) {
                if ($player === $deadPlayer) {
                    $isDead = true;
                }
            }
        );

        $player->kill();

        $this->assertTrue($isDead);
    }

    public function test_if_player_can_die()
    {
        $game = new \Hatterhatalom\Engine\Game();
        $player = new Player($game);

        $isDead = false;

        $game->on(
            PlayerDied::class,
            function ($deadPlayer) use (&$isDead, $player) {
                if ($player === $deadPlayer) {
                    $isDead = true;
                }
            }
        );

        $player->kill();

        $this->assertTrue($isDead);
    }

    public function test_if_player_death_can_be_prevented()
    {
        $game = new \Hatterhatalom\Engine\Game();
        $player = new Player($game);

        $isDead = false;

        $game->on(
            PlayerIsBeingKilled::class,
            function ($death) {
                $death->shouldHappen = false;
            }
        );

        $game->on(
            PlayerDied::class,
            function ($deadPlayer) use (&$isDead, $player) {
                if ($player === $deadPlayer) {
                    $isDead = true;
                }
            }
        );

        $player->kill();

        $this->assertFalse($isDead);
    }

    public function test_if_player_dies_when_health_reaches_zero()
    {
        $game = new \Hatterhatalom\Engine\Game();
        $player = new Player($game, 10);

        $isDead = false;

        $game->on(
            PlayerDied::class,
            function ($deadPlayer) use (&$isDead, $player) {
                if ($player === $deadPlayer) {
                    $isDead = true;
                }
            }
        );

        $player->damage(10);

        $this->assertTrue($isDead);
    }
}
