<?php

include 'database.php';
$conn = getDatabaseConnection();

if (isset($_GET['addItem'])) {  //the add form has been submitted

    $sql = "INSERT INTO vgaction
             (deviceName, deviceType, price, status, stock, rating) 
             VALUES
             (:dn, :dt, :p1, :s1, :st1, :r1)";
    $np = array();
    
    //echo "$sql";
    
    $np[':dn'] = $_GET['deviceName1'];
    $np[':dt'] = $_GET['deviceType1'];
    $np[':p1'] = $_GET['price1'];
    $np[':s1'] = $_GET['status1'];
    $np[':st1'] = $_GET['stock1'];
    $np[':r1'] = $_GET['rating1'];
    
    $stmt=$conn->prepare($sql);
    $stmt->execute($np);
    
    echo "<div id='box'> Item was added! </div>";
    
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin: Add new Item</title>
        <style>
            @import url("css/styles.css");
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

            <h2> Tech Game System: Adding a New Item </h2>
            <br>
            <div id="box">
            <form method="GET">
                Name:<input type="text" name="deviceName1" />
                <br>
                <br>
                Type:<select name="deviceType1">
                    <option value="Action"> Action </option>
                    <option value="Adventure"> Adventure </option>
                    <option value="Simulation"> Simulation </option>
                </select>
                <br>
                <br>
                Price: <input type="text" name ="price1"/>
                <br>
                <br>
                Status:<select name="status1">
                    <option value="available"> available </option>
                    <option value="Not Available"> Not Available </option>
                    <option value="Out of Stock"> Out of Stock </option>
                </select>
                <br>
                <br>
                Stock: <input type="text" name= "stock1"/>
                <br>
                <br>
                Rating: 
                <select name="rating1">
                    <option value="0"> 0 </option>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                    <option value="6"> 6 </option>
                    <option value="7"> 7 </option>
                    <option value="8"> 8 </option>
                    <option value="9"> 9 </option>
                    <option value="10"> 10 </option>
                </select>
                <br>
                <br>
                <input type="submit" value="Add Item" name="addItem">
            </form>
            <br>
            <form action="admin.php">
                
                <input type="submit" value="Home" />
                
            </form>
            <br>
            <br>
        </div>
    </body>
</html>