<?php

$person = [
    'first_name' => 'John',
    'last_name'  => 'Doe',
    'address' => [
        'street' => '491',
        'road' => '4',
        'area' => 'Banani',
        'city' => 'Dhaka',
        'country' => [
            'code' => 'BD',
            'full_name' => 'Bangladesh'
        ]
    ]
];

echo $person['first_name']. '<br/>';
echo $person['last_name']. '<br/>';
echo $person['address']['city']. '<br/>';
echo $person['address']['country']['full_name']. '<br/>';
//echo '<pre>';
//
//echo '</pre>';
