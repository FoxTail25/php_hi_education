<?php
function createDate($year) {
   return date_create("$year-01-01");
}
$diff = date_diff(createDate($year1), createDate($year2));
echo $diff->format('%a дней');
?>