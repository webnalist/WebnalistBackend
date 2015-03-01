<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Webnalist Merchant Demo Store</title>
</head>
<body>

<?php
include_once('conf.php');
include_once('../WebnalistBackend.php');

//demo data
$articleId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$receivePurchasedResponse = ($articleId == 1) ? true : false; //first article in sandbox mode is purchased
$currentArticleUrl = PAGE_URL . '/article.php?id=' . $articleId . '#purchased';
$title = '<h1>' . str_repeat($articleId, rand(10, 20)) . '</h1>';
$lead = '<p>Lead for article #' . $articleId . ' Eu leo sem velit, odio nam ipsum, molestie commodo mauris quis iaculis nisl integer . Feugiat egestas orci auctor, viverra nec orci nullam, rutrum bibendum cursus vulputate viverra aliquam dignissim sodales . Convallis nam ligula molestie nam lacinia neque augue cras massa porta porttitor; Scelerisque erat dui aliquam bibendum . Aliquam curabitur quam eu etiam egestas quam pellentesque venenatis tincidunt augue pellentesque feugiat est curabitur augue cras augue .</p>';
$fullText = '<hr><p><strong>Full text of article #' . $articleId . '</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p>
<h2>Header Level 2</h2><ol><li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li><li>Aliquam tincidunt mauris eu risus.</li></ol>';
$purchasedInfo = '<p><strong>Artykuł kupiony przez <a href="https://webnalist.com" target="_blank">Webnalist.com</a></strong></p>';
$purchaseUrl = sprintf('<p><a href="#" data-wn-url="%s" class="wn-read">Przeczytaj całość z Webnalist.com</a></p>',
    urlencode($currentArticleUrl));

//Inicjowanie usługi Webnalist w trybie sandbox i debug
$webnalist = new WebnalistBackend(WN_KEY_PUBLIC, WN_KEY_PRIVATE, true, true);
$webnalist->setUrl(PAGE_URL); //only for sandbox, skip this on production mode
$isPurchased = false;
$error = null;
try {
    //Call webnalist service and ask if article is purchased
    $isPurchased = $webnalist->canRead($currentArticleUrl);
} catch (WebnalistException $we) {
    $error = $we->getMessage();
}

//is purchased, return full article
if ($isPurchased && !$error) {
    $view = $title;
    $view .= $purchasedInfo;
    $view .= $lead;
    $view .= $fullText;
//is not purchased, return lead, purchase link and error if occurred
} else {
    $view = $title;
    $view .= $lead;
    $view .= $purchaseUrl;
    if ($error) {
        $view .= sprintf('<p class="error">%s</p>', $error);
    }
}

//show article
echo $view;

?>

<script>
    (function (d, s, wn) {
        window['WN'] = wn;
        wn.readyFn = wn.readyFn || [];
        wn.ready = function (fn) {
            wn.readyFn.push(fn);
        };
        var wns = d.createElement(s);
        wns.async = true;
        wns.src = 'js/webnalist.min.js'; //Make sure the path is correct.
        wns.onload = function () {
            wn.executeReady && wn.executeReady();
        };
        var tag = document.getElementsByTagName("script")[0];
        tag.parentNode.insertBefore(wns, tag);
    })(document, 'script', window['WN'] || {});
</script>
<script>
    WN.options = {
        loadPrices: true, //load prices
        readArticleUrl: '<?php echo PAGE_URL ?>/sandbox/confirm.php', //only for sandbox, remove this on production mode
        loadPricesUrl: '<?php echo PAGE_URL ?>/sandbox/prices.php' //only for sandbox, remove this on production mode
    };
</script>
</body>
</html>