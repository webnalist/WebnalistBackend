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
        loadPrices: true, //load prices
        readArticleUrl: <?php echo PAGE_URL ?>'/sandbox/confirm.php', //only for sandbox, remove this on production mode
        loadPricesUrl: <?php echo PAGE_URL ?>'/sandbox/prices.php' //only for sandbox, remove this on production mode
    };
</script>
</body>
</html>