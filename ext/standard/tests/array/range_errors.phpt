--TEST--
Test range() function (errors)
--INI--
precision=14
--FILE--
<?php

echo "\n*** Testing error conditions ***\n";

echo "\n-- Testing ( (low < high) && (step = 0) ) --";
var_dump( range(1, 2, 0) );
var_dump( range("a", "b", 0) );

echo "\n\n-- Testing ( (low > high) && (step = 0) ) --";
var_dump( range(2, 1, 0) );
var_dump( range("b", "a", 0) );

echo "\n\n-- Testing ( (low < high) && (high-low < step) ) --";
var_dump( range(1.0, 7.0, 6.5) );

echo "\n\n-- Testing ( (low > high) && (low-high < step) ) --";
var_dump( range(7.0, 1.0, 6.5) );

echo "\n-- Testing other conditions --";
var_dump( range(-1, -2, 2) );
try {
    var_dump( range("a", "j", "z") );
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}
var_dump( range(0, 1, "140962482048819216326.24") );
var_dump( range(0, 1, "140962482048819216326.24.") );

echo "\n-- Testing Invalid steps --";
$step_arr = array( "string", NULL, FALSE, "", "\0" );

foreach( $step_arr as $step ) {
    try {
        var_dump( range( 1, 5, $step ) );
    } catch (TypeError $e) {
        echo $e->getMessage(), "\n";
    }
}

echo "Done\n";
?>
--EXPECTF--
*** Testing error conditions ***

-- Testing ( (low < high) && (step = 0) ) --
Warning: range(): step exceeds the specified range in %s on line %d
bool(false)

Warning: range(): step exceeds the specified range in %s on line %d
bool(false)


-- Testing ( (low > high) && (step = 0) ) --
Warning: range(): step exceeds the specified range in %s on line %d
bool(false)

Warning: range(): step exceeds the specified range in %s on line %d
bool(false)


-- Testing ( (low < high) && (high-low < step) ) --
Warning: range(): step exceeds the specified range in %s on line %d
bool(false)


-- Testing ( (low > high) && (low-high < step) ) --
Warning: range(): step exceeds the specified range in %s on line %d
bool(false)

-- Testing other conditions --
Warning: range(): step exceeds the specified range in %s on line %d
bool(false)
range() expects parameter 3 to be int or float, string given

Warning: range(): step exceeds the specified range in %s on line %d
bool(false)

Notice: A non well formed numeric value encountered in %s on line %d

Warning: range(): step exceeds the specified range in %s on line %d
bool(false)

-- Testing Invalid steps --range() expects parameter 3 to be int or float, string given

Warning: range(): step exceeds the specified range in %s on line %d
bool(false)

Warning: range(): step exceeds the specified range in %s on line %d
bool(false)
range() expects parameter 3 to be int or float, string given
range() expects parameter 3 to be int or float, string given
Done
