<div class = "container">
    <table class = "table table-striped">
        <tr>
            <td><b><?= 'Transaction' ?></b></td>
            <td><b><?= 'Date/Time' ?></b></td>
            <td><b><?= 'Symbol' ?></b></td>
            <td><b><?= 'Shares' ?></b></td>
            <td><b><?= 'Price' ?></b></td>
        </tr>
    
        <?php foreach ($positions as $position): ?>

            <tr>
                <td><?= $position["transaction"] ?></td>
                <td><?= $position["time"] ?></td>
                <td><?= $position["symbol"] ?></td>
                <td>$<?= $position["shares"] ?></td>
                <td>$<?= $position["price"] ?></td>
            </tr>

        <? endforeach ?>
        
    </table>
</div>

