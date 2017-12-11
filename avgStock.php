<?php

    include 'database.php';
    $conn = getDatabaseConnection();
    
    $sql = "SELECT AVG(stock) FROM vgaction";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $avg = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = "SELECT AVG(stock) FROM vgadventure";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $avg2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = "SELECT AVG(stock) FROM vgsimulation";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $avg3 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $realAvg = ($avg[0]['AVG(stock)'] + $avg2[0]['AVG(stock)'] + $avg3[0]['AVG(stock)'])/3;
    
    print $realAvg;


?>

