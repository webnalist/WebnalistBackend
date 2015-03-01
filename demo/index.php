<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Webnalist Merchant Demo Store</title>
</head>
<body>

<h1>Webnalist Merchant Demo Store</h1>
<ul>
    <li class="wn-item" data-wn-url="http://demo.webnalist.com/article1.php#purchased">
        <a href="#">
            Purchased Article #1 Title <em>Price: <span class="wn-price">...</span> zł</em>
        </a>
    </li>
    <li class="wn-item" data-wn-url="http://demo.webnalist.com/article2.php">
        <a href="#">
            New Article #3 Title <em>Price: <span class="wn-price">...</span> zł</em>
        </a>
    </li>
    <li class="wn-item" data-wn-url="http://demo.webnalist.com/article3.php">
        <a href="#">
            New Article #3 Title <em>Price: <span class="wn-price">...</span> zł</em>
        </a>
    </li>
</ul>

<a href="#" class="wn-item" data-wn-url="http://demo.webnalist.com/article1.php?id=1#purchased">Or simple try read
    article #1 &raquo;</a>

<script>
    (function (d, s, wn) {
        window['WN'] = wn;
        wn.readyFn = wn.readyFn || [];
        wn.ready = function (fn) {
            wn.readyFn.push(fn);
        };
        var wns = d.createElement(s);
        wns.async = true;
        wns.src = '../webnalist.min.js'; //Make sure the path is correct.
        wns.onload = function () {
            wn.executeReady && wn.executeReady();
        };
        var tag = document.getElementsByTagName("script")[0];
        tag.parentNode.insertBefore(wns, tag);
    })(document, 'script', window['WN'] || {});
</script>
<script>
    WN.options = {
        loadPrices: true
    };
</script>
</body>
</html>