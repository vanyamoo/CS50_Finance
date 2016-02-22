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
        if (lookup($_POST["symbol"]) == false)
        {
            apologize("You must provide a valid symbol.");
        }
        
        // retrieve stock
        $stock = lookup($_POST["symbol"]);
        //dump($stock);
        
        // display stock quote 
        render("show_quote.php", $stock); 
        
    }
    else
    {
        // render form
        render("quote_form.php", ["title" => "Stock Symbol"]);
    }

?>
