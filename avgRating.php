<?php

    include 'database.php';
    $conn = getDatabaseConnection();
    
    $sql = "SELECT AVG(rating) FROM vgaction";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $avg = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = "SELECT AVG(rating) FROM vgadventure";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $avg2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = "SELECT AVG(rating) FROM vgsimulation";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $avg3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $realAvg = ($avg[0]['AVG(rating)'] + $avg2[0]['AVG(rating)'] + $avg3[0]['AVG(rating)'])/3;
    
    print $realAvg;


?>

