
<?php
session_start();

include("include/tablegear.php");
include("include/grading.php");
include("include/controller.php");

$gardesheet=new Grading();
$control=new Controller();

if(!(isset($_SESSION['category'])))
  header('Location:index.php');
if(($_SESSION['category']!="faculty"))
  header('Location:index.php');

$options = array();
$options["database"] = array();
$options["pagination"] = array();

$options["database"]["name"]     = "studentgrading";
$options["database"]["username"] = "root";
$options["database"]["password"] = "";
$options["database"]["table"]    = "currently_courses";

$table = new TableGear($options);

if (isset($_POST['courses'])) 
  $_SESSION['courses_f']=$_POST['courses'];

$field=$_SESSION['courses_f'];
$fetch=$control->generateQueryCourses($field);
if(!($row = mysql_fetch_array($fetch))){
    echo "<script>alert('No students registed')</script>";
    echo  "<script type='text/javascript'>";
    echo "window.close();";
    echo "</script>";
    //header('Refresh: 1;url=faculty.php');;
  //die("<script>alert('No students registerd for this course')</script>");
    die("no student registerd");
}


$table->fetchData("SELECT * FROM currently_courses WHERE course_id='$field'");
//echo $_POST['courses'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Mark Sheet </title>
  <script type="text/javascript" src="js/mootools-yui-compressed.js"></script>
  <script type="text/javascript" src="js/tablegear-mootools.js"></script>
  
  <link type="text/css" rel="stylesheet" href="css/_style.css" />
  </head>
<body>
  <h1>Course Name: <?php $coursename=$control->getCourseName($_SESSION['courses_f']); echo $coursename[0] ?></h1>
  <div>
    <?php $table->getTable() ?>
  </div>
<?php $table->getJavascript('mootools');
?>

<table>
  <tr><td>
<form name="get-total" method="post" >                 
  <input type="submit" name="gettotal-submit" value="Calculate Total Marks"/>
</form>
<?php

  if (!empty($_POST['gettotal-submit']))
  {
    $gardesheet->calculateTotalMarks($_SESSION['courses_f']);
    header('Location: ' . basename($_SERVER['PHP_SELF']));
  }
?></td>
<td>
<form name="get-grades" method="post" >
  <input type="submit" name="getgrades-submit" value="Calculate Grades" _/>
  <select name="grades" value="Grade List" placeholder="Grades">
    <option value='liberal' selected>Liberal Grading</option>
    <option value='medium' >Medium Grading</option>
    <option value='strict' >Strict Grading</option>
  </select>
</form>
<?php
  if (!empty($_POST['getgrades-submit'])){
    $gardesheet->calculateGrades($_SESSION['courses_f'], $_POST['grades']);
    header('Location: ' . basename($_SERVER['PHP_SELF']));

  }
?></td>
<td>
<form name="get-gradeschart" method="post">
  <input type="submit" name="getgrades-chart" value="Grades Chart"/>
</form>
  <?php

  if (!empty($_POST['getgrades-chart']))
  {
    //header('Location: charts/chartpie.php');
    echo"<script>NewWindow=window.open('charts/chartpie.php','newWin','width=560,height=310,left=0,top=0,toolbar=No,location=No,scrollbars=No,status=No,resizable=No,fullscreen=No');
    NewWindow.focus();</script>";
    //header('Location: ' . basename($_SERVER['PHP_SELF']));
  }
?></td>
<td>
  <form action="exportcsv.php" method="post"  target="_blank">
    <input type="hidden" name="course_field" value="<?php echo $field;?>">
    <input type="submit"   name="getexcelsheet" value="Generate Excel Sheet"/>
  </form>
</td>
<td>
  <form name="get-gradessheet" onsubmit="return confirm('This is irreversible. Are you sure?');" method="post" >
    <input type="hidden" name="course_field" value="<?php echo $field;?>">
    <input type="submit" name="finalgradesheet" value="Submit Grade Sheet"/>
  </form>
</td> 
<?php

  if (!empty($_POST['finalgradesheet']))
  {
    //header('Location: charts/chartpie.php');

    $control->updateAcademicDetails($_POST['course_field']);
    echo "alert('Final Garde Sheet Submitted')";
    echo  "<script type='text/javascript'>";
    echo "window.close();";
    echo "</script>";

  }
?>
</tr>
</th>
</body>
</html>
