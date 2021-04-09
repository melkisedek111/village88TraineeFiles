<?php
session_start();
date_default_timezone_set('Asia/Manila');
$date_acquired = date("F j, Y, g:i a");
$array_info = [
    'get_farm_coin' => [
        'gold' => rand(10, 20),
        'earned' => true,
        'place' => 'farm'
    ],
    'get_cave_coin' => [
        'gold' => rand(5, 10),
        'earned' => true,
        'place' => 'cave'
    ],
    'get_house_coin' => [
        'gold' => rand(2, 5),
        'earned' => true,
        'place' => 'house'
    ],
    'get_casino_coin' => [
        'gold' => rand(0, 50),
        'place' => 'casino'
    ],

];

if(isset($_POST['submit_form'])) {

    if($_POST['email'] == '') {
        $_SESSION['error_email'] = 'Email is empty';
    }
    
    if($_POST['password'] == '') {
        $_SESSION['error_password'] = 'Password is empty';
    }

    $_SESSION['email_value'] = $_POST['email'];
    $_SESSION['password_value'] = $_POST['password'];

    if($_POST['email'] !== '' AND $_POST['password'] !== '') {
        echo 'Form submitted';
        exit;
    }

    header('Location: .');
    exit;

}




// if(!isset($_SESSION['my_gold'])) {
//     $_SESSION['my_gold'] = 0;
// }

// function get_activities($place, $gold, $date, $earned) {
//     $isEarned = $earned ? "earned" : "lost";
//     $isOuched = !$earned ? ".. Ouch!" : "";
//     return ['log' => "You entered a $place and $isEarned $gold gold$isOuched ($date)", 'earned' => $earned];
// }

// function proccess($gold, $earned, $place) {
//     $_SESSION['gold'] = $gold;
//     $_SESSION['earned'] =  $earned;
//     $_SESSION['place'] = $place;
// }

// foreach($array_info as $key => $value) {
//     if($key !== 'get_casino_coin') {
//         if(isset($_POST[$key])) {
//             proccess($value['gold'], $value['earned'], $value['place']);
//         }
//     } else {
//         if(isset($_POST[$key])) {
//             if($_SESSION['my_gold'] < 10) {
//                 $_SESSION['activities'][] = ['log' => "Your current gold is not enough, go find more gold! ($date_acquired)", 'earned' => false];
//                 header('Location: .');
//                 exit();
//             }
//             if(rand(0, 100) > 65) {
//                 proccess($value['gold'], true, $value['place']);
//             } else {
//                 proccess($value['gold'], false, $value['place']);
//                 if($_SESSION['my_gold'] < $_SESSION['gold']) {
//                     $_SESSION['gold'] = $_SESSION['my_gold'];
//                 }
//             }
//         }
//     }
// }

// $_SESSION['my_gold'] = $_SESSION['earned'] ? $_SESSION['my_gold'] + $_SESSION['gold'] : $_SESSION['my_gold'] - $_SESSION['gold'];
// $_SESSION['activities'][] = get_activities($_SESSION['place'], $_SESSION['gold'], $date_acquired, $_SESSION['earned']);
// header('Location: .');
// exit();



// <?php
// session_start();
// date_default_timezone_set('Asia/Manila');
// $date_acquired = date("F j, Y, g:i a");

// function get_activities($place, $gold, $date, $earned) {
//     $isEarned = $earned ? "earned" : "lost";
//     $isOuched = !$earned ? ".. Ouch!": "";
//     return ['log' => "You entered a $place and $isEarned $gold gold$isOuched ($date)", 'earned' => $earned];
// }

// function proccess($minGold, $maxGold, $earned, $place) {
//     $_SESSION['gold'] = rand($minGold, $maxGold);
//     $_SESSION['earned'] = $earned;
//     $_SESSION['place'] = $place;
// }

// if(!isset($_SESSION['my_gold'])) {
//     $_SESSION['my_gold'] = 0;
// }
// if(isset($_POST['get_farm_coin'])) {
//     proccess(10,20, true, "farm");
// } elseif(isset($_POST['get_cave_coin'])) {
//     proccess(5,10, true, "cave");
// } elseif(isset($_POST['get_house_coin'])) {
//     proccess(2,5, true, "house");
// } elseif(isset($_POST['get_casino_coin'])) {
//     if($_SESSION['my_gold'] < 10) {
//         $_SESSION['activities'][] = ['log' => "Your current gold is not enough, go find more gold! ($date_acquired)", 'earned' => false];
//         header('Location: .');
//         exit();
//     }
//     if(rand(0, 100) > 65) {
//         proccess(0,50, true, "casino");
//     } else {
//         proccess(0,50, false, "casino");
//         if($_SESSION['my_gold'] < $_SESSION['gold']) {
//             $_SESSION['gold'] = $_SESSION['my_gold'];
//         }
//     }
// }
// $_SESSION['my_gold'] = $_SESSION['earned'] ? $_SESSION['my_gold'] + $_SESSION['gold'] : $_SESSION['my_gold'] - $_SESSION['gold'];
// $_SESSION['activities'][] = get_activities($_SESSION['place'], $_SESSION['gold'], $date_acquired, $_SESSION['earned']);
// header('Location: .');
// exit();
