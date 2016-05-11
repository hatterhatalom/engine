<?php
/**
 * Created by PhpStorm.
 * User: nxu
 * Date: 2016.05.11.
 * Time: 20:22
 */

namespace Hatterhatalom\Engine\Events;

/**
 * Class Event represents an event dispatched by the Dispatcher.
 * @package Hatterhatalom\Engine\Events
 */
abstract class Event
{
    /**
     * The event payload.
     *
     * @var mixed
     */
    public $payload;
}