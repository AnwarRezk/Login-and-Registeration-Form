<html>
<body>
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registeration";
// connect to the database
$db = mysqli_connect($servername,$username,$password,$dbname);
// Check connection
if (!$db) 
{
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if($_POST['submit'] == "Register")
    {
        $email_val = $_POST['Email'];
       //$userid_val = $_POST['Userid'];
        $username_val = $_POST['Username'];
        $password_val = $_POST['Password'];
        $date_val = date("Y/m/d");
        $encrypted_password = md5($password_val);
        $user_check_sql = "SELECT * FROM users 
                   WHERE username = '$username_val' 
                   OR email = '$email_val' ";

        $user_insert_sql = "INSERT INTO users (username, password, email ,registeration_date,last_login_date)
                    VALUES ('$username_val','$encrypted_password', '$email_val', '$date_val','$date_val')";
        $result = mysqli_query($db, $user_check_sql);
        $assoc_check = mysqli_fetch_assoc($result);
        if($assoc_check == NULL)
        {	
	        $result = mysqli_query($db,$user_insert_sql);
            if( $result == TRUE ) 
            {
                $_SESSION['username'] = $username_val;
                $_SESSION['success'] = "You are now logged in";
                header('Location: welcome.php');
            }   
        }
        else
        {
            echo 'An account with the same Username, Email or Password already exists !';
        } 
    }
    else if($_POST['submit'] == "Login")
    {
        $username_val = $_POST['Username'];
        $password_val = $_POST['Password'];
        $date_val = date("Y/m/d");
        $encrypted_password = md5($password_val);
        $user_check_sql= "SELECT * FROM users WHERE username = '$username_val' AND password = '$encrypted_password'";
        $result = mysqli_query($db, $user_check_sql);
        if (mysqli_num_rows($result) == 1) 
        {
            $user_alter_date_sql = "UPDATE users SET last_login_date='$date_val' WHERE username ='$username_val'";
            mysqli_query($db,$user_alter_date_sql);
            $_SESSION['username'] = $username_val;
            $_SESSION['success'] = "You are now logged in";
            header('Location: welcome.php');
        }
        else 
        {
            echo 'Wrong Password&Username Combination';
        }
    }
    
}

//close connection at the end.
mysqli_close($db);
?> 
</body>
</html>
