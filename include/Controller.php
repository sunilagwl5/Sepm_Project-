<?php
/**
 * Created by PhpStorm.
 * User: Anuvakah
 * Date: 4/1/14
 * Time: 1:27 AM
 */

class Controller {

	function Controller()
	{
		 $this->connection=mysql_connect("localhost","root","");
		if (mysqli_connect_errno())
  		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}		
  		mysql_select_db("studentgrading",$this->connection);
	}

	/***  Add New Student Details ****/
	function addStudentDetails($options)
	{
		/*$query="INSERT INTO student (roll_no, password, name, fathers_name, mothers_name, d_o_b, nationality, gender, 
			caste, category, religion, email_id, alt_email_id, contact_no, local_add, fathers_number, landline_no, 
			degree, branch, semester, date_of_joining, batch, hostel, room_no, medical_history, blood_gp, 
			weight, height, bmi_index, current_condition, name_of_sport, level_in_sport, achievement) 
			VALUES ('$options[0]' ,'$options[1]' ,'$options[2]' ,'$options[3]' ,'$options[4]' ,'$options[5]' ,'$options[6]' ,'$options[7]' ,
				'$options[8]' ,'$options[9]' ,'$options[10]' ,'$options[11]' ,'$options[12]' ,'$options[13]' ,'$options[14]' ,'$options[15]' ,
				'$options[16]' ,'$options[17]' ,'$options[18]' ,'$options[19]' ,'$options[20]' ,'$options[21]' ,'$options[22]' ,'$options[23]' ,
				'$options[24]' ,'$options[25]' ,'$options[26]' ,'$options[27]', '$options[28]', '$options[29]', '$options[30]', '$options[31]',
				'$options[32]' )";*/
		$query="INSERT INTO student(username, password, name, fathers_name, mothers_name, d_o_b, nationality, gender, 
			caste, category, religion, email_id, alt_email_id, contact_no, local_add, fathers_number, landline_no, 
			degree, branch, semester, date_of_joining, batch, hostel, room_no, medical_history, blood_gp, 
			weight, height, bmi_index, current_condition, name_of_sport, level_in_sport, achievement) 
			VALUES ('$options[0]' ,'$options[1]' ,'$options[2]' ,'$options[3]' ,'$options[4]' ,'$options[5]' ,'$options[6]' ,'$options[7]' ,
				'$options[8]' ,'$options[9]' ,'$options[10]' ,'$options[11]' ,'$options[12]' ,'$options[13]' ,'$options[14]' ,'$options[15]' ,
				'$options[16]' ,'$options[17]' ,'$options[18]' ,'$options[19]' ,'$options[20]' ,'$options[21]' ,'$options[22]' ,'$options[23]' ,
				'$options[24]' ,'$options[25]' ,'$options[26]' ,'$options[27]', '$options[28]', '$options[29]', '$options[30]', '$options[31]',
				'$options[32]' )";


		//echo $query;
		$result = mysql_query($query,$this->connection);
		
		if(!$result)
			echo "<script>alert('Database Error, Student Already Present')</script>";
		else
			echo "<script>alert('Added Student to database')</script>";

	}


	/***  Add New Faculty Details ****/
	function addFacultyDetails($options)
	{
		/*$query="INSERT INTO faculty(faculty_id, password, name, room_no, phone_no, mobile_no, email_id) 
				VALUES ('$options[0]' ,'$options[1]' ,'$options[2]' ,'$options[3]' ,'$options[4]' ,'$options[5]' ,'$options[6]' )";*/

		$query="INSERT INTO faculty(username, password, name, room_no, phone_no, mobile_no, email_id, updates, timestamp) 
		VALUES ('$options[0]' ,'$options[1]' ,'$options[2]' ,'$options[3]' ,'$options[4]' ,'$options[5]' ,'$options[6]', '$options[7]', $options[8] )";
		//echo $query;

		$result = mysql_query($query,$this->connection);

		if(!$result)
			echo "<script>alert('Databse Error, Faculty already in database')</script>";
		else
			echo "<script>alert('Added Faculty to database')</script>";
		
	}

	function addNewCourse($options)
	{
		$query="INSERT INTO courses(course_id, course_name, credits, wtgquiz1, wtgquiz2, wtgquiz3, wtgquiz4, wtgquiz5, wtgquiz6, 
			wtgquiz7, wtgquiz8, wtgmid_term1, wtgmid_term2, wtgend_term, marksquiz1, marksquiz2, marksquiz3, marksquiz4, marksquiz5, 
			marksquiz6, marksquiz7, marksquiz8, marksmid_term1, marksmid_term2, marksend_term) 
			VALUES ('$options[0]' ,'$options[1]' ,'$options[2]','0','0','0','0','0',
				'0','0','0','0','0','0','0','0','0','0',
				'0','0','0','0','0','0','0')";
		//echo $query;
		
		$result = mysql_query($query,$this->connection);

		if(!$result)
		{
			echo "<script>alert('Duplicate Course Id')</script>";
			return;
		}
		else
			echo "<script>alert('Added Course to database')</script>";
		$this->allotCourse($options);
	}
	
	function updateAcademicDetails($courseid)
	{
		$query = "SELECT * FROM currently_courses WHERE course_id='$courseid'";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result)) 
		{
			$query="SELECT semester from student where username='$row[0]'";
			$semresult = mysql_query($query);
			
			if(!($sem=mysql_fetch_array($semresult)))
			{
				echo("<script>alert('Database error, Check again')</script>");
				return;
			}
			$query="INSERT INTO acadmic_details(username, course_id, year, semester, grade) VALUES ('$row[0]','$courseid','2014',$sem[0],'$row[14]')";
			$semresult = mysql_query($query,$this->connection);

			if(!$semresult)
				echo "<script>alert('Database Error, Check Again')</script>";	
			//echo $query."<br>";
			$this->deleteFromCurrentlyCourses($row[0],$courseid);
		}
		echo("<script>alert('Grade Sheet Updated to Database')</script>");
	}

	function deleteFromCurrentlyCourses($userid, $courseid)
	{
		$query="DELETE FROM currently_courses WHERE currently_courses.username = '$userid' AND currently_courses.course_id = '$courseid'";
		$result = mysql_query($query,$this->connection);
		if(!$result)
		{
			echo "<script>alert('Database Error, Check Again')</script>";
			return;
		}		
	}

	/***  Update Quiz and Exam weightage of Course used by faculty ****/
	function updateQuizWeightage($options)
	{
		$query= "UPDATE courses SET wtgquiz1='$options[3]',wtgquiz2='$options[4]',wtgquiz3='$options[5]',wtgquiz4='$options[6]',
									wtgquiz5='$options[7]', wtgquiz6='$options[8]',wtgquiz7='$options[9]',wtgquiz8='$options[10]',
									wtgmid_term1='$options[11]', wtgmid_term2='$options[12]',wtgend_term='$options[13]',
									marksquiz1='$options[14]',marksquiz2='$options[15]', marksquiz3='$options[16]',marksquiz4='$options[17]',
									marksquiz5='$options[18]',marksquiz6='$options[19]', marksquiz7='$options[20]',marksquiz8='$options[21]',
									marksmid_term1='$options[22]',marksmid_term2='$options[23]', marksend_term='$options[24]' 
									WHERE course_id='$options[0]'";
		$result = mysql_query($query,$this->connection);
		//echo $query;
		if(!$result)
			echo "<script>alert('Database Error, Check Again ')</script>";
		else
			echo "<script>alert('Updated Course Marks Distribution to database')</script>";
	}
	function updateStudentDetails($options)	
	{
		$query="UPDATE student SET password='$options[1]',name='$options[2]',fathers_name='$options[3]',
				mothers_name='$options[4]',d_o_b='$options[5]',nationality='$options[6]',gender='$options[7]',caste='$options[8]',
				category='$options[9]',religion='$options[10]',email_id='$options[11]',alt_email_id='$options[12]',contact_no='$options[13]',
				local_add='$options[14]',fathers_number='$options[15]',landline_no='$options[16]',degree='$options[17]',branch='$options[18]',
				semester='$options[19]',date_of_joining='$options[20]',batch='$options[21]',hostel='$options[22]',room_no='$options[23]',
				medical_history='$options[24]',blood_gp='$options[25]',weight='$options[26]',height='$options[27]',bmi_index='$options[28]',
				current_condition='$options[29]',name_of_sport='$options[30]',level_in_sport='$options[31]',achievement='$options[32]' WHERE username='$options[0]'";
		$result = mysql_query($query,$this->connection);
		//echo $query;
		if(!$result)
			echo "<script>alert('Database Error, Check Again ')</script>";
		else
			echo "<script>alert('Updated Student Profile')</script>";
	}

	
	function updatefacultyDetails($options, $userid)
	{
		$query="UPDATE faculty SET name='$options[2]',room_no='$options[3]',phone_no='$options[5]',mobile_no='$options[4]',
								   email_id='$options[6]' WHERE username='$userid'";
		$result = mysql_query($query,$this->connection);
		//echo $query;
		if(!$result)
		{
			echo "<script>alert('Database Error, Check Again ')</script>";
		}
		else
			echo "<script>alert('Updated Faculty to database')</script>";

	}
	function updateNoticeBoard($userid,$msg)
	{
		$query="UPDATE faculty SET updates='$msg', timestamp=now() WHERE username='$userid'";
		$result = mysql_query($query,$this->connection);
		//echo $query;
		if(!$result)
		{
			echo "<script>alert('Database Error, Check Again ')</script>";		
		}
		else
			echo "<script>alert('Successfully Updated')</script>";
	}
	function updateAdminMessage($userid,$msg)
	{
		$query="UPDATE users SET updates='$msg' WHERE username='$userid'";
		//echo $query;
		
		$result = mysql_query($query,$this->connection);
		//echo $query;
		if(!$result)
		{
			echo "<script>alert('Database Error, Check Again ')</script>";	
		}
		else
			echo "<script>alert('Successfully Updated')</script>";
	}
	
	function changePassword($password, $userid,$type)
	{
		$query="UPDATE $type SET password='$password' where username='$userid'";
		$result = mysql_query($query,$this->connection);
		if(!$result)
			echo "<script>alert('Database Error, Check Again ')</script>";
		else
		{
			$_SESSION['password'] = $password;
			echo "<script>alert('Password Updated successfully')</script>";
		}
			
	}
	function allotCourse($options)
	{
		$query="INSERT INTO isalloted(username, course_id) VALUES ('$options[3]','$options[0]')";
		$result = mysql_query($query,$this->connection);
		if(!$result)
			echo "Databse Error- Course not allocated to faculty";
		else
			echo "<script>alert('Course allocated to Faculty')</script>";
		
	}
	function login(&$userid, &$password, &$type)
	{
		
		$auth=$this->authenticate($userid, $type,$password);
		if($auth==0)
			return "Wrong Username or password";
		
		switch ($type) {
			case 'users':
				header('Location:admin.php');
				break;
			case 'student':
				header('Location:student.php');
				break;
			case 'faculty':
				header('Location:faculty.php');
				break;
			default:
				echo"<script>alert('Error')</script>";
				break;
		}
	}
	function authenticate($userid, $type,$password)
	{
		$query="SELECT * FROM $type WHERE username='$userid'";
		$result = mysql_query($query);
		if(!($row = mysql_fetch_array($result)))
			return 0;
		if(!($userid==$row[0]&&$password==$row[1]))
			return 0;
		return 1;
	}

	function signout()
	{
		session_unset();
		session_destroy();
	}

	
	function correctInput(&$options)
	{
		$options=stripslashes($options);
		$options = mysql_real_escape_string($options);
		return $options;
	}

	function generateQueryCourses($options)
    {
        $query="SELECT * FROM currently_courses where course_id='$options'";
        //echo $query;
        $result = mysql_query($query,$this->connection);
        return $result;
             
    }
    function getCourseName($options)
    {
    	$query="SELECT course_name FROM courses where course_id='$options'";
        //echo $query;
        $result = mysql_query($query,$this->connection);
        $row = mysql_fetch_array($result);
        return $row;
    }
	/******************************************************************************************************************/

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
	function viewAdminMessage()
	{
		$query = "SELECT updates,username FROM users";

		$result = mysql_query($query);
		if(!($row = mysql_fetch_array($result)))
			echo "<script>alert('Database Error')</script>";
		else
			return $row;
	}

	function viewCoursesAllocated_Faculty($facid)
	{
		//returns array
	}

} 