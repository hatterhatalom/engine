<?php

namespace Hatterhatalom\Engine\Contracts;

use Hatterhatalom\Engine\Cards\CreatureCard;

interface IsTargetable
{
    public function attackWith(CreatureCard $card);
}
