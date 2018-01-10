<html>
<body>
<form id="form1" action="post">
Filter by<br>
NAME  : <input name='name' type='text' value="<?php if (isset($_REQUEST["name"])) echo $_REQUEST["name"];?>"></input>
BRAND  : <input name='producer' type='text' value="<?php if (isset($_REQUEST["producer"])) echo $_REQUEST["producer"];?>"></input>
TYPE  : <input name='type' type='text' value="<?php if (isset($_REQUEST["type"])) echo $_REQUEST["type"];?>"></input><br>
PRICE from  : <input name='pricefrom' type='text' value="<?php if (isset($_REQUEST["pricefrom"])) echo $_REQUEST["pricefrom"];?>"></input>
to  : <input name='priceto' type='text' value="<?php if (isset($_REQUEST["priceto"])) echo $_REQUEST["priceto"];?>"></input><br>
DATE from  : <input name='datefrom' type='date' value="<?php if (isset($_REQUEST["datefrom"])) echo $_REQUEST["datefrom"];?>"></input>
to  : <input name='dateto' type='date' value="<?php if (isset($_REQUEST["dateto"])) echo $_REQUEST["dateto"];?>"></input><br>
</pre>

<input type="submit" value="Search"></input>
<script>
function pageIdChanged(elem, direction) {
  var pageId = document.querySelector('input[name=pageid]');
  var strvalue = pageId.getAttribute('value');
  var value = parseInt(strvalue);
  if ("" + value != strvalue || value <= 0) {
    value = 1;
  } else {
    var pageCount = parseInt(document.querySelector("#pagecount").innerHTML);
    if (value > pageCount) {
      value = pageCount;
    } else {
      switch (direction) {
        case 'left' : if (value > 1) value = value - 1; break;
        case 'right': if (value < pageCount) value = value + 1; break;
        default: alert('bug'); 
      }      
    }
  }
  pageId.setAttribute('value', value);
  elem.form.submit();
}
</script>
<input type="button" name="left" value="<" onclick="pageIdChanged(this, 'left');"></input>
<input type="text" name="pageid" value="<?php if (isset($_REQUEST["pageid"])) echo $_REQUEST["pageid"]; else echo "1" ?>" style="width:30px"></input>
<input type="button" name="right" value=">" onclick="pageIdChanged(this, 'right');"></input>
<label for="pageid"> / <span id="pagecount" style="color:blue">1</span></label>

<input type="hidden" name="sortBy" value="<?php if (isset($_REQUEST["sortBy"])) echo $_REQUEST["sortBy"]; else echo "regdate" ?>"></input>

</form>

<?php require 'db_info.php'; ?>

<script>
function sortBy(colname) {
  var elem = document.querySelector("input[name='sortBy']");
  elem.setAttribute('value', colname);
  elem.form.submit();
}
</script>

<table border=1>
  <tr>
  <?php
  foreach ($colnames as $name) {
    echo "<th><a href='#' onclick='sortBy(\"" . $name . "\"); return false;'>" . $name . "</a></th>";
  }
  ?>
  </tr>
<?php
try {
  $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbuserpass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //
  $filter = "";
  $filterParams = array();
  foreach ($colnames as $name) {
    if (isset($_REQUEST[$name]) && !empty($_REQUEST[$name])) {
      $filterParams[]="%" . $_REQUEST[$name] . "%";
      $filter .= " and $name like ?";
    }
  }
  if (isset($_REQUEST['pricefrom'])) {
    $strPriceFrom = $_REQUEST['pricefrom'];
    $priceFrom = intval($strPriceFrom);
    if ("" . $priceFrom == $strPriceFrom) {
      $filter .= " and price >= $strPriceFrom";
    }
  }
  if (isset($_REQUEST['priceto'])) {
    $strPriceTo = $_REQUEST['priceto'];
    $priceTo = intval($strPriceTo);
    if ("" . $priceTo == $strPriceTo) {
      $filter .= " and price <= $strPriceTo";
    }
  }
  if (isset($_REQUEST['datefrom']) && !empty($_REQUEST['datefrom']))
    $filter .= " and regdate >= '" . $_REQUEST['datefrom'] . "'";
  if (isset($_REQUEST['dateto']) && !empty($_REQUEST['dateto'])) {
    $date = strtotime($_REQUEST['dateto']);
    $tomorrow = strtotime("+1 day", $date);
    $newformat = date('Y-m-d',$tomorrow);
    $filter .= " and regdate < '" . $newformat . "'";
  }
  if (!empty($filter)) $filter = " WHERE" . substr($filter, 4);

  //
  if (isset($_REQUEST["sortBy"]))
    $sortBy = "ORDER BY " . $_REQUEST["sortBy"] . " asc";
  else
    $sortBy = "ORDER BY regdate desc";
  $sql = "SELECT * FROM $gentablename" . $filter . " " . $sortBy;
  //echo $sql . "!!!";
  $stmt = $conn->prepare($sql);
  $stmt->execute($filterParams);
  $row_count = $stmt->rowCount();

  //
  $pageCount = ceil($row_count / $rowsperpage);
  ?><script>document.querySelectorAll("#pagecount")[0].innerHTML = <?php
  echo $pageCount;
  ?>;</script><?php

  //
  if (isset($_REQUEST['pageid'])) $pageId = intval($_REQUEST['pageid']); else $pageId = 1;
  if ($pageId < 1) $pageId = 1; else if ($pageId > $pageCount) $pageId = $pageCount;
  if (!isset($_REQUEST['pageid']) || $pageId . "" != $_REQUEST['pageid']) {
    ?><script>
    document.querySelector("input[name=pageid]").setAttribute('value', <?php echo $pageId; ?>);
    </script><?php
  }
  $sql= $sql . " LIMIT " . (($pageId - 1) * $rowsperpage) . ", 10";
  $stmt = $conn->prepare($sql);
  $stmt->execute($filterParams);
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach ($stmt->fetchAll() as $k => $v) {
    echo "<tr>";
    foreach ($v as $nk => $nv) {
      if ($nk != "id") {
        echo "<td>$nv</td>";
      }
    }
    echo "</tr>";
  }
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>
</table>

<hr><?php
echo "<h6>Request info: "; print_r($_REQUEST); echo "</h6>";
?>
</body>
</html>