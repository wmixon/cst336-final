<?php

    include 'database.php';
    $conn = getDatabaseConnection();
    
    $sql = "SELECT AVG(price) FROM vgaction";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $avg = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = "SELECT AVG(price) FROM vgadventure";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $avg2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = "SELECT AVG(price) FROM vgsimulation";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $avg3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $realAvg = ($avg[0]['AVG(price)'] + $avg2[0]['AVG(price)'] + $avg3[0]['AVG(price)'])/3;
    
    print $realAvg;


?>

