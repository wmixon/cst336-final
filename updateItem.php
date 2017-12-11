<?php
session_start();

    if (!isset($_SESSION['username'])) {
        
        header("Location: index.php");
        
    }
    include 'database.php';
    $conn = getDatabaseConnection();
  
function getitemInfo() {
    global $conn;
    
    $sql = "SELECT * FROM vgaction WHERE id = " . $_GET['itemId'] .
            " UNION
            SELECT * FROM vgadventure WHERE id = " . $_GET['itemId'] .
            " UNION
            SELECT * FROM vgsimulation WHERE id = " . $_GET['itemId']; 
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    //print_r($record);
    
    return $record;

}


 if (isset($_GET['updateItem'])) { //checks whether admin has submitted form.
     
     //echo "Form has been submitted!";
    //Action
    $sql = "UPDATE vgaction
            SET 
                deviceName = :dn,
                deviceType = :dt,
                price = :p1,
                status = :s1,
                stock = :st1,
                rating = :r1 
            WHERE id = :id";

    $np = array();
     
    $np[':dn'] = $_GET['deviceName1'];
    $np[':dt'] = $_GET['deviceType1'];
    $np[':p1'] = $_GET['price1'];
    $np[':s1'] = $_GET['status1'];
    $np[':st1'] = $_GET['stock1'];
    $np[':r1'] = $_GET['rating1'];
    $np[':id'] = $_GET['itemId'];  
     
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
     
     //Adventure
    $sql = "UPDATE vgadventure
            SET 
                deviceName = :dn,
                deviceType = :dt,
                price = :p1,
                status = :s1,
                stock = :st1,
                rating = :r1 
            WHERE id = :id";

    $np = array();
     
    $np[':dn'] = $_GET['deviceName1'];
    $np[':dt'] = $_GET['deviceType1'];
    $np[':p1'] = $_GET['price1'];
    $np[':s1'] = $_GET['status1'];
    $np[':st1'] = $_GET['stock1'];
    $np[':r1'] = $_GET['rating1'];
    $np[':id'] = $_GET['itemId'];  
     
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    
     //Simulation
    $sql = "UPDATE vgsimulation
            SET 
                deviceName = :dn,
                deviceType = :dt,
                price = :p1,
                status = :s1,
                stock = :st1,
                rating = :r1 
            WHERE id = :id";

    $np = array();
     
    $np[':dn'] = $_GET['deviceName1'];
    $np[':dt'] = $_GET['deviceType1'];
    $np[':p1'] = $_GET['price1'];
    $np[':s1'] = $_GET['status1'];
    $np[':st1'] = $_GET['stock1'];
    $np[':r1'] = $_GET['rating1'];
    $np[':id'] = $_GET['itemId'];  
     
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
     
     echo "<div id='box'> Item has been updated! </div>";
     
 }


 if (isset($_GET['itemId'])) {
     
    $itemInfo = getitemInfo(); 
     
     
 }



?>


<!DOCTYPE html>
<html>
    <head>
        <title> Update Game </title>
        <style>
            @import url("css/styles.css");
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

        <h2> Tech Game System: Updating Games's Info </h2>
        <br>
        <div id="box">
        <form method="GET">
            <input type="hidden" name="itemId" value="<?=$itemInfo['id']?>" />
            Name:<input type="text" name="deviceName1" value="<?=$itemInfo['deviceName']?>" />
            <br>
            <br>
            Type:<select name="deviceType1">
                    <option value="Action" <?=($itemInfo['deviceType']=='Action')?" selected":"" ?>  > Action </option>
                    <option value="Adventure" <?=($itemInfo['deviceType']=='Adventure')?" selected":"" ?>  > Adventure </option>
                    <option value="Simulation" <?=($itemInfo['deviceType']=='Simulation')?" selected":"" ?>  > Simulation </option>
                </select>
            <br>
            <br>
            Price: <input type="text" name="price1" value="<?=$itemInfo['price']?>"/>
            <br>
            <br>
            Status:<select name="status1">
                <option value="available" <?=($itemInfo['status']=='available')?" selected":"" ?>> Available </option>
                <option value="Not Available" <?=($itemInfo['status']=='Not Available')?" selected":"" ?>> Not Available </option>
                <option value="Out of Stock" <?=($itemInfo['status']=='Out of Stock')?" selected":"" ?>> Out of Stock </option>
            </select>
            <br>
            <br>
            Stock: <input type="text" name= "stock1" value="<?=$itemInfo['stock']?>"/>
            <br>
            <br>
            Rating: 
            <select name="rating1">
                <option value="0" <?=($itemInfo['rating']=='0')?" selected":"" ?>> 0 </option>
                <option value="1" <?=($itemInfo['rating']=='1')?" selected":"" ?>> 1 </option>
                <option value="2" <?=($itemInfo['rating']=='2')?" selected":"" ?>> 2 </option>
                <option value="3" <?=($itemInfo['rating']=='3')?" selected":"" ?>> 3 </option>
                <option value="4" <?=($itemInfo['rating']=='4')?" selected":"" ?>> 4 </option>
                <option value="5" <?=($itemInfo['rating']=='5')?" selected":"" ?>> 5 </option>
                <option value="6" <?=($itemInfo['rating']=='6')?" selected":"" ?>> 6 </option>
                <option value="7" <?=($itemInfo['rating']=='7')?" selected":"" ?>> 7 </option>
                <option value="8" <?=($itemInfo['rating']=='8')?" selected":"" ?>> 8 </option>
                <option value="9" <?=($itemInfo['rating']=='9')?" selected":"" ?>> 9 </option>
                <option value="10" <?=($itemInfo['rating']=='10')?" selected":"" ?>> 10 </option>
            </select>
            <br>
            <br>
            <input type="submit" value="Update Item" name="updateItem">
        </form>
        <br>
        <form action="admin.php">
                
                <input type="submit" value="Home" />
                
            </form>
        </div>
    </body>
</html>