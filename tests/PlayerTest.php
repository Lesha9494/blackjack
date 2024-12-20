<?php

use PHPUnit\Framework\TestCase;

require_once 'src/Player.php';

class PlayerTest extends TestCase
{
    public function testAddCard()
    {
        $deck = new Deck();
        $player = new Player();
        $card = $deck->dealCard();

        $player->addCard($card);
        $this->assertCount(1, $player->getHand());
    }

    public function testUpdatePoints()
    {
        $deck = new Deck();
        $player = new Player();

        $player->addCard(new Card('10', 'Черви'));
        $player->addCard(new Card('K', 'Пики'));
        $this->assertEquals(20, $player->getPoints());
    }
}
