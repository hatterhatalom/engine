<?php

namespace Hatterhatalom\Engine\Events\CardEvents;

use Hatterhatalom\Engine\Events\Contracts\IsCancellable;
use Hatterhatalom\Engine\Events\Event;
use Hatterhatalom\Engine\Events\Traits\Cancellation;

class CardEvent extends Event implements IsCancellable
{
    use Cancellation;
}
