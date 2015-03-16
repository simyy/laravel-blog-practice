<?php

$users = User::all();

foreach ($users as $user) {
    echo $user->name;
    echo ' ';
    echo $user->passwd;
    echo '<br/>';
}
