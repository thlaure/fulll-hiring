<?php

function fizzBuzz(int $inputNumber): string
{
    $response = '';
    for ($i = 1; $i <= $inputNumber; ++$i) {
        $response .= fizzBuzzNumber($i);
    }

    return $response;
}

function fizzBuzzNumber(int $number): string
{
    if ($number % 3 === 0 && $number % 5 === 0) {
        return 'FizzBuzz ';
    }

    if ($number % 3 === 0) {
        return 'Fizz ';
    }

    if ($number % 5 === 0) {
        return 'Buzz ';
    }

    return $number . ' ';
}

echo fizzBuzz(15);
