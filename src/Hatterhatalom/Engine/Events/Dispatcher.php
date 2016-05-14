<?php

namespace Hatterhatalom\Engine\Events;

/**
 * Class EventManager is the observable entity that is responsible for
 * managing event subscriptions and dispatchments.
 * Vastly inspired by Laravels event system implementation.
 */
class Dispatcher
{
    /**
     * The registered event listeners.
     *
     * @var array
     */
    protected $listeners = [];

    /**
     * Register an event listener with the dispatcher.
     *
     * @param string|object $event
     * @param callable      $listener
     */
    public function subscribe($event, callable $listener)
    {
        if (is_object($event)) {
            $event = get_class($event);
        }

        $this->listeners[$event][] = $listener;
    }

    /**
     * Unregister an event listener with the dispatcher.
     *
     * @param string|object $event
     * @param callable      $listener
     */
    public function unsubscribe($event, callable $listener)
    {
        if (is_object($event)) {
            $event = get_class($event);
        }

        if (!array_key_exists($event, $this->listeners)) {
            return;
        }

        if (($listenerKey = array_search($listener,
                $this->listeners[$event])) !== false
        ) {
            unset($this->listeners[$event][$listenerKey]);
        }
    }

    /**
     * Fires an event.
     *
     * @param string|object $event
     * @param mixed|null    $payload
     */
    public function fire($event, $payload = null)
    {
        if ($event instanceof Event) {
            $payload = $event->payload;
            $event = get_class($event);
        }

        $listeners = $this->getListeners($event);

        foreach ((array) $listeners as $listener) {
            call_user_func_array($listener, [$payload]);
        }
    }

    /**
     * Gets the listeners listening to a specified event.
     *
     * @param string $event
     *
     * @return null|array
     */
    protected function getListeners($event)
    {
        if (!array_key_exists($event, $this->listeners)) {
            return;
        }

        return $this->listeners[$event];
    }
}
