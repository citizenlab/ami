<?php
$token = hash('sha256', uniqid(rand(), TRUE));
$_SESSION['ami_stats_token'] = $token;
$_SESSION['ami_stats_token_time'] = time();
print "amiApp.stats.token = \"" .$token ."\"";