<!DOCTYPE HTML>
<?php 
//This is Part 1 of our UCAD, Admin Part.
  session_start();

 	include("include/controller.php");
 	$control=new Controller();

 	$errormsg="";
 	if($_SESSION['category']!="users")
        header('Location:index.php');
    //update-student
	if ((!empty($_POST['andstudent-submit']))||(!empty($_POST['update-student']) )) 
	{
		$sdetails=array();
		$sdetails[0]=$_POST['roll_no'];
		$sdetails[1]=$_POST['roll_no'];
		$sdetails[2]=$_POST['sname'];
		$sdetails[3]=$_POST['fathers-name'];
		$sdetails[4]=$_POST['m_name'];
		$sdetails[5]=$_POST['dob'];
		$sdetails[6]=$_POST['nationality'];
		$sdetails[7]=$_POST['gender'];
		$sdetails[8]=$_POST['caste'];
		$sdetails[9]=$_POST['category'];
		$sdetails[10]=$_POST['religion'];
		$sdetails[11]=$_POST['email_id'];
		$sdetails[12]=$_POST['alt_email_id'];
		$sdetails[13]=$_POST['c_no'];
		$sdetails[14]=$_POST['address'];
		$sdetails[15]=$_POST['f_cn'];
		$sdetails[16]=$_POST['landline'];
		$sdetails[17]=$_POST['degree'];
		$sdetails[18]=$_POST['branch'];
		//$sdetails[19]=$_POST['year'];//UG OR PG//Not present in database
		$sdetails[19]=$_POST["semester"];
		$sdetails[20]=$_POST["doj"];
		$sdetails[21]=$_POST['batch'];
		$sdetails[22]=$_POST['hostel'];
		$sdetails[23]=$_POST['r_no'];
		$sdetails[24]=$_POST['medical'];
		$sdetails[25]=$_POST['bloogrp'];
		$sdetails[26]=$_POST['weight'];
		$sdetails[27]=$_POST['height'];
		$sdetails[28]=$_POST['bmi'];
		$sdetails[29]=$_POST['current_health_status'];
		$sdetails[30]=$_POST['sports_playing'];
		$sdetails[31]=$_POST['level'];
		$sdetails[32]=$_POST['achieve'];

		if(!empty($_POST['andstudent-submit']))
		{
			$sdetails[14]=$_POST['address'].", ".$_POST['city']." - ".$_POST['pin'].", ".$_POST['state'];
			$control->addStudentDetails($sdetails);
		}
		if(!empty($_POST['update-student']))
		{
			$sdetails[1]=$_POST['password'];
			$control->updateStudentDetails($sdetails);
			//echo "sombneting";
		}
		//echo $sdetails[0];

		//header('Refresh: 1;Location: ' . basename($_SERVER['PHP_SELF']));
		 echo '
				<script type="text/javascript">
				location.reload();
				</script>';
	}
	if ((!empty($_POST['faculty-submit'])) ||(!empty($_POST['update-facultydetails'])))
	{
		
		$fdetails=array();
		$fdetails[0]=$_POST['faculty-id'];
		$fdetails[1]=$_POST['faculty-id'];
		$fdetails[2]=$_POST['faculty_name'];
		$fdetails[3]=$_POST['room-no'];
		$fdetails[4]=$_POST['mobile-no'];
		$fdetails[5]=$_POST['office-no'];
		$fdetails[6]=$_POST['email_idf'];
		$fdetails[7]="";
		$fdetails[8]="now()";

		if(!empty($_POST['faculty-submit']))
			$control->addFacultyDetails($fdetails);
		if(!empty($_POST['update-facultydetails']))
		{
			$control->updatefacultyDetails($fdetails,$fdetails[0]);
		}
		//header('Refresh: 1;Location: ' . basename($_SERVER['PHP_SELF']));
		 echo '
				<script type="text/javascript">
				location.reload();
				</script>';
	}
	if (!empty($_POST['Change-submit'])) 
	{
		
		$cdetails=array();
		$cdetails[0]=$_POST['currentpassword'];
		$cdetails[1]=$_POST['changepassword'];
		$cdetails[2]=$_POST['confirmpassword'];
		$var=$control->authenticate($_SESSION['login'],$_SESSION['category'],$cdetails[0]);
		if($var == 0)
			echo"<script>alert('Worng Current Password ')</script>";
		
		else if($cdetails[1] == $cdetails[2])
			$control->changePassword($cdetails[1],$_SESSION['login'],$_SESSION['category']);
		
		else
			echo"<script>alert('Change password and Confirm password do not match ')</script>";
		
        //header('Refresh: 1;Location: ' . basename($_SERVER['PHP_SELF']));
        echo '
				<script type="text/javascript">
				location.reload();
				</script>';

	}
	if (!empty($_POST['submit-course'])) 
	{
		$crdetails=array();
		$crdetails[0]=$_POST['Course_id'];
		$crdetails[1]=$_POST['Course_Name'];
		$crdetails[2]=$_POST['credits'];
		$crdetails[3]=$_POST['allocate'];
		$control->addNewCourse($crdetails);
		//header('Refresh: 1;Location: ' . basename($_SERVER['PHP_SELF']));
		 echo '
				<script type="text/javascript">
				location.reload();
				</script>';
	}
	
  ?>
 
<html>

	<head>
		<link rel="stylesheet" type="text/css" media="all" href="css/_style.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Admin- Student Grading Portal</title>	
	</head>
	
	<body>
	
            
            
    
  </table>
		<div id="content">
			<h1>Hello Mr. Rajeev Saxena
				<div style = "text-align:Right; float:right;">
				<form name="signout" method="post">

				<input type="submit" name="signout-submit" value="Signout"/>
				<?php
					if (!empty($_POST['signout-submit']))
					{
						$control->signout();
						header("Location: index.php");
					}
				?>
			</form>
			</h1>
			<div id="mainmenu">
				<ul id="tabs">
				<!-- This is Part 1.2 of our UCAD i.e Add New Student -->
					<li>
						<a href="#AddNewStudent" id="AddNewStudent-tab">Add New Student</a>
					</li>
				<!-- This is Part 1.3 of our UCAD i.e Add New Faculty -->
					<li>
						<a href="#AddNewFaculty" id="AddNewFaculty-tab">Add New Faculty</a>
					</li>
				<!-- This is Part 1.4 of our UCAD i.e Add New Courses -->
					<li>
						<a href="#AddNewCourses" id="AddNewCourses-tab">Add New Courses</a>
					</li>
				<!-- This is Part 1.5 of our UCAD i.e Edit Student -->
					<li>
						<a href="#EditStudent" id="EditStudent-tab">Edit Student</a>
					</li>
				<!-- This is Part 1.6 of our UCAD i.e Edit Faculty -->
					<li>
						<a href="#EditFaculty" id="EditFaculty-tab">Edit Faculty</a>
					</li>

				<!-- This is Part 1.7 of our UCAD i.e Grading and Marking -->
					<li>
						<a href="#GradingAndMarks" id="GradingAndMarks-tab">Grading And Marks</a>
					</li>
					<li>
                        <a href="#Addupdates" id="Addupdates-tab">Update It</a>
                    </li>
				<!-- This is Part 1.1 of our UCAD i.e Change Password -->
					<li>
						<a href="#Changepassword" id="Changepassword-tab">Change Password</a>
					</li>
				</ul>
			</div>&nbsp;
			<!-- This Code defines Add New StudentS tabs contents -->
			<div class="panel" id="AddNewStudent">
				<div id="wrapper">
				<form name="addstudent" method="post">
				
					<table>
					<tr>
						<td>
							Name: 
						</td>
						<td>
							<input type="text" name="sname" placeholder="Name" required/>
						</td>
					</tr>
					<tr>
						<td>
							Roll Number: 
						</td>
						<td>
							<input type="text" name="roll_no" placeholder="Roll Number" required/>
						</td>
					</tr>
					<tr>
						<td>
							Email-id:  
						</td>
						<td>
							<input type="text" name="email_id" placeholder="Email" required/>
						</td>
						</tr>
					<tr>
						<td>
							Alternate E-mail-id:   
						</td>
                    <td>
						<input type="text" name="alt_email_id" placeholder="Alternate Email"/>
					</td>
					</tr>
					<tr>
						<td>
							Father's Name:   
						</td>
						<td>
							<input type="text" name="fathers-name" placeholder="Father's Name" required/>
						</td>
					</tr>
					<tr>
						<td>
							Mother's Name:   
						</td>
						<td>
							<input type="text" name="m_name" placeholder="Mother's Name" required/>
						</td>
					</tr>
					<tr>
						<td>
							Date of Birth:    
						</td>
						<td>
							<input type="date" name="dob" required />
						</td>
					</tr>
					<tr>
						<td>
							Gender:    
						</td>
						<td>
							<select name="gender" value="" placeholder="Gender" required />
								<option value="male" >Male</option>
								<option value="female">Female</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Nationality:    
						</td>
						<td>
							<select name="nationality" required />
								<option value="Indian" >Indian</option>
								<option value="Foreign">Foreign</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Caste:     
						</td>
						<td>
							<input type="text" name="caste" placeholder="Caste"/>
						</td>
					</tr>
					<tr>
						<td>
							Religion:     
						</td>
						<td>
							<input type="text" name="religion" placeholder="Religion" required/>
						</td>
					</tr>
					<tr>
						<td>
							Category:     
						</td>
						<td>
							<input type="text" name="category" placeholder="Category" required/>
						</td>
					</tr>
					<tr>
						<td>
							Contact Number:     
						</td>
						<td>
							<input type="number" name="c_no" placeholder="Contact Number" required/>
						</td>
					</tr>
					<tr>
						<td>
							Full Postal Address:     
						</td>
						<td>
							<textarea name="address" placeholder="This should contains Student's full postal address" required></textarea>
						</td>
					</tr>
					<tr>
						<td>
							City:     
						</td>
						<td>
							<input type="text" name="city" placeholder="City" required/>
						</td>
					</tr>
					<tr>
						<td>
							State:     
						</td>
						<td>
							<select name="state">
								<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
								<option value="Andhra Pradesh">Andhra Pradesh</option>
								<option value="Arunachal Pradesh">Arunachal Pradesh</option>
								<option value="Assam">Assam</option>
								<option value="Bihar">Bihar</option>
								<option value="Chandigarh">Chandigarh</option>
								<option value="Chhattisgarh">Chhattisgarh</option>
								<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
								<option value="Daman and Diu">Daman and Diu</option>
								<option value="Delhi">Delhi</option>
								<option value="Goa">Goa</option>
								<option value="Gujarat">Gujarat</option>
								<option value="Haryana">Haryana</option>
								<option value="Himachal Pradesh">Himachal Pradesh</option>
								<option value="Jammu and Kashmir">Jammu and Kashmir</option>
								<option value="Jharkhand">Jharkhand</option>
								<option value="Karnataka">Karnataka</option>
								<option value="Kerala">Kerala</option>
								<option value="Lakshadweep">Lakshadweep</option>
								<option value="Madhya Pradesh">Madhya Pradesh</option>
								<option value="Maharashtra">Maharashtra</option>
								<option value="Manipur">Manipur</option>
								<option value="Meghalaya">Meghalaya</option>
								<option value="Mizoram">Mizoram</option>
								<option value="Nagaland">Nagaland</option>
								<option value="Orissa">Orissa</option>
								<option value="Pondicherry">Pondicherry</option>
								<option value="Punjab">Punjab</option>
								<option value="Rajasthan" selected>Rajasthan</option>
								<option value="Sikkim">Sikkim</option>
								<option value="Tamil Nadu">Tamil Nadu</option>
								<option value="Tripura">Tripura</option>
								<option value="Uttaranchal">Uttaranchal</option>
								<option value="Uttar Pradesh">Uttar Pradesh</option>
								<option value="West Bengal">West Bengal</option>
							</select>

						</td>
					</tr>
					<tr>
						<td>
							Pin Code:     
						</td>
						<td>
							<input type="number" name="pin" placeholder="PIN Code" required/>
						</td>
					</tr>
					
					<tr>
						<td>
							Father's contact number:     
						</td>
						<td>
							<input type="text" name="f_cn" placeholder="Father's Contact Number" required/>
						</td>
					</tr>
					<tr>
						<td>
							Landline number:     
						</td>
						<td>
							<input type="number" name="landline" placeholder="Landline Number"/>
						</td>
					</tr>
					<tr>
						<td>
							Degree:     
						</td>
						<td>
							<select name="degree" value="" placeholder="Degree" required />
								<option value="B.Tech" >Bachelor Of Technology</option>
								<option value="M.Tech" >Master Of Technology</option>
								<option value="M.Sc" >Master Of Science</option>
								<option value="PG" >Post Graduate</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Branch:     
						</td>
						<td>
							<select name="branch" value="" placeholder="Branch" required />
								<option value="CSE" >Computer Science and Engineering</option>
								<option value="ECE" >Electronics and Communication Engineering</option>
								<option value="Mechatronics" >Mechatronics</option>
								<option value="PG" >Post Graduate</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Semester:     
						</td>
						<td>
							<select name="semester" value="semester" placeholder="Semester" required>
								<option value="1"  >PG Programme</option>
								<option value="1"  >1st Semester</option>
								<option value="2">2nd Semester</option>
								<option value="12">1st Summer</option>
								<option value="3">3rd Semester</option>
								<option value="4">4th Semester</option>
								<option value="22">2nd Summer</option>
								<option value="5">5th Semester</option>
								<option value="6">6th Semester</option>
								<option value="32">3rd Summer</option>
								<option value="7">7th Semester</option>
								<option value="8">8th Semester</option>
								<option value="42">4th Summer</option>
								<option value="9">9th Semester</option>
								<option value="10">10th Semester</option>
								<option value="52">4th Summer</option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							Date of Joining:     
						</td>
						<td>
							<input type="date" name="doj" placeholder="DOJ"/>
						</td>
					</tr>
					<tr>
						<td>
							Batch:     
						</td>
						<td>
							<input type="text" name="batch" placeholder="Batch"/>
						</td>
					</tr>
					<tr>
						<td>
							Hostel:     
						</td>
						<td>
							<input type="text" name="hostel" placeholder="Hostel"/>
						</td>
					</tr>
					<tr>
						<td>
							Room Number:     
						</td>
						<td>
							<input type="text" name="r_no" placeholder="Room Number"/>
						</td>
					</tr>
					<tr>
						<td>
							Weight:     
						</td>
						<td>
							<input type="text" name="weight" placeholder="Weight"/>
						</td>
					</tr>
					<tr>
						<td>
							Height:     
						</td>
						<td>
							<input type="text" name="height" placeholder="Height"/>
						</td>
					</tr>
					<tr>
						<td>
							Blood Group:     
						</td>
						<td>
							<select name="bloogrp" value="bloodgrp" placeholder="Blood Group">
								<option value="A+" selected>A+</option>
								<option value="A-">A-</option>
								<option value="B+">B+</option>
								<option value="B-">B-</option>
								<option value="O+">O+</option>
								<option value="O-">O-</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							BMI:     
						</td>
						<td>
							<input type="text" name="bmi" placeholder="BMI"/>
						</td>
					</tr>
					<tr>
						<td>
							Current Health Status:     
						</td>
						<td>
							<input type="text" name="current_health_status" placeholder="Current Health Status"/>
						</td>
					</tr>
					<tr>
						<td>
							Medical History:     
						</td>
						<td>
							<textarea name="medical" placeholder="This should contains Students Medical History"></textarea>
						</td>
					</tr>
					
					<tr>
						<td>
							Sports Playing:     
						</td>
						<td>
							<input type="text" name="sports_playing" placeholder="Sports Playing"/>
						</td>
					</tr>
					<tr>
						<td>
							Competence Level:     
						</td>
						<td>
							<select name="level" value="level" placeholder="Students Level">
								<option value="1">1st Level</option>
								<option value="2">2nd Level</option>
								<option value="3">3rd Level</option>
								<option value="4">4th Level</option>
								<option value="5">5th Level</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Student's Achievment:     
						</td>
						<td>
							<div><textarea name="achieve" placeholder="This should contains Students Achievement"></textarea></div>
						</td>
					</tr>
				</table>
                <input type="submit" name="andstudent-submit" value="Submit"/>
				</div>
			</form>
			</div>&nbsp;
			<div class="panel" id="AddNewFaculty">
				<div id="wrapper">
				<form name="addfaculty"  method="post">
					
					<table>
						<tr>
							<td>
								Faculty Name:     
							</td>
							<td>
								<input type="text" name="faculty_name" placeholder="Faculty Name" required/>
							</td>
						</tr>
						
						<tr>
							<td>
								Faculty Id:     
							</td>
							<td>
								<input type="text" name="faculty-id" placeholder="Faculty id" required/>
							</td>
						</tr>
						<tr>
							<td>
								E-mail Id:     
							</td>
							<td>
								<input type="email" name="email_idf" placeholder="Email" required/>
							</td>
						</tr>
						<tr>
							<td>
								Contact Number:     
							</td>
							<td>
								<input type="number" name="mobile-no" placeholder="Contact no." required/>
							</td>
						</tr>
						<tr>
							<td>
								Office Contact Number:     
							</td>
							<td>
								<input type="number" name="office-no" placeholder="Office Contact No."/>
							</td>
						</tr>
						<tr>
							<td>
								Room Number:     
							</td>
							<td>
								<input type="text" name="room-no" placeholder="Room No."/>
							</td>
						</tr>
					</table>
                    <input type="submit" name="faculty-submit" value="Submit"/>
					</form>
				</div>
			</div>&nbsp;
			<!-- This Code defines Add New Course tabs contents -->
			<div class="panel" id="AddNewCourses">
				<div id="wrapper">

				<form name="addcourse" method="post">
					 <table>
						<tr>
							<td>
								Course Name:     
							</td>
							<td>
								<input type="text" name="Course_Name" placeholder="Course Name" required/>
							</td>
						</tr>
						<tr>
							<td>
								Course Id:     
							</td>
							<td>
								<input type="text" name="Course_id" placeholder="Course id" required/>
							</td>
						</tr>
						<tr>
							<td>
								Number of Credits:     
							</td>
							<td>
								<input type="number" name="credits" placeholder="No.of credits" required/>
							</td>
						</tr>
						<tr>
							<td>
								Assigned to Faculty:     
							</td>
							<td>
								<input type="text" name="allocate" placeholder="Enter Faculty ID" required/>
							</td>
						</tr>
						
						<tr>
							<td>
								Type of Courses:     
							</td>
							<td>
								<select name="courses" value="" placeholder="Type Of Course">
									<option value="Core course">Core Course</option>
									<option value="hss elective">Hss Elective</option>
									<option value="Core course">Open Elective</option>
									<option value="program elective">Program Elective</option>
									<option value="science elective">Science Elective</option>
								</select>
							</td>
						</tr>
					</table>   
                    <input type="submit" name="submit-course" value="Submit"/>
					</form>
				</div>
			</div>&nbsp;
			<!-- This Code defines Edit Student tabs contents -->
			<div class="panel" id="EditStudent">
				<div id="wrapper">
				<form method="post" id="EditSubmitStudent">
					<table style="width: 300px;">
						<tr>
							<td>Enter Roll No:</td>
							<td><input type="text" name="rollno" placeholder="Enter Student ID" /></td>
                 			
                 		</tr>
                 		<tr>
                 			<td></td>
                 			<td><input type="submit" name="submit-rollno" value="Submit"/></td>
                 		</tr>
                 	</table>
             	</form>
             	<?php
             		if ((!empty($_POST['submit-rollno'])) &&(!empty($_POST['rollno'])))
             		{
             			
           			    $row=$control->viewDetails("student", $_POST['rollno']);
           			    if($row!=0)
           			    echo '
           				<br>
           				<div>
                        	<h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspStudent Id:&nbsp&nbsp&nbsp&nbsp'.$row[0].'</h2>
                    	</div>
				<form method="post" id="EditStudent">
					
					<div>
                        <input type="hidden" name="roll_no" value="'.$row[0].'">
                    </div>
					<table>
					<tr>
						<td>
							Name: 
						</td>
						<td>
							<input type="text" name="sname"  value="'.$row[2].'" required/>
						</td>
					</tr>
					<tr>
						<td>
							Password: 
						</td>
						<td>
							<input type="text" name="password" placeholder="Password" value="'.$row[1].'" required/>
						</td>
					</tr>
					<tr>
						<td>
							Email-id:  
						</td>
						<td>
							<input type="email" name="email_id" placeholder="Email" value="'.$row[11].'" required/>
						</td>
						</tr>
					<tr>
						<td>
							Alternate E-mail-id:   
						</td>
                    <td>
						<input type="email" name="alt_email_id" placeholder="Alternate Email"  value="'.$row[12].'" />
					</td>
					</tr>
					<tr>
						<td>
							Father Name:   
						</td>
						<td>
							<input type="text" name="fathers-name" placeholder="Father Name" value="'.$row[3].'"  required/>
						</td>
					</tr>
					<tr>
						<td>
							Mother Name:   
						</td>
						<td>
							<input type="text" name="m_name" placeholder="Mother Name" value="'.$row[4].'"  required/>
						</td>
					</tr>
					<tr>
						<td>
							Date of Birth:    
						</td>
						<td>
							<input type="date" name="dob" required  value="'.$row[5].'"  />
						</td>
					</tr>
					<tr>
						<td>
							Gender:    
						</td>
						<td>
							<select name="gender" value="" placeholder="Gender"  required />
								<option value="male" >Male</option>
								<option value="female">Female</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Nationality:    
						</td>
						<td>
							<input type="text" name="nationality" placeholder="Nationality" value="'.$row[6].'"  required/>
						</td>
					</tr>
					<tr>
						<td>
							Caste:     
						</td>
						<td>
							<input type="text" name="caste" placeholder="Caste" value="'.$row[8].'" />
						</td>
					</tr>
					<tr>
						<td>
							Religion:     
						</td>
						<td>
							<input type="text" name="religion" placeholder="Religion" value="'.$row[10].'"  required/>
						</td>
					</tr>
					<tr>
						<td>
							Category:     
						</td>
						<td>
							<input type="text" name="category" placeholder="Category" value="'.$row[9].'" />
						</td>
					</tr>
					<tr>
						<td>
							Contact Number:     
						</td>
						<td>
							<input type="number" name="c_no" placeholder="Contact Number" value="'.$row[13].'"  required/>
						</td>
					</tr>
					<tr>
						<td>
							Full Postal Address:     
						</td>
						<td>
							<textarea name="address" placeholder="This should contains Student full postal address" value="'.$row[14].'" ></textarea>
						</td>
					</tr>
					
					<tr>
						<td>
							Father Email:     
						</td>
						<td>
							<input type="email" name="f_email" placeholder="Father Email" value="'.$row[11].'"/>
						</td>
					</tr>
					<tr>
						<td>
							Father contact number:     
						</td>
						<td>
							<input type="number" name="f_cn" placeholder="Father Contact Number" value="'.$row[15].'" required/>
						</td>
					</tr>
					<tr>
						<td>
							Landline number:     
						</td>
						<td>
							<input type="number" name="landline" placeholder="Landline Number" value="'.$row[16].'" />
						</td>
					</tr>
					<tr>
						<td>
							Degree:     
						</td>
						<td>
							<select name="degree" value="" placeholder="Degree" required />
								<option value="B.Tech" >Bachelor Of Technology</option>
								<option value="M.Tech" >Master Of Technology</option>
								<option value="M.Sc" >Master Of Science</option>
								<option value="PG" >Post Graduate</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Branch:     
						</td>
						<td>
							<select name="branch" value="" placeholder="Branch" required />
								<option value="CSE" >Computer Science and Engineering</option>
								<option value="ECE" >Electronics and Communication Engineering</option>
								<option value="Mechatronics" >Mechatronics</option>
								<option value="PG" >Post Graduate</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Semester:     
						</td>
						<td>
							<select name="semester" value="semester" placeholder="Semester" required>
								<option value="1" selected >PG Programme</option>
								<option value="1" selected >1st Semester</option>
								<option value="2">2nd Semester</option>
								<option value="12">1st Summer</option>
								<option value="3">3rd Semester</option>
								<option value="4">4th Semester</option>
								<option value="22">2nd Summer</option>
								<option value="5">5th Semester</option>
								<option value="6">6th Semester</option>
								<option value="32">3rd Summer</option>
								<option value="7">7th Semester</option>
								<option value="8">8th Semester</option>
								<option value="42">4th Summer</option>
								<option value="9">9th Semester</option>
								<option value="10">10th Semester</option>
								<option value="52">4th Summer</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Date of Joining:     
						</td>
						<td>
							<input type="date" name="doj" placeholder="DOJ" value="'.$row[20].'" />
						</td>
					</tr>
					<tr>
						<td>
							Batch:     
						</td>
						<td>
							<input type="text" name="batch" placeholder="Batch" value="'.$row[21].'" />
						</td>
					</tr>
					<tr>
						<td>
							Hostel:     
						</td>
						<td>
							<input type="text" name="hostel" placeholder="Hostel" value="'.$row[22].'" />
						</td>
					</tr>
						<td>
							Room Number:     
						</td>
						<td>
							<input type="text" name="r_no" placeholder="Room Number" value="'.$row[23].'" />
						</td>
					</tr>
					<tr>
						<td>
							Weight:     
						</td>
						<td>
							<input type="text" name="weight" placeholder="Weight" value="'.$row[26].'" />
						</td>
					</tr>
					<tr>
						<td>
							Height:     
						</td>
						<td>
							<input type="text" name="height" placeholder="Height" value="'.$row[27].'" />
						</td>
					</tr>
					<tr>
						<td>
							Blood Group:     
						</td>
						<td>
							<select name="bloogrp" value="bloodgrp" placeholder="Blood Group">
								<option value="A+" selected>A+</option>
								<option value="A-">A-</option>
								<option value="B+">B+</option>
								<option value="B-">B-</option>
								<option value="O+">O+</option>
								<option value="O-">O-</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							BMI:     
						</td>
						<td>
							<input type="text" name="bmi" placeholder="BMI" value="'.$row[28].'" />
						</td>
					</tr>
					<tr>
						<td>
							Current Health Status:     
						</td>
						<td>
							<input type="text" name="current_health_status" placeholder="Current Health Status" value="'.$row[29].'" />
						</td>
					</tr>
					<tr>
						<td>
							Medical History:     
						</td>
						<td>
							<textarea name="medical" placeholder="This should contains Students Medical History" value="'.$row[24].'" ></textarea>
						</td>
					</tr>
					</tr>
					<tr>
						<td>
							Sports Playing:     
						</td>
						<td>
							<input type="text" name="sports_playing" placeholder="Sports Playing" value="'.$row[30].'" />
						</td>
					</tr>
					<tr>
						<td>
							Competence Level:     
						</td>
						<td>
							<select name="level" value="level" placeholder="Students Level">
								<option value="1">1st Level</option>
								<option value="2">2nd Level</option>
								<option value="3">3rd Level</option>
								<option value="4">4th Level</option>
								<option value="5">5th Level</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Student Achievment:     
						</td>
						<td>
							<div><textarea name="achieve" placeholder="This should contains Students Achievement" value="'.$row[32].'" ></textarea></div>
						</td>
					</tr>
				</table>
                <input type="submit" name="update-student" value="Update"/>
				
				
				</form>';
				}
				?>
				</div>
			</div>&nbsp;
			<!-- This Code defines Edit Faculty tabs contents -->
			<div class="panel" id="EditFaculty">
				<div id="wrapper">
				<form name="editsubmitfaculty" method="post">
					<table>
						<tr>
							<td>Faculty User Id:</td>
							<td><input type="text" name="userid" placeholder="Enter Faculty User ID: " />
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="update-faculty" value="Submit"/></td>
					</table>
	            </form>
	            <?php
	            	if (!empty($_POST['update-faculty']))
	            	{
	            		$row=$control->viewDetails("faculty", $_POST['userid']);
           			    if($row!=0)
           			    echo '
           					<br>
           					<div>
                        		<h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFaculty Id:&nbsp&nbsp&nbsp&nbsp'.$row[0].'</h2>
                    		</div>
				<form name="editfaculty" method="post">
					<input type="hidden" name="faculty-id" placeholder="Faculty id" value="'.$row[0].'"required/>
					<table>
						<tr>
							<td>
								Faculty Name:     
							</td>
							<td>
								<input type="text" name="faculty_name" placeholder="Faculty Name" value="'.$row[2].'"required/>
							</td>
						</tr>
						
						<tr>
							<td>
								Password:     
							</td>
							<td>
								<input type="text" name="facultypasswd" readonly placeholder="Password" value="'.$row[1].'"required/>
							</td>
						</tr>
						<tr>
							<td>
								E-mail Id:     
							</td>
							<td>
								<input type="email" name="email_idf" placeholder="Email" value="'.$row[6].'"required/>
							</td>
						</tr>
						<tr>
							<td>
								Contact Number:     
							</td>
							<td>
								<input type="number" name="mobile-no" placeholder="Contact no." value="'.$row[5].'"required/>
							</td>
						</tr>
						<tr>
							<td>
								Office Contact Number:     
							</td>
							<td>
								<input type="number" name="office-no" placeholder="Office Contact No." value="'.$row[4].'"/>
							</td>
						</tr>
						<tr>
							<td>
								Room Number:     
							</td>
							<td>
								<input type="text" name="room-no" placeholder="Room No." value="'.$row[3].'"/>
							</td>
						</tr>
					</table>
				   
                    <input type="submit" name="update-facultydetails" value="Update"/>
					
				</form>';
	            	}
	            ?>
				</div>
			</div>&nbsp;
			<!-- This Code defines Grading and Marks tabs contents -->
			<div class="panel" id="GradingAndMarks">
				<div id="wrapper">
				<form method="post">
					<table>
						<tr>
							<td>
								Course Id:     
							</td>
							<td>
								<select name="courses" value="" placeholder="Courses" required />
								<?php 
									$getcourse=$control->getCourseListAdmin($_SESSION['login']);
                            		while ($row = mysql_fetch_array($getcourse))
                                		echo "<option value='$row[0]' >$row[1]</option>";
								?>
							</select>
							</td>
						</tr>
					</table>
				   
                    <input type="submit" name="course-submit" value="Submit"/>
				</form>
				</div>
				<div id="wrapper" style="width:1100px;">
				<form a method="post">

				<?php
					if(!empty($_POST['course-submit']))
					{
				 		$marksheet=$control->generateQueryCourses($_POST['courses']);
				 		$coursename=$control->getCourseName($_POST['courses']);
				 		echo "<h2> Subject :".$coursename[0]." </h2>";
						echo '
				 			<table style="border:1px solid black;border-collapse:collapse;">
				 				<tr>
									
									<th>User Id</th>
									<th>Quiz 1</td>
									<th>Quiz 2</th>
									<th>Quiz 3</td>
									<th>Quiz 4</th>
									<th>Quiz 5</td>
									<th>Quiz 6</th>
									<th>Quiz 7</th>
									<th>Quiz 8</th>
									<th>Mid-Term 1</th>
									<th>Mid-Term 2</th>
									<th>End Term</th>
									<th>Total Marks</th>
				 					<th>Grades</th>
				 				</tr>';
				 		
				 		
				 		while($row = mysql_fetch_array($marksheet))
				 		{
				 			echo "<tr>";
							echo "<td>".$row[0]."</td>";
							echo "<td>".$row[2]."</td>";
							echo "<td>".$row[3]."</td>";
							echo "<td>".$row[4]."</td>";
							echo "<td>".$row[5]."</td>";
							echo "<td>".$row[6]."</td>";
							echo "<td>".$row[7]."</td>";
							echo "<td>".$row[8]."</td>";
							echo "<td>".$row[9]."</td>";
							echo "<td>".$row[10]."</td>";
							echo "<td>".$row[11]."</td>";
							echo "<td>".$row[12]."</td>";
							echo "<td>".$row[13]."</td>";
							echo "<td>".$row[14]."</td>";
							echo "</tr>";
				 		}
				 		echo("</table>");
				 		
					}
				?>
				</form>
				</div>
			</div>&nbsp;
			<!-- This Code defines change password tabs contents -->
			<div class="panel" id="Changepassword">
				<div id="wrapper">
				<form action="" method="post">
					<table>
						<tr>
							<td>Current Password:</td>
							<td><div><input type="password" name="currentpassword" placeholder="Current Password"/></div></td>
				   		</tr>
				   		<tr>
				   			<td>New Password:</td>
				   			<td><div><input type="password" name="changepassword" placeholder="New Password"/></div></td>
				   		</tr>
				   		<tr>
				   			<td>Confirm Password:</td>
				   			<td><div><input type="password" name="confirmpassword" placeholder="Confirm Password"/></div></td>
				   		</tr>
				   	</table>
                    	<input type="submit" name="Change-submit" value="Change Password"/>
				</form>
				</div>
			</div>&nbsp;
			<div class="panel" id="Addupdates">
                <div id="wrapper">
                <form action="" method="post">
                    <table>
                        <tr>
                            <td>Update Message:</td>
                            <td><textarea name="messg" placeholder="This should contains Update Message" required></textarea></td>
                        </tr>
                    </table>
                    <input type="submit" name="updatenotice" value="Update Message"/>
                </form>
                <?php
                    if(!empty($_POST['updatenotice']))
                    {
						$control->updateAdminMessage($_SESSION['login'],$_POST['messg']);
						echo '
							<script type="text/javascript">
							location.reload();
							</script>';
					}
                ?>
            	</div>
            </div>&nbsp;
		</div>
		
		
		<script type="text/javascript" src="js/prototype.js"></script>
		<script type="text/javascript" src="js/fabtabulous.js"></script>
		<script type="text/javascript">
			var _tabs = new Fabtabs('tabs');
			$$('a.next-tab').each(function(a) {
				Event.observe(a, 'click', function(e){
					Event.stop(e);
					var t = $(this.href.match(/#(\w.+)/)[1]+'-tab');
					_tabs.show(t);
					_tabs.menu.without(t).each(_tabs.hide.bind(_tabs));
				}.bindAsEventListener(a));
			});
		</script>
	</body>
</html>
