<?php

class Player
{
    private array $hand = [];
    private int $points = 0;

    public function getHand(): array
    {
        return $this->hand;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function updatePoints(): void
    {
        $this->points = 0;
        $aceCount = 0;

        foreach ($this->hand as $card) {
            $this->points += $card->getValue();
            if ($card->getRank() === "A") {
                $aceCount++;
            }
        }

        while ($this->points > 21 && $aceCount > 0) {
            $this->points -= 10;
            $aceCount--;
        }
    }

    public function addCard(Card $card): void
    {
        $this->hand[] = $card;
        $this->updatePoints();
    }
}
