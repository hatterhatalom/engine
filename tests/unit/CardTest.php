<?php
class SampleCard extends \Hatterhatalom\Engine\Cards\Card
{
}

class CardTest extends PHPUnit_Framework_TestCase
{
    public function test_if_card_is_not_in_game_by_default()
    {
        $card = $this->getSampleCardInstance();
        $this->assertFalse($card->isInGame());
    }

    public function test_if_card_can_be_played()
    {
        $card = $this->getSampleCardInstance();
        $card->play();

        $this->assertTrue($card->isInGame());
    }

    public function test_if_playing_a_card_places_it_to_the_board()
    {
        $card = $this->getSampleCardInstance();
        $card->play();

        $this->assertSame(
            $card->owner()->game()->board(),
            $card->location()
        );
    }

    public function test_if_playing_a_card_can_be_prevented()
    {
        $card = $this->getSampleCardInstance();
        $game = $card->owner()->game();

        $game->on(
            Hatterhatalom\Engine\Events\CardEvents\CardIsBeingPlayed::class,
            function ($action) {
                $action->shouldHappen = false;
            }
        );

        $card->play();
        $this->assertFalse($card->isInGame());
    }

    public function test_if_card_can_be_destroyed()
    {
        $card = $this->getSampleCardInstance();
        $card->play();


        $this->assertTrue($card->isInGame());
        $card->destroy();
        $this->assertFalse($card->isInGame());
    }

    public function test_if_card_destruction_can_be_prevented()
    {
        $card = $this->getSampleCardInstance();
        $game = $card->owner()->game();

        $game->on(
            Hatterhatalom\Engine\Events\CardEvents\CardIsBeingDestroyed::class,
            function ($action) {
                $action->shouldHappen = false;
            }
        );

        $card->play();
        $this->assertTrue($card->isInGame());

        $card->destroy();
        $this->assertTrue($card->isInGame());
    }

    /**
     * @return SampleCard
     */
    private function getSampleCardInstance()
    {
        $card = new SampleCard();
        $player = new \Hatterhatalom\Engine\Player(
            new \Hatterhatalom\Engine\Game()
        );

        $player->addCard($card);

        return $card;
    }
}
