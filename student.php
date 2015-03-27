<!DOCTYPE HTML>
<?php 
session_start();
// This section corrosponds to part 2 of our ucad i.e Student.
    include("include/controller.php");
    //include("include/view.php");
    include("include/grading.php");
    $grading=new Grading();
    $control=new Controller();
    //$view=new View();
    if($_SESSION['category']!="student")
        header('Location:index.php');

	$row=$control->viewDetails($_SESSION['category'], $_SESSION['login']);

	$result=$control->viewMarkSheet($_SESSION['login']);

	if (!empty($_POST['Change-submit'])) 
	{
		
		$cdetails=array();
		$cdetails[0]=$_POST['currentpassword'];
		$cdetails[1]=$_POST['changepassword'];
		$cdetails[2]=$_POST['confirmpassword'];
		$var=$control->authenticate($_SESSION['login'],$_SESSION['category'],$cdetails[0]);
		if($var == 0)
			echo"<script>alert('Enter right current password ')</script>";
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
	$cpisheet=$control->semesterGardesheet($_SESSION['login'],"all");
	$cpi=$grading->calculateCpi($cpisheet);
?>
 <html>


	<head>
		<link rel="stylesheet" type="text/css" media="all" href="css/_style.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Student</title>	
	</head>
	<body>
		<div id="content">
			<h1>Hello, <?php echo $row[2]?>
			<div style = "text-align:Right; float:right;">
				<?php echo "CPI is: ".$cpi;
				?>
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
				<!-- This is Part 2.2 of our UCAD i.e Personal Information -->
					<li>
						<a href="#PersonalInformation" id="PersonalInformation-tab">Personal Information</a>
					</li>
				<!-- This is Part 2.3 of our UCAD i.e Current Courses -->
					<li>
						<a href="#CurrentCourses" id="CurrentCourses-tab">Current Courses</a>
					</li>
				<!-- This is Part 2.4 of our UCAD i.e Previous results -->
					<li>
						<a href="#PreviousResults" id="PreviousResults-tab">Previous Results</a>
					</li>
				<!-- This is Part 2.1 of our UCAD i.e Change Password -->
					<li>
						<a href="#Changepassword" id="Changepassword-tab">Change Password</a>
					</li>
				</ul>
			</div>
			<!-- This Code defines personal Information tabs contents -->
			<div class="panel" id="PersonalInformation">
				<div id="wrapper">
				<form name="personal" method="post">
				<table style="width: 300px;">
						<tr>
							<td>
								Name:     
							</td>
							<td>
								<input type="text" readonly name="Name" value="<?php echo $row[2]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Roll No:     
							</td>
							<td>
								<input type="text" readonly name="roll_no" value="<?php echo $row[0]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Current Semseter:     
							</td>
							<td>
								<input type="text" readonly name="semsester" value="<?php echo $row[19]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Email Id:     
							</td>
							<td>
								<input type="text" readonly name="email" value="<?php echo $row[11]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Alternate Email Id:     
							</td>
							<td>
								<input type="text" readonly name="a_email" value="<?php echo $row[12]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Father's Name:     
							</td>
							<td>
								<input type="text"   readonly name="f_name" value="<?php echo $row[3]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Mother's Name:     
							</td>
							<td>
								<input type="text" readonly name="m_name" value="<?php echo $row[4]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Date Of Birth:     
							</td>
							<td>
								<input type="date"  readonly name="date" value="<?php echo $row[5]?>";/>

							</td>
						</tr>
						<tr>
							<td>
								Nationaltity:     
							</td>
							<td>
								<input type="text" readonly name="nationality" readonly value="<?php echo $row[6]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Caste:     
							</td>
							<td>
								<input type="text" readonly name="caste" value="<?php echo $row[8]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Religion:     
							</td>
							<td>
								<input type="text" readonly name="religion" value="<?php echo $row[10]?>";/>
					
							</td>
						</tr>
						<tr>
							<td>
								Category:     
							</td>
							<td>
								<input type="text" readonly  name="category" value="<?php echo $row[9]?>";/>
							</td>
						</tr><tr>
							<td>
								Contact Number:     
							</td>
							<td>
								<input type="text" readonly name="c_no" value="<?php echo $row[13]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Address:     
							</td>
							<td>
								<textarea name="address" readonly rows="4" cols="50"><?php echo $row[14]?></textarea>
							</td>
						</tr>
						<tr>
							<td>
								Father's Email Id:     
							</td>
							<td>
								<input type="text" readonly name="f_email" value="<?php echo $row[11]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Father's Contact Number:     
							</td>
								
							<td>
								<input type="text" readonly name="f_cn" value="<?php echo $row[15]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Landline Number:     
							</td>
								
							<td>
								<input type="text" readonly name="landline" value="<?php echo $row[16]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Degree:     
							</td>
								
							<td>
								<input type="text"  readonly name="degree" value="<?php echo $row[17]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Branch:     
							</td>
								
							<td>
								<input type="text" readonly name="branch" value="<?php echo $row[18]?>";/>
							</td>
						</tr><tr>
							<td>
								Date Of Joining:     
							</td>
								
							<td>
								<input type="date" readonly name="doj" value="<?php echo $row[20]?>";/>

							</td>
						</tr>
						<tr>
							<td>
								Batch:     
							</td>
								
							<td>
								<input type="text" readonly name="batch" value="<?php echo $row[21]?>";/>
							</td>
						</tr><tr>
							<td>
								Hostel:     
							</td>
								
							<td>
								<input type="text" readonly name="hostel" value="<?php echo $row[22]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Room Number:     
							</td>
								
							<td>
								<input type="text" readonly name="r_no" value="<?php echo $row[23]?>";/>
							</td>
						</tr><tr>
							<td>
								Weight:     
							</td>
								
							<td>
								<input type="text" readonly name="weight" value="<?php echo $row[26]?>";/>
							</td>
						</tr><tr>
							<td>
								Height:     
							</td>
								
							<td>
								<input type="text" readonly name="height" value="<?php echo $row[27]?>";/>
							</td>
						</tr><tr>
							<td>
								BMI:     
							</td>
								
							<td>
								<input type="text" readonly name="bmi" value="<?php echo $row[28]?>";/>
							</td>
						</tr><tr>
							<td>
								Current Health Status:     
							</td>
							<td>
							<input type="text" readonly name="current_health_status" value="<?php echo $row[29]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Medical history of Student based on Institute's Records:     
							</td>
							<td>
							<textarea name="m_history" readonly rows="4" cols="50"><?php echo $row[24]?></textarea>
							</td>
						</tr>
						<tr>
							<td>
								Sports Playing:     
							</td>
								
							<td>
								<input type="text" name="sports_playing" readonly value="<?php echo $row[30]?>";/>
							</td>
						</tr>
						<tr>
							<td>
								Level In Sports:     
							</td>
							<td>
								<input type="text" name="level" readonly value="<?php echo $row[31]?>";/>
							</td>
						</tr>
				</table>	
			</form>
			</div>
			</div>&nbsp;				
			<div class="panel" id="CurrentCourses">
				<div id="wrapper" style="width:1100px;">
				<form action="" method="post">
				 <table style="border:1px solid black;border-collapse:collapse;">
				 <tr>
					<th>Course Id</td>
					<th>Course Name</th>
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
				 </tr>
				 <?php 
				 while($row = mysql_fetch_array($result))
				 {
					echo "<tr>";
					echo "<td>".$row[0]."</td>";
					echo "<td>".$row[1]."</td>";
					echo "<td>".$row[27]."</td>";
					echo "<td>".$row[28]."</td>";
					echo "<td>".$row[29]."</td>";
					echo "<td>".$row[30]."</td>";
					echo "<td>".$row[31]."</td>";
					echo "<td>".$row[32]."</td>";
					echo "<td>".$row[33]."</td>";
					echo "<td>".$row[34]."</td>";
					echo "<td>".$row[35]."</td>";
					echo "<td>".$row[36]."</td>";
					echo "<td>".$row[37]."</td>";
					echo "<td>".$row[38]."</td>";
					echo "<td>".$row[39]."</td>";
					echo "</tr>";
				}
				?>
				</table>
				</form>
				</div>
			<!-- This Code defines Previous Result tab contents -->
			</div>&nbsp;
			<div class="panel" id="PreviousResults">
				<div id="wrapper">
				<form name="Gradesheet" method="post">
					<table>
						<tr>
							<td>Select Semester:</td>
							<td>
								<select name="semester" value="semester" placeholder="Semester" required>
								<option value="all" selected>All Semesters</option>
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
					</table>
			       
                    <input type="submit" name="marks-submit" value="Send"/>
				</form>
					<form name="Gradesheet-generated" method="post">
				<?php
					if(!empty($_POST['marks-submit']))
					{
						echo "<h2>Semester - ".$_POST['semester']."<br></h2>";

						echo '<table style="border:1px solid black;border-collapse:collapse;">
				 				<tr>
									<th>Course Id</th>
									<th>Course Name</th>
									<th>Grades</th>
									<th>Credit</th>
									<th>Semester</th>
				 				</tr>';
				 		$gradesheet=$control->semesterGardesheet($_SESSION['login'],$_POST['semester']);
				 		$totalcredits=0;
				 		$totalgrades=0;
				 		while ($grades=mysql_fetch_array($gradesheet)) 
				 		{
				 			echo '<tr>
				 					<td>'.$grades[1].'</td>
				 					<td>'.$grades[6].'</td>
				 					<td>'.$grades[4].'</td>
				 					<td>'.$grades[7].'</td>				 					
				 					<td>'.$grades[3].'</td>
				 				  </tr>';
				 			$totalcredits+=$grades[7];
				 			$grade=$grading->grades($grades[4]);
				 			$totalgrades+=$grade*$grades[7];

				 		}

				 		echo'</table>';
				 		if($totalcredits!=0)
				 		{
				 			$spi=$totalgrades/$totalcredits;
				 			$spi=number_format($spi,2);
				 			
				 			echo "<h3>SPI for Semester ".$_POST['semester']." is: ".$spi."</h2>";
				 		 }
		 				//header('Refresh: 1;Location: ' . basename($_SERVER['PHP_SELF']));

				 	}
				?>
				</form>
				</div>
				</div>&nbsp;
			<!-- This Code defines change password tab contents -->
			<div class="panel" id="Changepassword">
				<div id="wrapper">
				<form action="" method="post">
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
		</div>
		
		<!-- This is JavaScript part of our page -->
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
