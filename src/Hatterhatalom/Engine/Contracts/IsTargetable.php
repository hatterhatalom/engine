<?php
/**
 * Created by PhpStorm.
 * User: nxu
 * Date: 2016.05.14.
 * Time: 17:51
 */

namespace Hatterhatalom\Engine\Contracts;

use Hatterhatalom\Engine\Cards\CreatureCard;

interface IsTargetable
{
    public function attackWith(CreatureCard $card);
}
