<?php
session_start();


if (!isset($_SESSION['username'])) {  //checks whether the admin is logged in
    header("Location: index.php");
}

function itemList(){
    include './database.php';
    $conn = getDatabaseConnection();
    
    $sql = "SELECT * FROM User ORDER BY lastName ASC";
    $sql = "SELECT * FROM vgaction UNION SELECT * FROM vgadventure UNION SELECT * FROM vgsimulation ORDER BY deviceName";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);
    return($records);
}



?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Main Page </title>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
        
            function avgPrice(){
                $.ajax({
                    type: "get",
                    url: "avgPrice.php?",
                    data: {"avgPrice":$("#avg").val()},
                    success: function(data,status) {
                        //console.log(data);
                        //debugger
                        $("#avg").html(data);
                        
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                         //alert(status);
                    }
                });
            }
            function avgRating(){
                $.ajax({
                    type: "get",
                    url: "avgRating.php?",
                    data: {"avgPrice":$("#avgRate").val()},
                    success: function(data,status) {
                        //console.log(data);
                        //debugger
                        $("#avgRate").html(data);
                        
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                         //alert(status);
                    }
                });
            }
            function avgStock(){
                $.ajax({
                    type: "get",
                    url: "avgStock.php?",
                    data: {"avgPrice":$("#avgSt").val()},
                    success: function(data,status) {
                        //console.log(data);
                        //debugger
                        $("#avgSt").html(data);
                        
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                         //alert(status);
                    }
                });
            }
            function confirmDelete() {
                
                return confirm("Are you sure you want to delete this item?");
            }
        </script>
        <style>
            @import url("css/styles.css");
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        
        
        <div id="box">
        <h2> Admin Main </h2>
        <h3> Welcome <?=$_SESSION['adminName']?>!</h3>
        
        <form action="addItem.php">
                
            <input type="submit" value="Add new item" />
            
        </form>
        <br>
        <form action="logout.php">
            
            <input type="submit" value="Logout!" />
            
        </form>
        <br>
        <button onclick="avgPrice();">Avg Price</button><span id="avg"></span>
        <button onclick="avgRating();">Avg Rating</button><span id="avgRate"></span>
        <button onclick="avgStock();">Avg Stock</button><span id="avgSt"></span>
            
        <div id="footer">
            
        
        
        <?php
              // connect to our mysql database server
              
              // make a query 
              
            $servername = "us-cdbr-iron-east-05.cleardb.net";
            $username = "bdb5384f6f52f0";
            $password = "caeb83fc";
            $dbname = "heroku_e85b7747a279cb7";
            
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
        <table style="width:100%" class="table table-hover">
            <tr>
                <td><b>ID</b></td>
                <td><b>Name</b></td>
                <td><b>Type</b></td>
                <td><b>Price</b></td>
                <td><b>Status</b></td>
                <td><b>Stock</b></td>
                <td><b>Rating</b></td>
                <td><b>Update</b></td>
                <td><b>Delete</b></td>
            </tr>

        <?php
        
        foreach($result as $items){
            echo "<tr><td>" . $items['id'] . "</td><td>" . $items["deviceName"] . "</td><td>" . $items["deviceType"] . "</td><td>" . $items["price"] . "</td><td>" . $items["status"] . "</td><td>" . $items["stock"] . "</td><td>" . $items["rating"];
            echo "</td><td>" . "<a href='updateItem.php?itemId=" . $items['id'] . "'> Update </a>";
            echo "</td><td>" ."<a onclick='return confirmDelete()' href='deleteItem.php?itemId=".$items['id']."'> Delete </a> <br />" . "</td></tr>";
        }
        $conn->close();
        
        ?>
        </div>
    </body>
    <br>
    <br>
</html>