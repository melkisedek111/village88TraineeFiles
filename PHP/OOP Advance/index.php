<?php
session_start();

class Cards
{
    public $cards = 13;
    public $suits = ['s', 'c', 'h', 'd'];
    public $deck;
    public $temp;
    public $c = 0;
    public function __construct()
    {
        if(isset($_SESSION['Cards'])) {
            $this->deck = $_SESSION['Cards'];
        }
    }

    public function shuffle()
    {
        if(!isset($_SESSION['Cards'])) {
            for ($i = 0; $i < count($this->suits);$i++) {
                for ($x = 1; $x <= $this->cards; $x++) {
                    $this->deck[] = "{$this->suits[$i]}$x";
                }
            }
            shuffle($this->deck);
            $_SESSION['Cards'] = $this->deck;
        }
    }

    public function reset()
    {
        $this->deck = [];
        for ($i = 0; $i < count($this->suits);$i++) {
            for ($x = 1; $x <= $this->cards; $x++) {
                $this->deck[] = "{$this->suits[$i]}$x";
            }
        }
    }

    public function dealt($card)
    {
        $removeRandomCard = $card[rand(0, count($card) - 1)];
        $temp = [];
        for($i = 0; $i < count($card); $i++) {
            if($removeRandomCard != $card[$i])  {
                $temp[] = $card[$i];
            }
        }
        $this->set_deck($temp);
        return $removeRandomCard;
    }
    public function set_deck($card) {
        $_SESSION['Cards'] = $card;
        $this->deck = $card;
    }
}

class Player extends Cards
{
    public $name;
    public $hands  = [];
    public $score = 0;
    public $add_score = 0;
    public $cardAces = [];
    public $pot = 0;
    public $bet = 0;
    public function __construct($name)
    {
        parent::__construct();
        $this->name = $name;
        if(isset($_SESSION[$this->name]['aces'])) {
            $this->cardAces = $_SESSION[$this->name]['aces'];
            foreach($this->cardAces as $ace) {
                $this->add_score += explode("/", $ace)[1];
            }
        }
        if(isset($_SESSION[$this->name]['bet']) && $_SESSION[$this->name]['bet'] > 0) {
            $this->bet = $_SESSION[$this->name]['bet'];
        }
        if(isset($_SESSION[$this->name]['pot']) && $_SESSION[$this->name]['pot'] > 0) {
            $this->pot = $_SESSION[$this->name]['pot'];
        }
    }
    
    public function hands() {
        $this->hands = [];
        foreach($_SESSION[$this->name]['Cards'] as $card) {
            array_push($this->hands, $card);
        }
    }

    public function draw($card) {
        array_push($this->hands, $card);
        array_push($_SESSION[$this->name]['Cards'], $card);
    }

    public function setPlayerCardsContainer() {
        if(!isset($_SESSION[$this->name]['Cards'])) {
            $_SESSION[$this->name]['Cards'] = [];
        }
    }

    public function cardValue($card) {
        $value = filter_var($card, FILTER_SANITIZE_NUMBER_INT);
        if($value < 10) {
            $value = filter_var($card, FILTER_SANITIZE_NUMBER_INT);
        } else {
            $value = 10;
        }
        return $value;
    }

    public function setAddScore($score) {
        $this->add_score = $score;
        $_SESSION[$this->name]['score']['added_score'] = $score;
    }
  
    public function getAces($cardOne, $index) {
        $theCard = explode("/", $cardOne)[$index];
        if($index == 0) return $theCard;
        if($theCard != 11 && $theCard != 1) {
            return true;
        } else {
            return false;
        }
    }

    public function findCardAces($value) {
        foreach($this->hands as $findOne) {
            if($this->cardValue($findOne) == 1) { // CHANGE THIS VALUE
                if(count($this->cardAces) > 0) {
                    foreach($this->cardAces as $cardOne) {
                        if($this->getAces($cardOne, 1)) {
                            array_push($this->cardAces, $findOne."/".$value);
                            $_SESSION[$this->name]['aces'][] = $findOne."/".$value;
                        }
                    }
                } else {
                    array_push($this->cardAces, $findOne."/".$value);
                    $_SESSION[$this->name]['aces'][] = $findOne."/".$value;
                }     
            }
        }
    }

    public function getTotalScore() {
        foreach($this->hands as $card) {
            if(count($this->cardAces) > 0) {
                foreach($this->cardAces as $ace) {
                    if($card != $this->getAces($ace, 0)) {
                        $this->score += $this->cardValue($card);
                    }
                }
            } else {
                $this->score += $this->cardValue($card);
            }
        }
        foreach($this->cardAces as $ace) {
            $this->score += explode("/", $ace)[1];
        }
    }

    public function playerTurn($arr, $player) {
        $counter = 0;
        foreach($arr as $k => $v) {
            $_SESSION[$v]['turn'] = false;
            if($arr[count($arr) - 1] == $player) {
                $counter = 0;
            } elseif($v == $player) {
                $counter = $k + 1;
            }
        }
        $_SESSION[$arr[$counter]]['turn'] = true;
    }

    public function makePlayerBet($bet) {
        $this->bet += $bet;
        $_SESSION[$this->name]['bet'] = $bet;
    }

    public function playerBusted($arr) {
        if($this->name != "Dealer") {
            $_SESSION["Dealer"]['pot'] += $_SESSION[$this->name]['bet'];
            $_SESSION[$this->name]['bet'] = 0;
            $_SESSION[$this->name]['Cards'] = [];
            $this->hands = [];
            $this->bet = 0; 
        }
        if($this->name == "Dealer") { 
           $loss = 0;
            foreach($arr as $player) {
                if($player != "Dealer") {
                    $loss += $_SESSION[$player]['bet'];
                    $_SESSION[$player]['pot'] += $_SESSION[$player]['bet'] * 2;
                    $_SESSION[$player]['bet'] = 0;
                }
                $_SESSION[$player]['Cards'] = [];
            }
            $_SESSION[$this->name]['pot'] -= $loss;
            $_SESSION[$this->name]['bet'] = 0;
            $_SESSION[$this->name]['Cards'] = [];
            $this->hands = [];
            $this->pot = $_SESSION[$this->name]['pot']; 
        }
    }

    public function playerWinner($arr) {
        if($this->name == 'Dealer') {
            $win = 0;
            foreach($arr as $player) {
                if($player != 'Dealer') {
                    $win += $_SESSION[$player]['bet'];
                    $_SESSION[$player]['bet'] = 0;
                }
                $_SESSION[$player]['Cards'] = [];
            }
            $_SESSION[$this->name]['pot'] += $win;
        } else {
            $_SESSION[$this->name]['pot'] += $_SESSION[$this->name]['bet'] + ($_SESSION[$this->name]['bet'] / 2);
            $_SESSION[$this->name]['bet'] = 0;
            $_SESSION[$this->name]['Cards'] = [];
        }
    }
    public function checkScore($arr) {
        $score = 0;
        foreach($arr as $card) {
            $score += $this->cardValue($card);
        }
        return $score;
    }

    public function endRound($arr) {
        foreach($arr as $player) {
            if($player != 'Dealer') {
                if($this->checkScore($_SESSION['Dealer']['Cards']) > $this->checkScore($_SESSION[$player]['Cards'])) {
                    $_SESSION["Dealer"]['pot'] += $_SESSION[$player]['bet'];
                } else {
                    $_SESSION[$player]['pot'] += $_SESSION[$player]['bet'] * 2;
                    $_SESSION['Dealer']['pot'] -= $_SESSION[$player]['bet'];
                }
            } 
            $_SESSION[$player]['bet'] = 0;
            $_SESSION[$player]['Cards'] = [];
            $this->hands = [];
            $this->bet = 0; 
        }
    }
}


echo "<pre>";
$Cards = new Cards();
$Cards->shuffle();
// $Cards->reset();

$Players = ['Dealer', 'Joe', 'John', 'Jack'];


if(!isset($_SESSION["Dealer"]['turn'])) {
    foreach($Players as $player) {
        if($player == "Dealer") {
            $_SESSION[$player]['turn'] = true;
        } else {
            $_SESSION[$player]['turn'] = false;
        }
    }
}


foreach($Players as $player) {
    ${$player} = new Player($player);
    ${$player}->setPlayerCardsContainer();
    ${$player}->hands();
    if(@$_SESSION[${$player}->name]['Draw'] > 0) {
        ${$player}->draw($Cards->dealt($Cards->deck));
        $_SESSION[${$player}->name]['Draw'] = 0;
    }
 
    if(isset($_POST["Dealer_serve_card"])) {
        foreach($Players as $p) {
            $_SESSION[$p]['Draw'] = 1;
        }
        header("Location: .");
        exit;
    }

    if(isset($_POST[${$player}->name.'_show_second_card'])) {
        $_SESSION[${$player}->name]['2nd_card'] = true;
        // ${$player}->playerTurn($Players, ${$player}->name);
        header("Location: .");
        exit;
    }

    if(isset($_POST[${$player}->name.'_restart'])) {
        session_destroy();
        header("Location: .");
        exit;
    }
    if(isset($_POST[${$player}->name.'_end_round'])) {
        ${$player}->endRound($Players);
        header("Location: .");
        exit;
    }

    if(isset($_POST[${$player}->name.'_winner_21'])) {
        ${$player}->playerWinner($Players);
        ${$player}->playerTurn($Players, ${$player}->name);
        header("Location: .");
        exit;
    }
    if(isset($_POST[${$player}->name.'_busted'])) {
        if(${$player}->name == 'Dealer') {
            ${$player}->playerBusted($Players);
            ${$player}->playerTurn($Players, $Players[count($Players) - 1]);
        } else {
            ${$player}->playerBusted($Players);
            ${$player}->playerTurn($Players, ${$player}->name);
        }

        header("Location: .");
        exit;
    }

    if(isset($_POST[${$player}->name.'_bet'])) {
        $bet = $_POST[${$player}->name.'_bet_value'];
        ${$player}->makePlayerBet($bet);
        header("Location: .");
        exit;
    }
    if(isset($_POST[${$player}->name.'_stay_card'])) {
        ${$player}->playerTurn($Players, ${$player}->name);
        header("Location: .");
        exit;
    }
    if(isset($_POST[${$player}->name.'_draw_card'])) {
        $_SESSION[$player]['Draw'] = 1;
        header("Location: .");
        exit;
    }
    if(isset($_POST[${$player}->name.'_make_eleven'])) {
        ${$player}->findCardAces(11);
        header("Location: .");
        exit;
    }
    if(isset($_POST[${$player}->name.'_make_one'])) {
        ${$player}->findCardAces(1);
        header("Location: .");
        exit;
    }

    ${$player}->getTotalScore();
    // echo ${$player}->score . PHP_EOL;

    // var_dump($_SESSION[${$player}->name]['turn']);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <style>
        .card-container {
            width: 1000px;
            display: flex;
            flex-wrap: wrap;
            margin: 0 auto;
            justify-content: center;
        }
        .card-container > img {
            margin: 5px;
        }
        input {
            display: inline-block;
        }
            .player-container {
                text-align: center;
                display: flex;
                justify-content: space-between;
                padding: 0 20px;
            }
                .player-container > div {
                    position: relative;
                }
                    .player-container > div > form > h1 {
                        margin: 0;
                    }
            .card-hands {
                display: flex;
                align-items: center;
                justify-content: center;
            }
                .card-hands > a {
                    width: 72px;
                    display: flex;
                    flex-direction: column;
                    margin: 0 5px;
                }
                    .card-hands > a > form {
                        display: flex;
                        align-items: center;
                    }
                        .card-hands > a > form > p {
                            margin: 0 5px;
                        }
                    .card-hands > a > p {
                        font-size: 15px;
                    }
        .player-button, .bet-button {
            display: flex;
            justify-content: center;
        }
        .oneeleven {
            display: flex;
        }
            .oneeleven > p {
                margin: 0 5px;
            }
        .block {
            background: rgba(0, 0, 0, .8);
            /* height: 500px; */
            width: 100%;
            display: block;
            position: absolute;
            z-index: 10;
            color: white;
            word-wrap: break-word;
        }
        .bet > p > span{
            font-weight: bolder;
            font-size: 20px;
        }
        .form-bet {
            z-index: 999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-top: 20px;
        }
            .form-bet > form {
                display: flex;
                justify-content: center;
            }
    </style>
<body>
    <div class="card-container">
        <!-- <?php foreach($Cards->deck as $card): ?>
            <img src="/cards-png/<?= $card; ?>.png" alt="<?= $card; ?>">
        <?php endforeach; ?> -->
    </div>

    <h1>Number of Cards left: <?= count($_SESSION['Cards']) ?></h1>
    <div class="player-container">
        <?php foreach($Players as $player): ?>
            <div>
               
                <form action="." method="POST">
                    <div class="bet">
                        <p>Pot: <span>$<?= ${$player}->pot ?></span></p>
                        <p>Bet: <span>$<?= ${$player}->bet ?></span></p>
                    </div>
                    <h1><?= $player ?></h1>
                    <div class="card-hands">

                        <?php foreach(${$player}->hands as $key => $card): ?>
                                <a>
                                <?php if(${$player}->name == 'Dealer' && $key == 1 && !@$_SESSION[${$player}->name]['2nd_card']): ?>
                                    <img src="/cards-png/b1fv.png" alt="<?= $card; ?>">
                                <?php else: ?>

                                    <?php if(${$player}->cardValue($card) == 1 || ${$player}->cardValue($card) == 11): ?>
                                        <?php if(count(${$player}->cardAces)  > 0): ?>
                                            <?php foreach(${$player}->cardAces as $ace) : ?>
                                                <?php if($card == ${$player}->getAces($ace, 0)): ?>
                                                    <p><?= explode("/", $ace)[1]; ?></p>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="oneeleven">
                                                <input type="submit" name="<?= $player ?>_make_one" value="Go 1">
                                                <p><?= ${$player}->cardValue($card); ?></p>
                                                <input type="submit" name="<?= $player ?>_make_eleven" value="Go 11">
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <p><?= ${$player}->cardValue($card); ?></p>
                                    <?php endif; ?>
                                    <img src="/cards-png/<?= $card; ?>.png" alt="<?= $card; ?>">
                                <?php endif; ?>
                                </a>
                            <?php endforeach; ?>
                    </div>
                    <div class="player-button">
                        <?php if(${$player}->score == 21): ?>
                            <div class="block">
                                <p>WINNER, 1 and half of your bet</p>
                            </div>
                        <?php elseif(${$player}->name != "Dealer" && @${$player}->bet < 0): ?>
                            <div class="block">
                                <p>Place a bet to Play</p>
                            </div>
                        <?php elseif(${$player}->score > 21): ?>
                            <div class="block">
                                <p>You are Busted</p>
                            </div>
                        <?php elseif(@!$_SESSION[${$player}->name]['turn']): ?>
                            <div class="block">
                                <p>Wait for your turn</p>
                            </div>
                        <?php endif; ?>
                        <?php if($player == "Dealer"): ?>
                            <input type="submit" name="Dealer_serve_card" value="Serve Card">
                            <?php if(@$_SESSION[${$player}->name]['2nd_card'] || count(${$player}->hands) > 1): ?>
                                <input type="submit" name="<?= $player ?>_show_second_card" value="Show 2nd Card">
                            <?php endif; ?>
                            <input type="submit" name="<?= $player ?>_end_round" value="End Round">
                            <input type="submit" name="<?= $player ?>_restart" value="Restart">
                        <?php endif; ?>
                        <input type="submit" name="<?= $player ?>_draw_card" value="Draw">
                        <input type="submit" name="<?= $player ?>_stay_card" value="Stay">
                    </div>
                </form>
                <div class="form-bet">
                    <?php if(${$player}->score > 21): ?>
                        <form action="." method="POST">
                            <input type="submit" name="<?= $player ?>_busted" value="Busted">
                        </form>
                    <?php endif; ?>
                    <?php if(${$player}->score == 21): ?>
                        <form action="." method="POST">
                            <input type="submit" name="<?= $player ?>_winner_21" value="Get Reward">
                        </form>
                    <?php endif; ?>
                <?php if($player != "Dealer"): ?>
                        <?php if(@${$player}->bet == 0): ?>
                            <form action="." method="POST">
                                <div class="bet-button">
                                    <input type="text" name="<?= $player ?>_bet_value" required>
                                    <input type="submit" name="<?= $player ?>_bet" value="Bet">
                                </div>
                            </form> 
                        <?php endif; ?>
                <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

