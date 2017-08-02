<?php 
include './config/init.php';

$sql = "select * from poetries where title='李白'";
$res = mysqli_query($link, $sql);s
$a  = mysqli_fetch_array($res);
while ($a) {
    echo $a;
}
 ?>
