<?php

include_once __DIR__.'/dbconnect.php';

$name = readline('Enter your Name: ');
$email = readline('Enter your Email: ');

$sql = "INSERT INTO emp(name,email) values('{$name}', '{$email}');";

if(mysqli_query($conn,$sql)){
    echo 'Record inserted Successfully with PK = '.mysqli_insert_id($conn);
	echo PHP_EOL;
	include __DIR__.'/rowcount.php';
}
else
{
    echo 'Record not inserted'.mysqli_error($conn);
}