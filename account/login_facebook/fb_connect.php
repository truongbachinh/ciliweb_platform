<?php

include "Facebook/autoload.php";
include "fb_config.php";
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional permission
$loginUrl = $helper->getLoginUrl('https://ciliweb.vn/ciliweb_platform/account/login_facebook/fb-callback.php', $permissions);
