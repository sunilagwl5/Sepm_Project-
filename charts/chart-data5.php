<?php
session_start();
if($_SESSION['category']!="faculty")
        header('Location:index.php');
include("../include/grading.php");
$gradereport=new Grading();
$values = explode("|", $_SESSION['key']);
unset($_SESSION['key']);
//echo "$values[0]&& $values[1]";

$result=$gradereport->getSemesterMarks($values);
$totmarks=$gradereport->getSubjectMarks($values);

$head=array('Quiz1','Quiz2','Quiz3','Quiz4','Quiz5','Quiz6','Quiz7','Quiz8','Mid 1','Mid2','End Term');
$data=array();
$header=array();

$i=0;
for ($x=0; $x<=10; $x++)
{
	if ($totmarks[$x+14]!=0) {
		$data[$i]=round(($result[$x+2] /$totmarks[$x+14])*100);	
		$i++;
		$header[$i]=$head[$x];
	}
  
}
 
include_once( 'ofc-library/open-flash-chart.php' );
$g = new graph();
$g->title( $values[0], '{font-size: 26px;}' );
$g->line_dot( 2, 5, '#D2691E', 'Marks', 10);
$g->set_data( $data );
// label each point with its value
$g->set_x_labels( $header);
$g->set_y_max( 100 );
// label every 20 (0,20,40,60)
$g->set_y_legend( "Performance Chart", 12, '#736AFF' );
echo $g->render();



/*
 if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $data = array('0','0','0','0','0','0','0','0','0','0','0');
$res = mysqli_query($con,"SELECT * FROM currently_courses where roll_no='y11uc233' and course_id='cse2011'");
  $marks = mysqli_query($con,"SELECT * FROM course_marks where course_id='cse2011'");
	  $rowmarks = mysqli_fetch_array($marks);
$result =mysqli_fetch_array($res);

$i=0;
while($i<=10)
{
	$data[$i]=round(($result[$i+2] /$rowmarks[$i+1])*100);
	$i++;
}
include_once( 'ofc-library/open-flash-chart.php' );
$g = new graph();

// Spoon sales, March 2007
$g->title( 'y11uc233', '{font-size: 26px;}' );
$g->line_dot( 2, 5, '#D2691E', 'Marks', 10);

$g->set_data( $data );
// label each point with its value
$g->set_x_labels( array('Quiz1','Quiz2','Quiz3','Quiz4','Quiz5','Quiz6','Quiz7','Quiz8','Mid 1','Mid2','End Term'));

// set the Y max
$g->set_y_max( 100 );
// label every 20 (0,20,40,60)
$g->set_y_legend( 'Open Flash Chart', 12, '#736AFF' );

$g->y_label_steps( 10 );

// display the data

echo $g->render();*/
?>