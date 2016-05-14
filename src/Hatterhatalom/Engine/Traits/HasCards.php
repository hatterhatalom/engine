<?php
namespace Hatterhatalom\Engine\Traits;

use Hatterhatalom\Engine\Cards\CardCollection;

/**
 * Trait HasCards is a basic implementation of the CanHaveCards interface.
 */
trait HasCards
{
    /**
     * The cards of the entity.
     *
     * @var CardCollection
     */
    protected $cardCollection;

    /**
     * Gets the cards of the entity.
     *
     * @return CardCollection
     */
    public function cards()
    {
        if (!($this->cardCollection instanceof CardCollection)) {
            $this->cardCollection = new CardCollection();
        }

        return $this->cardCollection;
    }
}
