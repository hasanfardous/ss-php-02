<?php

$day = 'Monday';

switch ($day):
    case 'Friday':
        echo 'Today is a holiday.';
        break;
    case 'Saturday':
        echo 'We have class today.';
        break;
    default:
        echo 'We have no class today.';
endswitch;
