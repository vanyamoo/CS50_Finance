<?php

    // configuration
    require("../includes/config.php"); 
    
    // query history
    $rows = query("SELECT * FROM history WHERE id = ?", $_SESSION["id"]);
    
    // create an array of associative arrays, each of which represents a position (i.e., a stock owned)
    $positions = [];
    //$accum = 0;
    foreach ($rows as $row)
    {
        if ($stock !== false)
        {
            $positions[] = [
                "transaction" => $row["transaction"],
                "time" => $row["time"],
                "symbol" => $row["symbol"],
                "shares" => $row["shares"],
                "price" => $row["price"]   
            ];    
        }
    }
    // render portfolio
    render("show_history.php", ["positions" => $positions, "title" => "History"]);
?>
