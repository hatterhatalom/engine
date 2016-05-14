<?php

namespace Hatterhatalom\Engine;

use Hatterhatalom\Engine\Contracts\CanHaveCards;
use Hatterhatalom\Engine\Events\Arguments\PlayerHealthDifference;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerIsBeingHealed;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerIsTakingDamage;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerTookDamage;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerWasHealed;
use Hatterhatalom\Engine\Traits\HasCards;

/**
 * Class Player represents a player of the game.
 */
class Player implements CanHaveCards
{
    use HasCards;

    /**
     * The health of the player.
     *
     * @var int
     */
    protected $health;

    /**
     * Gets the max health of the player.
     *
     * @var int
     */
    protected $maxHealth;

    /**
     * @var Game
     */
    public $game;

    /**
     * Initializes an instance of the new Player object.
     *
     * @param Game         $game
     * @param CanHaveCards $owner
     * @param int          $health
     */
    public function __construct(Game $game, $health = 20)
    {
        $this->game = $game;
        $this->game->addPlayer($this);

        $this->health = $this->maxHealth = $health;
    }

    /**
     * Gets the health of the player.
     *
     * @return int
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Gets the max health of the player.
     *
     * @return int;
     */
    public function getMaxHealth()
    {
        return $this->maxHealth;
    }

    /**
     * Reduces the health of the player with a given amount.
     *
     * @param $damage
     */
    public function damage($damage)
    {
        if (!($damage instanceof PlayerHealthDifference)) {
            $damage = new PlayerHealthDifference($damage, $this);
        }

        $this->game->trigger(new PlayerIsTakingDamage($damage));

        if ($damage->difference < 1) {
            return;
        }

        $this->health -= $damage->difference;

        $this->game->trigger(new PlayerTookDamage($damage));
    }

    /**
     * Heals the player
     *
     * @param $health
     */
    public function heal($health)
    {
        if (!($health instanceof PlayerHealthDifference)) {
            $health = new PlayerHealthDifference($health, $this);
        }

        $this->game->trigger(new PlayerIsBeingHealed($health));

        // There is no negative or zero heal
        if ($health->difference < 1) {
            return;
        }

        $this->health += $health->difference;

        // Health can not be higher than max
        if ($this->health > $this->maxHealth) {
            $this->health = $this->maxHealth;
        }

        $this->game->trigger(new PlayerWasHealed($health));
    }
}
