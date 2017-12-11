<?php
session_start();   //starts or resumes a session

function loginProcess() {
    if (isset($_GET['loginPage'])) {  //checks if form has been submitted
        header("Location: login.php"); //redirecting to login.php
    }
}

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>SQL</title>
        <style>
            @import url("css/styles.css");
            body{
                background-image: url('./img/game.jpg'), url('./img/game.jpg');
            }
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <h2>Game Search</h2>
    <body>
        <?=loginProcess()?>
        <div id="footer">
            
        
        
        <?php
              // connect to our mysql database server
              
              // make a query 
              
            $servername = "us-cdbr-iron-east-05.cleardb.net";
            $username = "be38fd891d40b6";
            $password = "40d33621";
            $dbname = "heroku_e2089215ec11dea";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // make a query 
            if($_GET['filter'] == "NAME" or $_GET['filter'] == ""){
                $sql = "SELECT * FROM vgaction UNION SELECT * FROM vgadventure UNION SELECT * FROM vgsimulation ORDER BY deviceName "  . $_GET['up'];
            }
            if($_GET['filter'] == "PRICE"){
                $sql = "SELECT * FROM vgaction UNION SELECT * FROM vgadventure UNION SELECT * FROM vgsimulation ORDER BY price "  . $_GET['up'];
            }
            if($_GET['filter2'] == "AVAILABILITY" and $_GET['filter'] == "NAME"){
                $sql = "SELECT * FROM vgaction WHERE status LIKE '%" . $_GET['wfilter'] . "%'
                        UNION
                        SELECT * FROM vgadventure WHERE status LIKE '%" . $_GET['wfilter'] . "%'
                        UNION
                        SELECT * FROM vgsimulation WHERE status LIKE '%" . $_GET['wfilter'] . "%'
                        ORDER BY deviceName " . $_GET['up'];
                        
            }
            if($_GET['filter2'] == "NAME2" and $_GET['filter'] == "NAME"){
                $sql = "SELECT * FROM vgaction WHERE deviceName LIKE '%" . $_GET['wfilter'] . "%'
                        UNION
                        SELECT * FROM vgadventure WHERE deviceName LIKE '%" . $_GET['wfilter'] . "%'
                        UNION
                        SELECT * FROM vgsimulation WHERE deviceName LIKE '%" . $_GET['wfilter'] . "%'
                        ORDER BY deviceName " . $_GET['up'];
                        
            }
            if($_GET['filter2'] == "TYPE" and $_GET['filter'] == "NAME"){
                $sql = "SELECT * FROM vgaction WHERE deviceType LIKE '%" . $_GET['wfilter'] . "%'
                        UNION
                        SELECT * FROM vgadventure WHERE deviceType LIKE '%" . $_GET['wfilter'] . "%'
                        UNION
                        SELECT * FROM vgsimulation WHERE deviceType LIKE '%" . $_GET['wfilter'] . "%'
                        ORDER BY deviceName " . $_GET['up'];
                        
            }
            if($_GET['filter2'] == "AVAILABILITY" and $_GET['filter'] == "PRICE"){
                $sql = "SELECT * FROM vgaction WHERE status LIKE '%" . $_GET['wfilter'] . "%'
                        UNION
                        SELECT * FROM vgadventure WHERE status LIKE '%" . $_GET['wfilter'] . "%'
                        UNION
                        SELECT * FROM vgsimulation WHERE status LIKE '%" . $_GET['wfilter'] . "%'
                        ORDER BY price " . $_GET['up'];
                        
            }
            if($_GET['filter2'] == "NAME2" and $_GET['filter'] == "PRICE"){
                $sql = "SELECT * FROM vgaction WHERE deviceName LIKE '%" . $_GET['wfilter'] . "%'
                        UNION
                        SELECT * FROM vgadventure WHERE deviceName LIKE '%" . $_GET['wfilter'] . "%'
                        UNION
                        SELECT * FROM vgsimulation WHERE deviceName LIKE '%" . $_GET['wfilter'] . "%'
                        ORDER BY price " . $_GET['up'];
                        
            }
            if($_GET['filter2'] == "TYPE" and $_GET['filter'] == "PRICE"){
                $sql = "SELECT * FROM vgaction WHERE deviceType LIKE '%" . $_GET['wfilter'] . "%'
                        UNION
                        SELECT * FROM vgadventure WHERE deviceType LIKE '%" . $_GET['wfilter'] . "%'
                        UNION
                        SELECT * FROM vgsimulation WHERE deviceType LIKE '%" . $_GET['wfilter'] . "%'
                        ORDER BY price " . $_GET['up'];
                        
            }
            
            $result = $conn->query($sql);
        ?>
        
        <form>
            <label>Order By: </label>
            <input type="radio" name="filter" value="NAME" checked="checked">Name
            <input type="radio" name="filter" value="PRICE">Price
            <br>
            <label></label>
            <input type="radio" name="up" value="ASC" checked="checked">Ascending
            <input type="radio" name="up" value="DESC">Descending
            <br><br>
            <label>Filter By: </label>
            <input type="radio" name="filter2" value="TYPE">Type
            <input type="radio" name="filter2" value="NAME2">Name
            <input type="radio" name="filter2" value="AVAILABILITY">Availability
            
            <br>
            
            <input type="text" name="wfilter">
            <input type="submit"  value="Order/Filter">
        </form>
        
        <?php
        
        $result = $conn->query($sql);
        
        ?>
        <table style="width:100%" class="table hover-table">
            <tr>
                <td><b>Name</b></td>
                <td><b>Type</b></td>
                <td><b>Price</b></td>
                <td><b>Status</b></td>
                <td><b>Stock</b></td>
                <td><b>Rating</b></td>
            </tr>

        <?php
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["deviceName"] . "</td><td>" . $row["deviceType"] . "</td><td>" . $row["price"] . "</td><td>" . $row["status"] . "</td><td>" . $row["stock"] . "</td><td>" . $row["rating"] . "</td></tr>";
            }
        } else {
            echo "0 results";
        }
        
        $conn->close();
        
        ?>
        <form method="get">
            <input type="submit" name="loginPage" value="Admin Login"/>
        </form>
        </div>
    </body>
</html>