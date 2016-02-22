<form action="sell.php" method="post">
    <fieldset>
        <div class="control-group">
            <select name="symbol">
                    <option value=''></option>
                <?php foreach ($positions as $position): ?>
                   
                    <?php printf("<option value=?>?</option> ", $symbol, $symbol) ?>
                    
                <? endforeach ?>    
                           
            </select>
        </div>
        <div class="control-group">
            <button type="submit" class="btn">Sell</button>
        </div>
    </fieldset>
</form>


