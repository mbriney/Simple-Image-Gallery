<?php
mysql_connect("yourhost", "mysqllogin", "mysqlpass") or die(mysql_error());
mysql_select_db("yourdatabase") or die(mysql_error());

date_default_timezone_set('America/New_York');

?>