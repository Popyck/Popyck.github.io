<?php
$theme_id='';    //Необходимо из базы получить и указать id темы
$ip=$_SERVER['REMOTE_ADDR'];
$time=time();

$res=mysqli_query($db,"SELECT count(id) FROM visit_theme WHERE
    id_theme_visit='".$theme_id."' and ip_visit=INET_ATON('".$ip."') and
    date_visit>'".($time-86400)."' LIMIT 1");
$count_id=mysqli_fetch_array($res);
if ($count_id[0]==0) {
 $res=mysqli_query($db,"UPDATE all_theme SET visits=(visits+1) WHERE
    id='".$theme_id."' LIMIT 1");
 $res=mysqli_query($db,"INSERT INTO visit_theme (id_theme_visit,ip_visit,date_visit)
    VALUES ('".$theme_id."',INET_ATON('".$ip."'),'".$time."')");
}
?>
