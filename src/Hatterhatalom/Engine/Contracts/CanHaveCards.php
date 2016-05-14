<?php

namespace Hatterhatalom\Engine\Contracts;

/**
 * Interface CanHaveCards represents a contract for entities that are able
 * to possess cards.
 */
interface CanHaveCards
{
    /**
     * Gets the cards of the entity.
     *
     * @return \Hatterhatalom\Engine\Cards\CardCollection
     */
    public function cards();
}
