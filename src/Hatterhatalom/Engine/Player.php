<?php

namespace Hatterhatalom\Engine;

use Hatterhatalom\Engine\Cards\Card;
use Hatterhatalom\Engine\Contracts\CardLocation;
use Hatterhatalom\Engine\Events\Arguments\PlayerDeath;
use Hatterhatalom\Engine\Events\Arguments\PlayerHealthDifference;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerDied;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerIsBeingHealed;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerIsBeingKilled;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerIsTakingDamage;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerTookDamage;
use Hatterhatalom\Engine\Events\PlayerEvents\PlayerWasHealed;
use Hatterhatalom\Engine\Traits\HasCards;

/**
 * Class Player represents a player of the game.
 */
class Player implements CardLocation
{
    use HasCards {
        addCard as traitAddCard;
    }

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
     * Indicates whether the player is dead.
     *
     * @var bool
     */
    protected $isDead = false;

    /**
     * @var Game
     */
    protected $game;

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
     * Adds a card to the list of the cards of the player and sets its owner.
     *
     * @param Card $card
     */
    public function addCard(Card $card)
    {
        $this->traitAddCard($card);
        $card->setOwner($this);
    }

    /**
     * Gets the game the player is in.
     *
     * @return Game
     */
    public function game()
    {
        return $this->game;
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
     * Alias of the getHealth method.
     *
     * @return int
     */
    public function health()
    {
        return $this->getHealth();
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
     * Alias of the getMaxHealth method.
     *
     * @return int
     */
    public function maxHealth()
    {
        return $this->getMaxHealth();
    }

    /**
     * Reduces the health of the player with a given amount.
     *
     * @param $damage
     *
     * @return Player
     */
    public function damage($damage)
    {
        if (!($damage instanceof PlayerHealthDifference)) {
            $damage = new PlayerHealthDifference($damage, $this);
        }

        $this->game->trigger(new PlayerIsTakingDamage($damage));

        if ($damage->difference < 1) {
            return $this;
        }

        $this->health -= $damage->difference;
        $this->game->trigger(new PlayerTookDamage($damage));

        if ($this->health <= 0) {
            $this->kill();
        }

        return $this;
    }

    /**
     * Heals the player.
     *
     * @param $health
     *
     * @return Player
     */
    public function heal($health)
    {
        if (!($health instanceof PlayerHealthDifference)) {
            $health = new PlayerHealthDifference($health, $this);
        }

        $this->game->trigger(new PlayerIsBeingHealed($health));

        // There is no negative or zero heal
        if ($health->difference < 1) {
            return $this;
        }

        $this->health += $health->difference;

        // Health can not be higher than max
        if ($this->health > $this->maxHealth) {
            $health->difference = $this->maxHealth - $this->health;
            $this->health = $this->maxHealth;
        }

        $this->game->trigger(new PlayerWasHealed($health));

        return $this;
    }

    /**
     * Kills the player.
     */
    public function kill()
    {
        $death = new PlayerDeath($this);
        $this->game->trigger(new PlayerIsBeingKilled($death));

        if ($death->shouldHappen) {
            $this->isDead = true;
            $this->game->trigger(new PlayerDied($this));
        }

        return $this;
    }

    /**
     * Gets a value indicating whether the player is alive.
     *
     * @return bool
     */
    public function isAlive()
    {
        return !$this->isDead();
    }

    /**
     * Gets a value indicating whether the player is dead.
     *
     * @return bool
     */
    public function isDead()
    {
        return $this->isDead;
    }
}
