<?php
$con = mysqli_connect("localhost","root","","pankaj_test");
//require 'db.php';


$panel=mysqli_query($con,"SELECT * from housepanel");
$getpanel=mysqli_fetch_array($panel);
$start=strtoupper($getpanel['start_panel']);//A
$end=strtoupper($getpanel['end_panel']);//J
for($i=$start;$i<=$end;$i++){
	echo $i.' section <br>';
//create a table with this feild below
// name date,time,section total qty

//$i = 0;
$rand_array = [];
//*** by date & time & section program will select lowest value of input as total qty.
// after getting lowest input from sql database generate random number from only having lowest value.
$sql=mysqli_query($con,"SELECT * from housetotal 
where total_qty=(SELECT min(total_qty)from housetotal where event_date='2021-09-06' and event_time='21:00:00' and section='$i')
 and event_date='2021-09-06' and event_time='21:00:00' and section='$i'");
if(mysqli_num_rows($sql)==0){
	$low=rand(0,99);
	//if ($low<10){$low='0'.$low;}else{$low=$low;}
}else{
	while($res=mysqli_fetch_array($sql)){
		$id=$res['id'];
		$series=$res['series'];
		//$slap=$res['slap'];
		$qty=$res['total_qty'];
		//$min=$res['min(total_qty)']; //lowest value
		echo $id.' id<br>';
		//echo $slap.' slap<br>';
		echo $series.' series<br>';
		echo $qty.' qty<br>';
		
		
			if ($series=='00-09'){
				$low1=rand(0,9);
				array_push($rand_array,$low1);
				}
			if ($series=='10-19'){
				$low2=rand(10,19);
				array_push($rand_array,$low2);
				}
			if ($series=='20-29'){
				$low3=rand(20,29);
				array_push($rand_array,$low3);
				}
			if ($series=='30-39'){
				$low4=rand(30,39);
				array_push($rand_array,$low4);
				}
			if ($series=='40-49'){
				$low5=rand(40,49);
				array_push($rand_array,$low5);
				}
			if ($series=='50-59'){
				$low6=rand(50,59);
				array_push($rand_array,$low6);
				}
			if ($series=='60-69'){
				$low7=rand(60,69);
				array_push($rand_array,$low7);
				}
			if ($series=='70-79'){
				$low8=rand(70,79);
				array_push($rand_array,$low8);
				}
			if ($series=='80-89'){
				$low9=rand(80,89);
				array_push($rand_array,$low9);}
			if ($series=='90-99'){
				$low10=rand(90,99);
				array_push($rand_array,$low10);
				}
			
		}

	$result=getrandom($rand_array);
		//echo 'Final '.$result.'<br>';
		$low=$result.' Final Data<br>';


}
if(isset($low)){
	if ($low<10){$low='0'.$low;}else{$low=$low;}
	echo $low.'<br>';
}
}
function getrandom($arr){
	$rand_key=array_rand($arr);
			return $arr[$rand_key];
	}
	?>