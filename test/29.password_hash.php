<?php

$p = '123456';
$hash = '$2y$10$fxNYYsnTLi5OzQFXbw.pyObYLGCR7/Z5RLbxDkB7jALDErCnuAZMK';

echo password_hash($p, PASSWORD_DEFAULT);

echo '<br>';
echo '<br>';

echo password_verify('123456', $hash) ? 'YES' : 'NO';


/*可用簡易的SQL語法比對帳號密碼(MD5也適用)
SELECT * FROM `members` WHERE `email`='ming@gg.com' AND `password`=SHA1('123456');
*/