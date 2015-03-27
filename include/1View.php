<?php
Class View
{
	function View()
	{
		 $this->connection=mysql_connect("localhost","root","");
		if (mysqli_connect_errno())
  		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}		
  		mysql_select_db("studentgrading",$this->connection);
	}
	
	function semesterGardesheet($userid,$semester)
	{
		$query = "select * from acadmic_details inner join courses where courses.course_id=acadmic_details.course_id and 
					username='$userid' and semester='$semester'";
		if($semester=="all")
			$query = "select * from acadmic_details inner join courses where courses.course_id=acadmic_details.course_id and 
					username='$userid'";
		
		$result = mysql_query($query,$this->connection);
		return $result;
	}
	function getCourseList($options)//Get course List of faculty
	{
		$query="select * from courses inner join isalloted where courses.course_id=isalloted.course_id and isalloted.username='$options'";
		$result = mysql_query($query,$this->connection);
		
		return $result;
		
	}
	function getCourseListAdmin()//Get course List of faculty
	{
		$query="select distinct isalloted.course_id,course_name from isalloted inner join courses where courses.course_id=isalloted.course_id";
		$result = mysql_query($query,$this->connection);
		
		return $result;
		
	}
	function viewDetails($type, $userid)
	{
		$query = "SELECT * FROM $type WHERE username='$userid'";

		$result = mysql_query($query);
		if(!($row = mysql_fetch_array($result)))
		{
			echo "<script>alert('Databse Error')</script>";
			return 0;
		}
		else
			return $row; 	 
	}

	function viewCourseDetails($courseid)
	{
		$query = "SELECT * FROM courses WHERE course_id='$courseid'";

		$result = mysql_query($query);
		if(!($row = mysql_fetch_array($result)))
			echo "<script>alert('Databse Error')</script>";
		else
			return $row; 	
	}

	function viewMarkSheet($rollid)
	{
		$query="select * from courses inner join currently_courses where courses.course_id=currently_courses.course_id and currently_courses.username='$rollid'";
		//$query = "SELECT * FROM courses WHERE course_id in (select course_id from currently_courses where username='$rollid')";
		$result = mysql_query($query);
		return $result;
		
	}

	function viewNoticeBoard()
	{
		$query = "SELECT updates,name,DATEDIFF(CURDATE(),timestamp) FROM faculty where timestamp between DATE_SUB(CURDATE(), INTERVAL 14 DAY) and CURDATE() order by timestamp desc";

		$result = mysql_query($query);
		return $result;
	}
	function viewCoursesAllocated_Faculty($facid)
	{
		//returns array
	}

}
?>