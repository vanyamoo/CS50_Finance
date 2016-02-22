<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Passwords do not match!");
        }
        
        // add user to database
        $result = query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));
        if ($result === false)
        {
            apologize("This username already exists.");
        }
        
        // find out user's id
        $rows = query("SELECT LAST_INSERT_ID() AS id"); 
        $id = $rows[0]["id"];
        
        // store user's id in session
        $_SESSION["id"] = $row["id"];
        
        // redirect to index.php
        redirect("/");
        
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

?>
