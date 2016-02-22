<div class = "container">
    <ul class="nav nav-pills">
        <li>
            <a href="quote.php">Quote</a>
        </li>
        <li>
            <a href="buy.php">Buy</a>
        </li>
        <li>
            <a href="sell.php">Sell</a>
        </li>
        <li>
            <a href="history.php">History</a>
        </li>
        <li>
            <a href="logout.php">Logout</a>
        </li>
    </ul>    
    <table class = "table table-striped">
        <tr>
            <td><b><?= 'Symbol' ?></b></td>
            <td><b><?= 'Name' ?></b></td>
            <td><b><?= 'Shares' ?></b></td>
            <td><b><?= 'Price' ?></b></td>
            <td><b><?= 'TOTAL' ?></b></td>
        </tr>
    
        <?php foreach ($positions as $position): ?>

            <tr>
                <td><?= $position["symbol"] ?></td>
                <td><?= $position["name"] ?></td>
                <td><?= $position["shares"] ?></td>
                <td>$<?= $position["price"] ?></td>
                <td>$<?= $position["TOTAL"] ?></td>
            </tr>

        <? endforeach ?>
        
        <tr>
            <td><b><?= 'CASH' ?></b></td>
            <td><b><?= '' ?></b></td>
            <td><b><?= '' ?></b></td>
            <td><b><?= '' ?></b></td>
            <td><b>$<?= 10000/*$positions["CASH"]*/ ?></b></td>
        </tr>
    </table>
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>
