<?php

class Deck
{
    private array $cards = [];

    public function __construct()
    {
        $ranks = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];

        foreach ($suits as $suit) {
            foreach ($ranks as $rank) {
                $this->cards[] = new Card($rank, $suit);
            }
        }
    }

    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    public function dealCard(): Card
    {
        return array_pop($this->cards);
    }
}
