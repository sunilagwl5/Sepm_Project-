<!DOCTYPE html>
<?php
  session_start();

$myusername=$mypassword="";
  include("include/controller.php");

  $msg="";
  $control=new Controller();


  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $myusername=$control->correctInput($_POST['login']);
    $mypassword=$control->correctInput($_POST['password']); 
    if (!(empty($myusername)||empty($mypassword)))
    {
      $msg=$control->login($myusername,$mypassword,$_POST["Category"]);
      $_SESSION['category'] = $_POST["Category"];
      $_SESSION['login']= $myusername;
      $_SESSION['password']= $mypassword;
    }
    else
      $msg="Invalid Username or Password";
  }
  elseif(isset($_SESSION['login']))
    $control->login( $_SESSION['login'],$_SESSION['password'],$_SESSION['category']);
  $result=$control->viewNoticeBoard();
  $adminMessage=$control->viewAdminMessage();


?>

<head>
  <title>Student Grading Portal</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <table cellpadding="0" cellspacing="0" width="100%" align="center" >
    <tr>
            <td style="width: 7%">
            </td>
            <td style="width: 86%">
                <img alt="" src="images/Header.jpg" width="100%">
            </td>
            <td style="width: 7%">
            </td>
        </tr>
  </table>
  <div style="height:300px;border:2px solid black;width:650px;float:left;margin-top:50px; margin-left: 90px;background-color:rgb(238, 238, 238)">
        <h3 style="text-align:center;font-size:20px">Latest News</h3>
        <hr style="border:1px solid black">
        <marquee direction="up" scrollamount="2" style="height:250px;margin-left:10px;margin-left:10px" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 2, 0);">
          <div>
          <ol style="list-style:square;">
          <table style="width: 700px; ">
            <tr>
              <th style="font-size:20px; ">Name</th>
              <th style="font-size:20px; ">News</th>
            </tr>
            <tr>
              <td><br></td>
              <td><br></td>
            </tr>
          <?php
          echo '<tr style="text-align:center; padding-bottom: 2em;">
          <td style="font-size:15px; ">Mr.Rajeev Saxena</td>
                    <td style="font-size:15px; ">'.$adminMessage[0].'</td>
          </tr>';
		  
          while($row = mysql_fetch_array($result))
          {
			if($row[2] <= 1)
			{
				echo '
                    <tr style="text-align:center;  padding-bottom: 2em;">
                      <td style="font-size:15px;color:red; ">'.$row[1].'</td>
                      <td style="font-size:15px;color:red; ">'.$row[0].'</td>
                    </tr>';
			
			}
			else
			{	
				echo '
                    <tr style="text-align:center; padding-bottom: 2em;">
                      <td style="font-size:15px; ">'.$row[1].'</td>
                      <td style="font-size:15px; ">'.$row[0].'</td>
                    </tr>';
			}
			}
          ?>
          </table>
          </ol>
          </div>
        </marquee>    
        <!--marquee direction="up" style="margin-left:10px">
        <ul style="list-style-type:circle">
        <li>A training session is to be organized from 13-16th of September by a renowned company 'Find Your North', which will serve students a complete package that would help them in their future placements.</li>
        </ul>
        </marquee-->
    </div>
  <section class="container" >
    <div class="login">
      <h1>Login to StudentGradingPortal</h1>
      <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <p>
          <select name="Category" value="" placeholder="Category">
            <option value="users">Admin</option>
            <option value="student">Student</option>
            <option value="faculty">Faculty</option>
            
          </select>
        </p>
		    <p>
          <input type="text" name="login" value="" placeholder="Username"></p>
        <p>
          <input type="password" name="password" value="" placeholder="Password"></p>
        <p class="remember_me">
          <label>
            <input type="checkbox" name="remember_me" id="remember_me">
            Remember me
          </label>
        </p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
        <p style="color:red"><?php echo $msg;?>
      </form>
    </div>

    
  </section>
</body>
</html>