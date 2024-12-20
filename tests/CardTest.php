<?php

use PHPUnit\Framework\TestCase;

require_once 'src/Card.php';

class CardTest extends TestCase
{
    public function testCardCreation()
    {
        $card = new Card('A', 'Черви');
        $this->assertEquals('A', $card->getRank());
        $this->assertEquals('Черви', $card->getSuit());
    }

    public function testCardValue()
    {
        $card = new Card('K', 'Пики');
        $this->assertEquals(10, $card->getValue());
    }
}
