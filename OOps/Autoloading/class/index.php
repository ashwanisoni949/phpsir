<?php
require_once __DIR__.'/bootstrap/app.php';

echo '<pre>';
print_r(get_included_files());
echo '<br/>';

$student = new Student();
$teacher = new Teacher();
$bauwa = new Bauwa();
