<?php
	include("include/grading.php");
	$gardesheet=new Grading();


if (!empty($_POST['getexcelsheet']))
  {
  	$output="";
  	$field=$_POST['course_field'];
    $xsheet=$gardesheet->generateQuery($field);
    $columns_total  = mysql_num_fields($xsheet);

    for ($i = 0; $i < $columns_total; $i++) {
      $heading  = mysql_field_name($xsheet, $i);
      $output   .= '"'.$heading.'",';
    }
    $output .="\n";

    while ($row = mysql_fetch_array($xsheet)) 
    {
      for ($i = 0; $i < $columns_total; $i++) 
        $output .='"'.$row["$i"].'",';
      $output .="\n";
    }
    $filename =  "Mark_Sheet_of_".$field.".csv";
  	header('Content-type: text/csv');
    header('Content-Disposition: attachment; filename='.$filename);
    
  

    echo $output;
    exit(0);
    //$fp = fopen('file.csv', 'w');
    //fputcsv($fp, $output);
  }
?>
