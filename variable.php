<?php
// variable variable
$var1 = 'variable';
//$$var1 = 'Hello!';
//
//echo $variable;

function test()
{
    global $var;
    $var = 'Hello!<br/>';
    echo $var;
}

test();
$var = 'Another hello!<br/>';
echo $var;
