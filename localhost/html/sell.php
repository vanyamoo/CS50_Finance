<?php

    // configuration
    require("../includes/config.php"); 
    
    // query the portfolio
    $st = query("SELECT symbol, shares FROM portfolios WHERE id = ?", $_SESSION["id"]);
    
    // retrieve stock
    $stock = lookup($st["symbol"]);

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {  
   
        // delete stock from user's portfolio
        query("DELETE FROM portfolios WHERE id = ? AND symbol = ?", $_SESSION["id"], $st["symbol"]);
          
        // update cash
        query("UPDATE users SET cash = cash + (? * ?) WHERE id = ?", number_format($stock["price"],2,'.',''), $_POST["shares"], $_SESSION["id"]);  
        
        // update history
        query("INSERT INTO history (time, symbol, transactions, shares, price) VALUES (?, ?, ?) WHERE id = ?", CURRENT_TIMESTAMP, $st["symbol"], "SELL", $_POST["shares"], $stock["price"] * $_POST["shares"], $_SESSION["id"]);
        
        // redirect to index.php  
        redirect("/"); 
        
    }
    else
    {
        // render form
        render("sell_form.php", $stock);
    }  

?>
