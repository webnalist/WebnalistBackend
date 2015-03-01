<?php
define('PAGE_URL', 'http://demo.webnalist.com'); //your demo page host, skip / on the end
define('WN_KEY_PUBLIC', 'xxx'); //your webnalist brand public key
define('WN_KEY_PRIVATE', 'xxx'); //your webnalist brand private key

/**
 * You can test without adding articles to Webnalist database.
 * If you add at the end of the article url #purchased and call in sandbox mode,
 * we send to your service purchased response in other case you receive unpaid response.
 *
 * In production mode hash on the end of url is ignored.
 */
define('SANDBOX_MODE', true);

include_once('../../WebnalistBackend.php');

?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Webnalist Merchant Demo Store</title>
</head>
<body>