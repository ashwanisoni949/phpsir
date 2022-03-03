<?php

include __DIR__.'/dbconnect.php';
require __DIR__.'/vendor/autoload.php';


$table = new LucidFrame\Console\ConsoleTable();

$table
   ->addHeader('Sr No.')
    ->addHeader('Id')
    ->addHeader('Name')
    ->addHeader('Email');

#prepare the query

$sql = "SELECT * FROM emp";

#Execute the query

$result_set = mysqli_query($conn,$sql);
if(mysqli_num_rows($result_set)>0){
	$i=1;
	while($row=mysqli_fetch_assoc($result_set)){
		
		$table ->addRow()
				->addColumn($i)
				->addColumn($row['id'])
				->addColumn($row['name'])
				->addColumn($row['email']);
		$i++;
	}

	$table->display();
}else if(mysqli_num_rows($result_set)==0){

	echo "No record found";
}
else{
	echo "error".mysqli_query_error($conn);
}


 