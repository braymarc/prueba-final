<?php


namespace App\Http\Helpers;


class Security
{

    static function make_password($password) {
        $algorithm = "pbkdf2_sha256";
        $iterations = 10000;
        $newSalt = random_bytes (6);
        $newSalt = base64_encode($newSalt);
        $hash = hash_pbkdf2("SHA256", $password, $newSalt, $iterations, 0, true);
        $toDBStr = $algorithm ."$". $iterations ."$". $newSalt ."$". base64_encode($hash);
// This string is to be saved into DB, just like what Django generate.
        return $toDBStr;
    }

}
