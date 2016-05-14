<?php

namespace Hatterhatalom\Engine\Events\Arguments;

use Hatterhatalom\Engine\Cards\Card;

class CardAction
{
    /**
     * The action origin.
     *
     * @var Card
     */
    public $card;

    /**
     * Value indicating whether the action should happen.
     *
     * @var bool
     */
    public $shouldHappen = true;

    /**
     * CardAction constructor.
     *
     * @param Card $card
     */
    public function __construct(Card $card)
    {
        $this->card = $card;
    }
}
