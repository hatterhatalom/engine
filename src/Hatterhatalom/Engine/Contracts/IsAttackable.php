<?php

namespace Hatterhatalom\Engine\Contracts;

use Hatterhatalom\Engine\Cards\CreatureCard;

interface IsAttackable
{
    public function attackWith(CreatureCard $card);
}
