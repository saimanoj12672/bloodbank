<?php 

session_start(); 

$conn = mysqli_connect('localhost','root','','blood_bank') or die("Could not connect to database");

if (isset($_POST['login_user'])) 
{
    if (isset($_POST['username']) && isset($_POST['password_1']))
    {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $uname = validate($_POST['username']);
        $pass = validate($_POST['password_1']);
        if (empty($uname)) 
        {
            header("Location: login.php?error=User Name is required");
            exit();
        }
        else if(empty($pass))
        {
            header("Location: login.php?error=Password is required");
            exit();
        }
        else
        {
            //$pass= $pass;
            $sql = "SELECT * FROM user WHERE username='$uname' AND password='$pass'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1)
            {
                $row = mysqli_fetch_assoc($result);
                if ($row['username'] === $uname && $row['password'] === $pass) 
                {
                    echo "Logged in!";
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['id'] = $row['id'];
                    if($row['status']==0)
                    {
                        header("Location: home.php");
                    }
                    else
                    {
                        $query="SELECT * FROM donorform WHERE username='$uname'";
                        $query1=mysqli_query($conn,$query);
                        $row1= mysqli_fetch_assoc($query1);
                        $_SESSION['date']=$row1['date'];
                        $_SESSION['hospital_name']=$row1['hospital_name'];
                        $_SESSION['area']=$row1['hospital_area'];
                        $_SESSION['ph_no']=$row1['phone_number'];
                        header("Location: results.php");
                    }
                    exit();
                }
                else
                {
                    header("Location: login.php?error=Incorect User name or password");
                    exit();
                }
            }
            else
            {
                header("Location: login.php?error=Incorect User name or password");
                exit();
            }
        }
    }
    else
    {
        header("Location: login.php");
        exit();
    }
}

if (isset($_POST['reg_user']))
{
    //Register Users
    if (isset($_POST['username'])) {
        $username= mysqli_real_escape_string($conn, $_POST['username']);
    }
    if (isset($_POST['email'])) {
        $email= mysqli_real_escape_string($conn, $_POST['email']);
    }
    if (isset($_POST['password_1'])) {
        $password_1= mysqli_real_escape_string($conn, $_POST['password_1']);
    }
    if (isset($_POST['password_2'])) {
        $password_2= mysqli_real_escape_string($conn, $_POST['password_2']);
    }

    if($password_1 != $password_2)
    {
        header("Location: registration.php?error=passwords do not match");
        exit();   
    }

    //check db for existing user with same username and email id

    $user_check_query = "SELECT * FROM user WHERE username = '$username' or email = '$email' LIMIT 1";
    $results = mysqli_query($conn,$user_check_query);
    $user = mysqli_fetch_assoc($results);

    if ($user)
    {
        if ($user["username"] === $username)
        {
            header("Location: registration.php?error=Entered user name is already registered");
            exit();
        }
        if ($user["email"] === $email)
        {
            header("Location: registration.php?error=Entered email id is already registered");
            exit();
        }
    }

    //Register the user if no errors
  
    $password = $password_1; //this will encrypt the password
    $query = "INSERT INTO user (username,email,password) VALUES ('$username','$email','$password')";
    mysqli_query($conn,$query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = 'You are now logged in';
    header('location: home.php');   
    
}
if (isset($_POST['bdonor']))
{   
    $name =  $_REQUEST['name'];
    $bloodgrp=$_REQUEST['grp'];
    $hos_name=$_REQUEST['hname'];
    $hos_area=$_REQUEST['harea'];
    $ph_no=$_REQUEST['phone'];
    $city=$_REQUEST['city'];
    $day=$_REQUEST['day'];
    $username=$_SESSION['username'];
    $sqlqry="SELECT * FROM donorform WHERE username='$username'";
    $result=mysqli_query($conn,$sqlqry);
    if(mysqli_num_rows($result)===1){
        $query2="UPDATE donorform SET name='$name',blood_group='$bloodgrp',city='$city',hospital_area='$hos_area',hospital_name='$hos_name',phone_number='$ph_no',date='$day' WHERE username='$username'";
        mysqli_query($conn,$query2);
    }
    else{
    $query = "INSERT INTO donorform(name,blood_group,city,hospital_area,hospital_name,phone_number,date,username,status) VALUES ('$name','$bloodgrp','$city','$hos_area','$hos_name','$ph_no','$day','$username','1')";
    $query1="UPDATE user SET status='1' WHERE username='$username'";
    mysqli_query($conn,$query1);
    mysqli_query($conn,$query);
    }
    $_SESSION['username'] = $username;
    $_SESSION['date']=$day;
    $_SESSION['area']=$hos_area;
    $_SESSION['hospital_name']=$hos_name;
    $_SESSION['ph_no']=$ph_no;
    header('location: results.php'); 
}
?>