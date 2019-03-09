<?php

//function mul_table($mul): void
//{
//    for ($number = 1; $number <= 10; $number++) {
//        echo $number.' x '.$mul.' = '.$number * $mul.' <br/>';
//    }
//}
//
//mul_table(8);

if (!function_exists('sum')) {
    function sum(...$numbers)
    {
        $sum = 0;
        foreach ($numbers as $number) {
            $sum += $number;
        }

        return $sum;
    }
}


function product(...$numbers)
{
    $product = function ($carry, $item) {
        return $carry * $item;
    };

    return array_reduce($numbers, $product, 1);
}

function task($numbers, Closure $operation)
{
    return $operation($numbers);
}

$initial = 75;

echo task([10, 23], function ($array) use ($initial) {
    $product = function ($carry, $item) {
        return $carry * $item;
    };

    return array_reduce($array, $product, 1) + $initial;
});




