<?php
/**
 * Created by PhpStorm.
 * User: Anuvakah
 * Date: 4/1/14
 * Time: 1:26 AM
 */

class Grading {
    
    var $marks=array();
    var $mid;
    var $high;
    var $rollid;
    function Grading()
    {
        
        $this->connection=mysql_connect("localhost","root","");
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }       
        mysql_select_db("studentgrading",$this->connection);
        
    }
    function generateQuery($options)
    {
        $query="SELECT * FROM currently_courses where course_id='$options'";
        //echo $query;
        $result = mysql_query($query,$this->connection);
        return $result;
             
    }
    function getSemesterMarks($options)
    {
        $query="SELECT * FROM currently_courses where username='$options[0]' and course_id='$options[1]'";
        //echo $query;
        $result = mysql_query($query,$this->connection);
        if(!($row = mysql_fetch_array($result)))
            echo "<script>alert('Database Error')</script>";
        else
            return $row;        
    }
    function getGardes($options)
    {
        $query="SELECT grade FROM currently_courses where course_id='$options'";
        $result = mysql_query($query,$this->connection);
        return $result;
    }
    function getSubjectMarks($options)
    {
        $query="SELECT * FROM courses where course_id='$options[1]'";
         $result = mysql_query($query,$this->connection);
        if(!($row = mysql_fetch_array($result)))
            echo "<script>alert('Database Error')</script>";
        else
            return $row;   
    }
    function calculateTotalMarks($options) // Calculates the total marks for each Student
    {
        $query="SELECT * FROM courses where course_id='$options'";
        $result_courses = mysql_query($query,$this->connection);
        $result_currnt_c=$this->generateQuery($options);

        if(!($row_c=mysql_fetch_array($result_courses)))
            echo "<script>alert('Database Error')</script>";

        
        while($row=mysql_fetch_array($result_currnt_c))
        {
            $marks=0;
            for($x=0;$x<=10;$x++)
            {
                if($row_c[$x+3]!=0)
                {
                    $marks+=($row[$x+2]/$row_c[$x+14])*$row_c[$x+3];
                    //echo $row[$x+2];
                    //echo $row[$x+2]."/".$row_c[$x+14]." * ".$row_c[$x+3];
                    //echo "=".$marks."<br>";
                }
                
            }
            $query="UPDATE currently_courses SET total_marks='$marks' WHERE username='$row[0]' and course_id='$row[1]'";
            //echo $query;
            if(!($result = mysql_query($query,$this->connection)))
                echo "Database Error";
        }

    }

    function grades($option)
    {
        switch ($option) {
            case 'A':
                return 10;
                break;
            case 'AB':
                return 9;
                break;
            case 'B':
                return 8;
                break;
            case 'BC':
                return 7;
                break;
            case 'C':
                # code...
                return 6;
                break;
            case 'CD':
                return 5;
                # code...
                break;
            case 'D':
                return 4;
                # code...
                break;
            case 'E':
                return 2;
                # code...
                break;
            case 'F':
                return 0;
                # code...
                break;
            default:
                # code...
                break;
        }
    }

    function calculateCpi($options)
    {
        $totalcredits=0;
        $totalgrades=0;
        while ($grades=mysql_fetch_array($options)) 
        {
            $totalcredits+=$grades[7];
            $grade=$this->grades($grades[4]);
            $totalgrades+=$grade*$grades[7];               

        }
        if($totalcredits!=0){
            $spi=$totalgrades/$totalcredits;
            $spi=number_format($spi,2);
        return $spi;
        }
    }
    /*Grading Decision*/
    /*****************************************************************************************************************/
    function calculateGrades($courses, $type)
    {
        $query="SELECT total_marks,username FROM currently_courses WHERE course_id='$courses'";
        //echo( $query);
        $this->courseid=$courses;
        $result = mysql_query($query,$this->connection);
        $size=0;
        while ($row = mysql_fetch_array($result)) 
        {
            
            $this->rollid[$size]=$row[1];
            
            $this->marks[$size] =  $row['total_marks'];
            $size++;
            //echo($row[13]);
            if($this->high<$row['total_marks'])
                $this->high=$row['total_marks'];
            $total = $row['total_marks'] + $total;
        }
        $this->mid=$total/$size;
        //echo($total);
        //echo($this->high."--");
       //echo($type);
        
        switch ($type) {
            case 'liberal':
                //echo "libera";
                $this->easy_grading();
                break;
            case 'medium':
                $this->medium_grading();
                break;
            case 'strict':
                $this->set_strict_grading();
                break;
            default:
                echo('Some error');
                break;
        }
    }
    function set_strict_grading()
    {
        $gap=($this->high-$this->mid)/5;
        $grade=array();
        $i=0;
        foreach ($this->marks as $value)
        {
            if(abs($value-$this->mid)<=$gap)
                $grade[$i]='C';
            elseif(abs($value-$this->mid)<=2*$gap)
            {
                if($value-$this->mid<0)
                $grade[$i]='CD';
                else
                $grade[$i]='BC';
            }
            elseif(abs($value-$this->mid)<=3*$gap)
            {
                if($value-$this->mid<0)
                $grade[$i]='D';
                else
                $grade[$i]='B';
            }
            elseif(abs($value-$this->mid)<=4*$gap)
            {
                if($value-$this->mid<0)
                $grade[$i]='E';
                else
                $grade[$i]='AB';
            }
            else
            {
                if($value-$this->mid<0)
                $grade[$i]='F';
                else
                    $grade[$i]='A';
            }
            $i++;
        }
        $this->submit($grade);

    }
    
    function medium_grading()
    {
        $gap=($this->high-$this->mid)/4;
        $grade=array();
        $i=0;
        foreach ($this->marks as $value)
        {
            echo $value;
            if(abs($value-$this->mid)<=$gap)
                $grade[$i]='BC';
            elseif(abs($value-$this->mid)<=2*$gap)
            {
                if($value-$this->mid<0)
                $grade[$i]='C';
                else
                $grade[$i]='B';
            }
            elseif(abs($value-$this->mid)<=3*$gap)
            {
                if($value-$this->mid<0)
                $grade[$i]='CD';
                else
                $grade[$i]='AB';
            }
            elseif(abs($value-$this->mid)<=4*$gap)
            {

                if($value-$this->mid<0)
                {
                    $grade[$i]='D';
                    //echo "suman";
                    
                }
                else
                $grade[$i]='A';
                //echo $value-$this->mid;
            }
            elseif(abs($value-$this->mid)<=5*$gap)
            {
                $grade[$i]='E';
            }
            else
                $grade[$i]='F';
            $i++;
        }
        $this->submit($grade);

    }
    function easy_grading()
    {
        $gap=($this->high-$this->mid)/3;
        $grade=array();
        $i=0;
        foreach ($this->marks as $value)
        {
            //echo("<br>suman");

            if(abs($value-$this->mid)<=$gap)
                $grade[$i]='B';
            elseif(abs($value-$this->mid)<=2*$gap)
            {
                if($value-$this->mid<0)
                $grade[$i]='C';
                else
                $grade[$i]='AB';
            }
            elseif(abs($value-$this->mid)<=3*$gap)
            {
                if($value-$this->mid<0)
                $grade[$i]='CD';
                else
                $grade[$i]='A';
            }
            elseif(abs($value-$this->mid)<=4*$gap)
            {    
                $grade[$i]='D';
            }
            elseif(abs($value-$this->mid)<=5*$gap)
            {
                $grade[$i]='E';
            }
            else
                $grade[$i]='F';
            //echo $grade[i]."<br>";
            $i++;
        }
        //echo($grade[0]);
        $this->submit($grade);

    }
    function submit($grade)
    {
        $i=0;
        foreach ($grade as $value) 
        {
            $val=$this->rollid[$i];
            $query="UPDATE currently_courses SET grade='$value' WHERE course_id='$this->courseid' and username='$val'";

            //echo $query;
            if(!($result = mysql_query($query,$this->connection)))
                echo "Database Error";
            $i++;
        }
        

    }
    /*********************************************************************************************************************/
} 