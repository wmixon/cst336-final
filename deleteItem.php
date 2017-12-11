<?php

    include 'database.php';
    $conn = getDatabaseConnection();
    
    $sql = "DELETE FROM vgaction WHERE id = " . $_GET['itemId'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $sql = "DELETE FROM vgadventure WHERE id = " . $_GET['itemId'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $sql = "DELETE FROM vgsimulation WHERE id = " . $_GET['itemId'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    header("Location: admin.php");



?>