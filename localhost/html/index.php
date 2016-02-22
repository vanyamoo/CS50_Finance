<?php

    // configuration
    require("../includes/config.php"); 
    
    // query the portfolio
    $rows = query("SELECT symbol, shares FROM portfolios WHERE id = ?", $_SESSION["id"]);
    
    // query the users' database for cash
    $cash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    
    // create an array of associative arrays, each of which represents a position (i.e., a stock owned)
    $positions = [];
    //$accum = 0;
    foreach ($rows as $row)
    {
        // look up stock
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "TOTAL" => ($stock["price"] * $row["shares"]),
                "CASH" => $cash/*$stock["price"] * $row["shares"] + $accum*/,
                "symbol" => $row["symbol"]    
            ];   
        //$accum = $positions["TOTAL"]; 
        //dump($positions["CASH"]);  
        } 
        //$accum = $stock["price"] * $row["shares"];
    }
    
    //dump($cash);
    // render portfolio
    render("portfolio.php", ["positions" => $positions, "title" => "Portfolio"]);
?>
