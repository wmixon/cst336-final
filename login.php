<?php
session_start();   //starts or resumes a session

function loginProcess() {

    if (isset($_POST['loginForm'])) {  //checks if form has been submitted
    
        include './database.php';
        $conn = getDatabaseConnection();
      
            $username = $_POST['username'];
            $password = sha1($_POST['password']);
            
            $sql = "SELECT *
                    FROM admin
                    WHERE username = :username 
                    AND   password = :password ";
            
            $namedParameters = array();
            $namedParameters[':username'] = $username;
            $namedParameters[':password'] = $password;

            $stmt = $conn->prepare($sql);
            $stmt->execute($namedParameters);
            $record = $stmt->fetch();
            
            if (empty($record)) {
                
                echo "Wrong Username or password";
                
            } else {
            
               $_SESSION['username'] = $record['userName'];
               $_SESSION['adminName'] = $record['firstName'] . "  " . $record['lastName'];
               //echo $record['firstName'];
               header("Location: admin.php"); //redirecting to admin.php
                
            }
           // print_r($record);
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Login  </title>
        <style>
            @import url("css/styles.css");
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div id="box">
        <h2> Admin Login </h2>
        <br>
            
            <form method="post">
                
                Username: <input type="text" name="username"/> <br />
                
                Password: <input type="password" name="password" /> <br />
                <br>
                <input type="submit" name="loginForm" value="Login!"/>
                
            </form>

            <br />
            
            <?=loginProcess()?>
    </div>
        
            
    </body>
</html>