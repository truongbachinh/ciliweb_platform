<?php

include "../login_facebook/Facebook/autoload.php";
include "../login_facebook/fb_config.php";
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional permission
//callback login truc tiep bang faceboooks
$loginUrl = $helper->getLoginUrl('https://ciliweb.vn/ciliweb_platform/login_facebook/fb-callback.php', $permissions);
