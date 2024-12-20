<?php

class Game
{
    private Player $player;
    private Player $dealer;
    private bool $gameOver = false;
    private Deck $deck;
    private string $winner = '';

    public function __construct(Player $player, Player $dealer, Deck $deck)
    {
        $this->player = $player;
        $this->dealer = $dealer;
        $this->deck = $deck;
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function getDealer(): Player
    {
        return $this->dealer;
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
        if ($this->player->getPoints() > 21) {
            $this->gameOver = true;
            $this->determineWinner();
        }
    }

    public function dealerPlay(): void
    {
        while ($this->dealer->getPoints() < 17) {
            $this->dealer->addCard($this->deck->dealCard());
        }
        $this->gameOver = true;
        $this->determineWinner();
    }

    public function isGameOver(): bool
    {
        return $this->gameOver;
    }

    public function getWinner(): string
    {
        return $this->winner;
    }

    private function determineWinner(): void
    {
        $playerPoints = $this->player->getPoints();
        $dealerPoints = $this->dealer->getPoints();

        if ($playerPoints > 21) {
            $this->winner = 'Дилер';
        } elseif ($dealerPoints > 21) {
            $this->winner = 'Игрок';
        } elseif ($playerPoints > $dealerPoints) {
            $this->winner = 'Игрок';
        } elseif ($dealerPoints > $playerPoints) {
            $this->winner = 'Дилер';
        } else {
            $this->winner = 'Ничья';
        }
    }

    public function resetGame(): void
    {
        $this->player = new Player();
        $this->dealer = new Player();
        $this->deck->shuffle();
        $this->gameOver = false;
        $this->winner = '';
    }
}
