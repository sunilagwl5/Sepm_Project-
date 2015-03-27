<?php
session_start();
if($_SESSION['category']!="faculty")
        header('Location:index.php');
include("../include/grading.php");
$gradereport=new Grading();
$result=$gradereport->getGardes($_SESSION['courses_f']);
$data = array('0','0','0','0','0','0','0','0');
$total=0;
while( $row = mysql_fetch_array($result))
{
	if($row[0] == 'A')
	 $data[0]++;
	 else if($row[0] == 'AB')
	 $data[1]++;
	 else if($row[0] == 'B')
	 $data[2]++;
	 else if($row[0] == 'BC')
	 $data[3]++;
	 else if($row[0] == 'C')
	 $data[4]++;
	 else if($row[0] == 'CD')
	 $data[5]++;
	 else if($row[0] == 'D')
	 $data[6]++;
	 else if($row[0] == 'F')
	 $data[7]++;
	$total++;
}

$i=0;
while ($i<=7)
{
	$data[$i] = round(($data[$i]/ $total)*100,2);
	$i++;	
}
 
include_once( 'ofc-library/open-flash-chart.php' );
$g = new graph();

$g->bg = '#E4F0DB';
//$g->pie(100,'#E4F0DB','{display:none;}',false,1);
$g->pie(100,'#505050','{font-size: 12px; color: #404040;}',false,1);

//
// pass in two arrays, one of data, the other data labels
//
$g->pie_values( $data, array('A','AB','B','BC','C','CD','D','F') );
//
// Colours for each slice, in this case some of the colours
// will be re-used (3 colurs for 5 slices means the last two
// slices will have colours colour[0] and colour[1]):
//
$g->pie_slice_colours( array('#d01f3c','#356aa0','#C79810','#FF1493','#228B22','#4B0082','#00FF00','#FF4500') );
$g->set_tool_tip( 'Label: #x_label#<br>Value: #val#%&' );

$g->title( 'Grading Performance of '.$_SESSION['courses_f'], '{font-size:18px; color: #d01f3c}' );

echo $g->render();

?>
