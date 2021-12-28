<?php
$directoryURI =basename($_SERVER['SCRIPT_NAME']);
if(intval($_SESSION['Session_AdminStaff_ID']) == 0 && ($directoryURI != 'changepassword.php') || !isset($_SESSION["PermissionsList"]) || !isset($_SESSION["PmVal"])){
	Header("Location: loginfrm.php");
}
?>
