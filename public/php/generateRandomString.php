<?php
    function generateRandomString($length = 5) {
    $characters = '01234567890123456789012345678901234567890123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }

    function generateRandomString1($length = 5) {
    $characters = 'abcdefghijkLmnopqrstuvwxyzABCDEFGHiJKLMOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString1 = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString1 .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString1;
    }
    $randomString = generateRandomString1().generateRandomString();
    
    
?>
