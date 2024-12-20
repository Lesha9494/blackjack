<?php

use PHPUnit\Framework\TestCase;

require_once 'src/Game.php';

class GameTest extends TestCase
{
    public function testStartGame()
    {
        $deck = new Deck();
        $player = new Player();
        $dealer = new Player();
        $game = new Game($player, $dealer, $deck);

        $game->startGame();
        $this->assertCount(2, $player->getHand());
        $this->assertCount(2, $dealer->getHand());
    }

    public function testPlayerHit()
    {
        $deck = new Deck();
        $player = new Player();
        $dealer = new Player();
        $game = new Game($player, $dealer, $deck);

        $game->startGame();
        $game->playerHit();

        $this->assertCount(3, $player->getHand());
    }
}
