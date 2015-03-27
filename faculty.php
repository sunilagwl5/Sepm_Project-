<!DOCTYPE HTML>
<?php 
session_start();
    /******************** UCAD 3(Faculty)************************************************/

    include("include/controller.php");
    //include("include/view.php");

    $control=new Controller();
    //$view=new View();

    $cdetails=array();

    if($_SESSION['category']!="faculty")
        header('Location:index.php');
    /************ UCAD 3.3 : Software Update Faculty Profile function ********/
    if (!empty($_POST['faculty-submit'])) 
    {
        
        $fdetails=array();
        $fdetails[0]="";
        $fdetails[1]="";
        $fdetails[2]=$_POST['faculty_name'];//
        $fdetails[3]=$_POST['room-no'];
        $fdetails[4]=$_POST['mobile-no'];
        $fdetails[5]=$_POST['office-no'];
        $fdetails[6]=$_POST['email_idf'];

        $control->updatefacultyDetails($fdetails,$_SESSION['login']);
        //header('Refresh: 1;Location: ' . basename($_SERVER['PHP_SELF']));
         echo '
                <script type="text/javascript">
                location.reload();
                </script>';

    }
    /**********************************************************************/


    /************ UCAD 3.1 : Software View Faculty Profile function ********/

    $row=$control->viewDetails($_SESSION['category'], $_SESSION['login']);
    
    /**********************************************************************/

    /************ UCAD 3.2: Software Course Details Function **************/
    if (!empty($_POST['weightage-submit'])) 
    {
        //echo "<script>alert('suman')</script>";
        $cdetails[0]=$_POST["courseid"];
        $cdetails[1]="";
        $cdetails[2]="";
        $cdetails[3]=$_POST["wtgquiz1"];
        $cdetails[4]=$_POST["wtgquiz2"];
        $cdetails[5]=$_POST["wtgquiz3"];        
        $cdetails[6]=$_POST["wtgquiz4"];
        $cdetails[7]=$_POST["wtgquiz5"];
        $cdetails[8]=$_POST["wtgquiz6"];
        $cdetails[9]=$_POST["wtgquiz7"];
        $cdetails[10]=$_POST["wtgquiz8"];
        $cdetails[11]=$_POST["wtgmid_term1"];
        $cdetails[12]=$_POST["wtgmid_term2"];
        $cdetails[13]=$_POST["wtgend_term"];
        $cdetails[14]=$_POST["marksquiz1"];
        $cdetails[15]=$_POST["marksquiz2"];
        $cdetails[16]=$_POST["marksquiz3"];
        $cdetails[17]=$_POST["marksquiz4"];
        $cdetails[18]=$_POST["marksquiz5"];
        $cdetails[19]=$_POST["marksquiz6"];
        $cdetails[20]=$_POST["marksquiz7"];
        $cdetails[21]=$_POST["marksquiz8"];
        $cdetails[22]=$_POST["marksmid_term1"];
        $cdetails[23]=$_POST["marksmid_term2"];
        $cdetails[24]=$_POST["marksend_term"];
        $control->updateQuizWeightage($cdetails);
         echo '
                <script type="text/javascript">
                location.reload();
                </script>';
        //echo  $cdetails[15];
        //header('Refresh: 1;Location: faculty.php#Changepassword'));

    }
    /*******************************************************************************/


    /************ UCAD 3.4: Software Change Passowrd Function ********/
    if (!empty($_POST['Change-submit'])) 
    {
        
        $cdetails=array();
        $cdetails[0]=$_POST['currentpassword'];
        $cdetails[1]=$_POST['changepassword'];
        $cdetails[2]=$_POST['confirmpassword'];
        $var=$control->authenticate($_SESSION['login'],$_SESSION['category'],$cdetails[0]);
        if($var == 0)
        {
            echo"<script>alert('Worng Current Password ')</script>";
        }
        else if($cdetails[1] == $cdetails[2])
            $control->changePassword($cdetails[1],$_SESSION['login'],$_SESSION['category']);
        
        else
        {
            echo"<script>alert('Change password and Confirm password do not match ')</script>";
        }
        //header('Location:index.html');
         echo '
                <script type="text/javascript">
                location.reload();
                </script>';
        
    }
    /***************************************************************************************/
   
  ?>
<html>

	<head>
		<link rel="stylesheet" type="text/css" media="all" href="css/_style.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Faculty</title>	
	</head>
	
	<body>
		<div id="content">
			<h1>Hello, <?php echo $row[2];?>
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
					<li >
						<a href="#FacultyInformation" data-toggle="tab" id="FacultyInformation-tab">Personal Information</a>
					</li>
					<li >
						<a  href="#FacultyCoursesUndertaken" data-toggle="tab" id="FacultyCoursesUndertaken-tab">Courses Undertaken</a>
					</li>
					<li >
						<a href="#FacultyGradingAndMarks" data-toggle="tab" id="FacultyGradingAndMarks-tab">Grading And Marks</a>
					</li>
                    <li>
                        <a href="#Addupdates" data-toggle="tab" id="Addupdates-tab">Update It</a>
                    </li>
                    <li>
                        <a href="#Changepassword" data-toggle="tab" id="Changepassword-tab">Change Password</a>
                    </li>
				</ul>
			</div>







<!-- Displays & Edit Faculty Profile Function (UCAD 3.1) -->            
<div class="panel" id="FacultyInformation">
                <div id="wrapper">
                <form name="facultydetails" method="post">
                     <table>
                        <tr>
                            <td>
                                Faculty Name:     
                            </td>
                            <td>
                                <input type="text" name="faculty_name" value="<?php echo $row[2]?>"; required/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                E-mail_Id:     
                            </td>
                            <td>
                                <input type="email" name="email_idf" value="<?php echo $row[6]?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mobile Number:     
                            </td>
                            <td>
                                <input type="tel" name="mobile-no" value="<?php echo $row[5]?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Office Number:     
                            </td>
                            <td>
                                <input type="tel" name="office-no" value="<?php echo $row[4]?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Room Number:     
                            </td>
                            <td>
                                <input type="number" name="room-no" value="<?php echo $row[3]?>"/>
                            </td>
                        </tr>
                    </table>
                   
                    <input type="submit" name="faculty-submit" value="Submit"/>
                    
                    
                    </form>
                </div>
            </div>









<!-- Displays & Edit Course Details alloted to Faculty  (UCAD 3.3) -->            
			<div class="panel" id="FacultyCoursesUndertaken">
				<div id="wrapper">
				<form name="getcourse-details"  method="post">

                    <div>
                    <label for="subject">Subject </label>
                    <select name="courses" value="Course List" placeholder="Course List">
                        <option >Course List</option>
                        <?php
                            $getcourse=$control->getCourseList($_SESSION['login']);
                            $result_array = array();
                            while ($row = mysql_fetch_array($getcourse))
                            {
                                $result_array[] = $row; 
                                echo "<option value='$row[0]'>$row[1]</option>";
                            }
                        ?>
                    </select>

                    </div>
                    
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <input type="submit" name="getcourse-submit" value="Get Details"/>

                    </form>
                    <?php
                        if (!empty($_POST['getcourse-submit'])) 
                        {
                            $gcd=$control->viewCourseDetails($_POST['courses']);
                            echo '<form name="courseundertaken"  method="post">
                            <br>
                            <br>
                            <div>
                                <h2>Course Name:&nbsp&nbsp&nbsp&nbsp'.$gcd[1].'('.$gcd[0].') </h2>
                            </div>
                            <div>
                                <h3>Credits:&nbsp&nbsp'.$gcd[2].'</h3>
                            </div>
                            <div>
                            <input type="hidden" name="courseid" value="'.$gcd[0].'">
                            </div>
                            
                    <table>
                        <tr>
                            <th>Weightage</th>
                            <th>Total Marks</th>
                        </tr>
                        <tr>
                            <td><label for="wtg">Quiz 1: </label><input type="number" name="wtgquiz1" value="'.$gcd[3].'"/></td>
                            <td><input type="number" name="marksquiz1" value="'.$gcd[14].'"/></td>
                        </tr>
                        <tr>
                            <td><label for="wtg">Quiz 2: </label><input type="number" name="wtgquiz2" value="'.$gcd[4].'"/></td>
                            <td><input type="number" name="marksquiz2" value="'.$gcd[15].'"/></td>
                        </tr>
                        <tr>
                            <td><label for="wtg">Quiz 3: </label><input type="number" name="wtgquiz3" value="'.$gcd[5].'"/></td>
                            <td><input type="number" name="marksquiz3" value="'.$gcd[16].'"/></td>
                        </tr>
                        <tr>
                            <td><label for="wtg">Quiz 4: </label><input type="number" name="wtgquiz4" value="'.$gcd[6].'"/></td>
                            <td><input type="number" name="marksquiz4" value="'.$gcd[17].'"/></td>
                        </tr>
                        <tr>
                            <td><label for="wtg">Quiz 5: </label><input type="number" name="wtgquiz5" value="'.$gcd[7].'"/></td>
                            <td><input type="number" name="marksquiz5" value="'.$gcd[18].'"/></td>
                        </tr>
                        <tr>
                            <td><label for="wtg">Quiz 6: </label><input type="number" name="wtgquiz6" value="'.$gcd[8].'"/></td>
                            <td><input type="number" name="marksquiz6" value="'.$gcd[19].'"/></td>
                        </tr>
                        <tr>
                            <td><label for="wtg">Quiz 7: </label><input type="number" name="wtgquiz7" value="'.$gcd[9].'"/></td>
                            <td><input type="number" name="marksquiz7" value="'.$gcd[20].'"/></td>
                        </tr>
                        <tr>
                            <td><label for="wtg">Quiz 8: </label><input type="number" name="wtgquiz8" value="'.$gcd[10].'"/></td>
                            <td><input type="number" name="marksquiz8" value="'.$gcd[21].'"/></td>
                        </tr>
                        <tr>
                            <td><label for="wtg">Mid 1: </label><input type="number" name="wtgmid_term1" value="'.$gcd[11].'"/></td>
                            <td><input type="number" name="marksmid_term1" value="'.$gcd[22].'"/></td>
                        </tr><tr>
                            <td><label for="wtg">Mid 2: </label><input type="number" name="wtgmid_term2" value="'.$gcd[12].'"/></td>
                            <td><input type="number" name="marksmid_term2" value="'.$gcd[23].'"/></td>
                        </tr>
                        <tr>
                            <td><label for="wtg">End Sem: </label><input type="number" name="wtgend_term" value="'.$gcd[13].'"/></td>
                            <td><input type="number" name="marksend_term" value="'.$gcd[24].'"/></td>
                        </tr>

                    </table>
                
                <input type="submit" name="weightage-submit" value="Submit"/>

                </form> ';
    
                }   
                ?>
                    
				</div>
			</div>


<!-- Displays & Put Submit Grade Function (UCAD 3.2) -->            
			<div class="panel" id="FacultyGradingAndMarks">
				<div id="wrapper">
				<form action="getGrades.php" method="post" target="_blank">
                   
                    <div>
                    <label for="subject"> Subjects</label>
                    <select name="courses" value="Course List" placeholder="Course List">
                        <?php
                           foreach ($result_array as $value)
                           {    //echo "suman";
                                echo "<option value='$value[0]' selected>$value[1]</option>";
                            }
                               //echo "<option value='$row[0]' >$row[0]</option>";
                        ?> 
                        </select>

                    
                    </div>
					<input type="submit" name="grdesheet-submit" value="Submit"/>
				</form>
				</div>
                
			</div>

            <!-- Change Passoword (UCAD 3.4) -->            
            <div class="panel" id="Changepassword" >
                <div id="wrapper">
                <form  method="post" >
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
            <div class="panel" id="Addupdates" >
                <div id="wrapper">
                <form  method="post">
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
                        $control->updateNoticeBoard($_SESSION['login'],$_POST['messg']);
                         echo '
                            <script type="text/javascript">
                            location.reload();
                            </script>';
                        }
                ?>
                </div>
            </div>&nbsp;
		</div>
         <!-- This is JavaScript part of our page -->
        <script type="text/javascript" src="js/prototype.js"></script>
        <script type="text/javascript" src="js/fabtabulous.js"></script>
        <script type="text/javascript">
            var _tabs = new Fabtabs('tabs');
            var t = $(this.href.match(/#(\w.+)/)[1]+'-tab');
            alert(t);
            $$('a.next-tab').each(function(a) {
                Event.observe(a, 'click', function(e){

                    var t = $(this.href.match(/#(\w.+)/)[1]+'-tab');
                    //alert(_t);
                        
                    _tabs.show(t);
                    _tabs.menu.without(t).each(_tabs.hide.bind(_tabs));
                }.bindAsEventListener(a));

            });
        </script>
	</body>
</html>
