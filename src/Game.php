<?php

class Game
{
    private Player $player;
    private Player $dealer;
    private Deck $deck;

    public function __construct(Player $player, Player $dealer, Deck $deck)
    {
        $this->player = $player;
        $this->dealer = $dealer;
        $this->deck = $deck;
    }

    public function startGame(): void
    {
        $this->player->addCard($this->deck->dealCard());
        $this->player->addCard($this->deck->dealCard());
        $this->dealer->addCard($this->deck->dealCard());
        $this->dealer->addCard($this->deck->dealCard());
    }

    public function playerHit(): void
    {
        $this->player->addCard($this->deck->dealCard());
    }

    public function dealerPlay(): void
    {
        while ($this->dealer->getPoints() < 17) {
            $this->dealer->addCard($this->deck->dealCard());
        }
    }

    public function getWinner(): string
    {
        if ($this->player->getPoints() > 21) {
            return "Победил диллер";
        }

        if ($this->dealer->getPoints() > 21) {
            return "Победил игрок";
        }

        if ($this->player->getPoints() > $this->dealer->getPoints()) {
            return "Победил игрок";
        } elseif ($this->player->getPoints() < $this->dealer->getPoints()) {
            return "Победил диллер";
        } else {
            return "Ничья";
        }
    }

    public function resetGame(): void
    {
        $this->player = new Player();
        $this->dealer = new Player();

        $this->deck->shuffle();
    }
}
