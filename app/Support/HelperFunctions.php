<?php

function obfuscate_email(string $email)
{
    $split = explode ( '@', $email );

    $firstPart = $split[0];
    $qty = (int) floor( num: strlen($firstPart) * 0.75 );
    $remaining = strlen($firstPart) - $qty;
    $maskedFirstPart = substr($firstPart, 0, $remaining) . str_repeat('*', $qty);

    
    $secondPart = $split[0];
    $qty = (int) floor( num: strlen($secondPart) * 0.75 );
    $remaining = strlen($secondPart) - $qty;
    $maskedSecondPart = str_repeat('*', $qty) . substr($secondPart, $remaining * -1, $remaining);

    return $maskedFirstPart . '@' . $maskedSecondPart;
}