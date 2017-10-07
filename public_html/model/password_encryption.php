<?php

function generateHash($password) {
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
    }else{
	return 'Failed';
	}
}

function generateHash_sha1($password) {
   return sha1($password);
}

function verify($password, $hashedPassword) {
//return true;
return crypt($password, $hashedPassword) == $hashedPassword;
}

function verify_sha1($password, $hashedPassword) {
//return true;
return sha1($password) == $hashedPassword;
}

?>