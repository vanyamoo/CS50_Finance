<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a stock symbol.");
        }
        else if (empty($_POST["shares"]))
        {
            apologize("You must provide number of shares.");
        }
        else if (lookup($_POST["symbol"]) == false)
        {
            apologize("You must provide a valid symbol.");
        }
        else if ( preg_match("/^\d+$/", $_POST["shares"]) == false)
        {
            apologize("You can only buy non-negative whole shares of stocks.");
        }
        
        // retrieve stock
        $stock = lookup($_POST["symbol"]);
        
        // query the users' database for enough cash
        $cash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        if ($cash <= $stock["price"] * $_POST["shares"])
        {
            apologize("You only have $?.", $cash);
        }
        
        
        // update stock to portfolio
        query("INSERT INTO portfolios (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $stock["symbol"], $_POST["shares"]);
           
        // update cash
        query("UPDATE users SET cash = cash - (? * ?) WHERE id = ?", number_format($stock["price"],2,'.',''), $_POST["shares"], $_SESSION["id"]);  
        
        // update history
        query("INSERT INTO history (time, symbol, transactions, shares, price) VALUES(?, ?, ?, ?, ?) WHERE id = ?", NOW(), $stock["symbol"], "BUY",$_POST["shares"], $stock["price"] * $_POST["shares"], $_SESSION["id"]);
        
        // redirect to index.php  
        redirect("/"); 
        
    }
    else
    {
        // render form
        render("buy_form.php", ["title" => "Buy"]);
    }

?>
