<script type="text/javascript" src="/js/utils.js"></script>
<form id="form1" method="post">
    Filter by<br>
    NAME  : <input       name='name'      type='text'   value="<?php echo $this->form["name"];     ?>"/>
    BRAND  : <input      name='producer'  type='text'   value="<?php echo $this->form["producer"]; ?>"/>
    TYPE  : <input       name='type'      type='text'   value="<?php echo $this->form["type"];     ?>"/><br>
    PRICE from  : <input name='pricefrom' type='number' value="<?php echo $this->form["pricefrom"];?>"/>
    to  : <input         name='priceto'   type='number' value="<?php echo $this->form["priceto"];  ?>"/><br>
    DATE from  : <input  name='datefrom'  type='date'   value="<?php echo $this->form["datefrom"]; ?>"/>
    to  : <input         name='dateto'    type='date'   value="<?php echo $this->form["dateto"];   ?>"/><br>
    </pre>

    <input type="submit" value="Search"/>
    <input type="button" name="left" value="<" onclick="pageIdChanged(this, 'left');"/>
    <input type="text" name="pageid" value="<?php echo $this->form["pageid"]; ?>" style="width:40px"/>
    <input type="button" name="right" value=">" onclick="pageIdChanged(this, 'right');"/>
    <label for="pageid"> / <span id="pagecount" style="color:blue">1</span></label>

    <input type="hidden" name="sortBy" value="<?php echo $this->form["sortBy"]; ?>"/>

</form>

<table border=1>
    <tr>
        <?php
        foreach ($this->colnames as $name) {
            echo "<th><a href='#' onclick='sortBy(\"" . $name . "\"); return false;'>" . $name . "</a></th>";
        }
        ?>
    </tr>
    <script>document.querySelectorAll("#pagecount")[0].innerHTML = <?php echo $this->pageCount; ?>;</script>
    <?php
    if ($this->pageId . "" != $this->form["pageid"]) {
        ?><script>
            document.querySelector("input[name=pageid]").setAttribute('value', <?php echo $this->pageId; ?>);
        </script><?php
    }
    foreach ($this->rows as $k => $v) {
        echo "<tr>";
        foreach ($v as $nk => $nv) {
            echo "<td>$nv</td>";
        }
        echo "</tr>";
    }
    ?>
</table>
<hr>
<form action="recreate_test_db.php">
    <span id="loading" style="display: none;">loading...</span>
    <input name="submit" type="submit" style="color:red" value="REGENERATE TEST DATABASE"
           onclick="document.getElementById('loading').style = 'block'; return true;"/>
</form>
