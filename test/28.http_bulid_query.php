<?php

$ar = [
    'a' => 10,
    'name' => 'Bill',
];

echo http_build_query($ar);