<?php
/**
 * Created by PhpStorm.
 * User: nxu
 * Date: 2016.05.11.
 * Time: 20:21
 */

namespace Hatterhatalom\Engine\Events;

use Hatterhatalom\Engine\Cards\Card;

/**
 * Class CardWasPlayedEvent represents the event fired when a card has been
 * played.
 *
 * @package Hatterhatalom\Engine\Events
 */
class CardWasPlayedEvent extends Event
{
    public function __construct(Card $card)
    {
        $this->payload = $card;
    }
}