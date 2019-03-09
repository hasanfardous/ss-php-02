<?php

$persons = [
    // John Doe
    [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'address' => [
            'street' => '491',
            'road' => '4',
            'area' => 'Banani',
            'city' => 'Dhaka',
            'country' => [
                'code' => 'BD',
                'full_name' => 'Bangladesh',
            ],
        ],
    ],
    // Jane Doe
    [
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'address' => [
            'street' => '12',
            'road' => '4',
            'area' => 'Gulshan',
            'city' => 'Dhaka',
            'country' => [
                'code' => 'BD',
                'full_name' => 'Bangladesh',
            ],
        ],
    ],
    // Steve Doe
    [
        'first_name' => 'Steve',
        'last_name' => 'Doe',
        'address' => [
            'street' => '12',
            'road' => '4',
            'area' => 'Gulshan',
            'city' => 'Dhaka',
            'country' => [
                'code' => 'BD',
                'full_name' => 'Bangladesh',
            ],
        ],
    ],
];

foreach ($persons as $person) {
    foreach ($person as $index => $value) {
        if (is_array($value)) {
            iterate_array($value);
        } else {
            echo keytostring($index).': '.$value.'<br/>';
        }
    }
    echo '<hr/>';
}

function iterate_array($array)
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            iterate_array($value);
        } else {
            echo keytostring($key).': '.$value.'<br/>';
        }
    }
}

function keytostring($index)
{
    return ucwords(str_replace('_', ' ', $index));
}

