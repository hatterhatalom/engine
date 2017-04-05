<?php

namespace Hatterhatalom\Engine\Events\PlayerEvents;

use Hatterhatalom\Engine\Events\Contracts\IsCancellable;
use Hatterhatalom\Engine\Events\Event;
use Hatterhatalom\Engine\Events\Traits\Cancellation;

class PlayerEvent extends Event implements IsCancellable
{
    use Cancellation;
}
