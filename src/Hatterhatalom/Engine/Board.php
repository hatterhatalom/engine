<?php

namespace Hatterhatalom\Engine;

use Hatterhatalom\Engine\Contracts\CardLocation;
use Hatterhatalom\Engine\Traits\HasCards;

class Board implements CardLocation
{
    use HasCards;
}
