<?php
$mainpeotocal = (!empty($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off')?'https://':'http://';
define ("_APP_KEY_",	'QwEaSdZxC0EDU');// remark
define ("_PROJECTNAME_",	'oyura');
define ("_DATABASE_KEY_",	'==AdsJzYsJ1VkxHdsJzYsJ1VkxXPjFzYopFRUJjTH5Ef0xmMjxmUXRGf0xmMjxmUXRGf90zdNpXQq5EfzljMZhGeHFmdOhEZ81TPRV1MWVVWUJVbXRjTF1kRSVlV');// remark
define ("_HTTP_PATH_", "/"._PROJECTNAME_);
define ("_SYSTEM_ROOTPATH_","/"._PROJECTNAME_);
define ("_SYSTEM_DIRROOTPATH_", $_SERVER['DOCUMENT_ROOT']. "/"._PROJECTNAME_);//$_SERVER['DOCUMENT_ROOT'].
define ("_HTTP_PATH_UPLOAD_",$mainpeotocal.$_SERVER["SERVER_NAME"].'/'._PROJECTNAME_."/upload");
include(_SYSTEM_DIRROOTPATH_."/lib/inc.session.php");
include(_SYSTEM_DIRROOTPATH_."/lib/inc.functiondecode.php");
include(_SYSTEM_DIRROOTPATH_."/lib/inc.configpath.php");
include(_SYSTEM_DIRROOTPATH_."/lib/inc.configdb.php");
include(_SYSTEM_DIRROOTPATH_."/lib/inc.configtable.php");
include(_SYSTEM_DIRROOTPATH_."/lib/"._DB_TYPE_.".php");
include(_SYSTEM_DIRROOTPATH_."/lib/inc.configtitle.php");
include(_SYSTEM_DIRROOTPATH_."/lib/inc.configmail.php");
include(_SYSTEM_DIRROOTPATH_."/lib/inc.configother.php");
include(_SYSTEM_DIRROOTPATH_."/lib/function.php");

?>
