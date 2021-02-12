<?php
require("config.php");

//Element
$resAllEle = mysqli_query($con, "SELECT * FROM t_element_ele NATURAL JOIN tj_relie_rel NATURAL JOIN t_selection_sel ORDER BY ele_numero DESC");

?>
