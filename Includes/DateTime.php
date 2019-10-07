<?php
date_default_timezone_get("Asia/Seoul");
$CurrentTime = time();
$DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
echo $DateTime
?>