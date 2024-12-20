<?php

use PHPUnit\Framework\TestCase;

require_once 'src/Deck.php';
class DeckTest extends TestCase
{
    public function testGetCards()
    {
        $deck = new Deck();

        $cards = $deck->getCards();
        $this->assertIsArray($cards);

        $this->assertCount(52, $cards);
    }

    public function testDeckDealCard()
    {
        $deck = new Deck();
        $card = $deck->dealCard();
        $this->assertInstanceOf(Card::class, $card);
    }
}
