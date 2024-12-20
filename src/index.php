<?php
session_start();
require_once 'Card.php';
require_once 'Deck.php';
require_once 'Player.php';
require_once 'Game.php';

if (isset($_POST['action']) && $_POST['action'] === 'start_game') {
    $deck = new Deck();
    $player = new Player();
    $dealer = new Player();
    $game = new Game($player, $dealer, $deck);
    $game->startGame();
    $_SESSION['game'] = serialize($game);
    $_SESSION['game_started'] = true;
} elseif (isset($_SESSION['game'])) {
    $game = unserialize($_SESSION['game']);
}

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'hit' && !$game->isGameOver()) {
        $game->playerHit();
    } elseif ($_POST['action'] === 'stand' && !$game->isGameOver()) {
        $game->dealerPlay();
    }
    $_SESSION['game'] = serialize($game);
}

$playerPoints = 0;
$dealerPoints = 0;
$winner = '';
if (isset($game)) {
    $player = $game->getPlayer();
    $dealer = $game->getDealer();
    $playerPoints = $player->getPoints();
    $dealerPoints = $dealer->getPoints();
    if ($game->isGameOver()) {
        $winner = $game->getWinner();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Блек Джек</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 style="text-align: center;">BlackJack</h1>

    <div class="box">
        <div class="player">
            <h2 style="text-align: center;">Игрок</h2>
            <h3 style="text-align: center;">Очки: <?php echo $playerPoints; ?></h3>
            <div class="cards">
                <?php foreach ($player->getHand() as $card): ?>
                    <div class="card">
                        <span class="rank"><?php echo $card->getRank(); ?></span>
                        <span class="suit"><?php echo $card->getSuit(); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="dealer">
            <h2 style="text-align: center;">Дилер</h2>
            <h3 style="text-align: center;">
                Очки:
                <?php
                if ($game->isGameOver()) {
                    echo $dealerPoints;
                } else {
                    echo '???';
                }
                ?>
            </h3>

            <div class="cards">
                <?php if (!$game->isGameOver()): ?>
                    <div class="card">
                        <span class="rank"><?php echo $dealer->getHand()[0]->getRank(); ?></span>
                        <span class="suit"><?php echo $dealer->getHand()[0]->getSuit(); ?></span>
                    </div>
                    <div class="card back"></div>
                <?php else: ?>
                    <?php foreach ($dealer->getHand() as $card): ?>
                        <div class="card">
                            <span class="rank"><?php echo $card->getRank(); ?></span>
                            <span class="suit"><?php echo $card->getSuit(); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if ($game->isGameOver()): ?>
        <h3 style="text-align: center;">Победитель: <?php echo $winner; ?></h3>
    <?php endif; ?>
    <div class="buttons">
        <?php if (!isset($_SESSION['game_started']) || !$_SESSION['game_started']): ?>
            <form action="index.php" method="post">
                <button class="player-button" type="submit" name="action" value="start_game">Начать игру</button>
            </form>
        <?php elseif (!$game->isGameOver()): ?>
            <form action="index.php" method="post">
                <button class="player-button" type="submit" name="action" value="hit">Взять</button>
                <button class="player-button" type="submit" name="action" value="stand">Остановиться</button>
            </form>
        <?php else: ?>
            <form action="index.php" method="post">
                <button class="player-button" type="submit" name="action" value="start_game">Начать новую игру</button>
            </form>
        <?php endif; ?>
    </div>

</body>

</html>