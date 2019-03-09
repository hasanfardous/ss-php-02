<?php

$day = 'Friday';
$message = $day ?? 'Please provide a day';

if (isset($day)) {
    $message = $day === 'Saturday' ? 'We have class today' : 'No class';
}

echo $message;


//$time = '14:00';
//
//if ($day === 'Saturday') {
//    echo 'We have class today.';
//
//    if ($time === '09:00') {
//        echo 'Morning batch class will start. ';
//    } elseif ($time === '14:00') {
//        echo 'Afternoon batch class will start. ';
//    } else {
//        echo 'No class. ';
//    }
//} elseif ($day === 'Friday') {
//    echo 'Today is a holiday.';
//} else {
//    echo 'We have no class today.';
//}



