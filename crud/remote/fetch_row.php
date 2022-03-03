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
	$data=[];
	while($row=mysqli_fetch_row($result_set)){
		$data[] = $row;
	}

}else if(mysqli_num_rows($result_set)==0){

	echo "No record found";
}
else{
	echo "error".mysqli_query_error($conn);
}

$i=1;
foreach($data as $row){

	$table ->addRow()
		->addColumn($i)
		->addColumn($row[0])
		->addColumn($row[1])
		->addColumn($row[2]);
		
	$i++;

}

$table->display();

 