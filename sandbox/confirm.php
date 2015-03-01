<?php
if (isset($_GET['url']) || empty($_GET['url'])) {
    throw new Exception('Url is not defined.');
}
$query = parse_url($url, PHP_URL_QUERY);
$queryPrefix = ($query) ? '&' : '?';
$articleUrlYes = sprintf('%s%swn_purchase_id=%s&wn_token=%s', $url, $queryPrefix, $articleId, $token);
$articleUrlInvalid = sprintf('%s%swn_purchase_id=00000000&wn_token=invalidToken', $url, $queryPrefix);
$articleUrlNo = $url;
$isPurchased = substr($_GET['url'], -10) === '#purchased';
$currentPageUrl = full_url($_SERVER);

if ($isPurchased) {
    $response = '<h1>Dostęp przyznany, otwieranie strony z artykułem...</h1>';
    $response .= '<a href="' . $url . '">Przejź jeśli artykuł nie został wczytany &raquo;</a>';
    $response .= '<script> window.opener.location = "' . $articleUrlYes . '"; window.close();</script>';
    exit;
}
?>
    <h1>WebnalistPopup Sandbox</h1>
    <h2>Do you want to read article?</h2>
    <form>
        <center>
            <a href="<?php echo $articleUrlYes; ?>">
                <button>Yes</button>
            </a>
            &nbsp; &nbsp; &nbsp; &nbsp;
            <a href="<?php echo $articleUrlNo; ?>">
                <button>No</button>
            </a>
            &nbsp; &nbsp; &nbsp; &nbsp;
            <a href="<?php echo $articleUrlInvalid; ?>">
                <button>Invalid</button>
            </a>
        </center>
    </form>

<?php
/**
 * http://stackoverflow.com/a/8891890
 * @param $s
 * @param bool $use_forwarded_host
 * @return string
 */
function url_origin($s, $use_forwarded_host = false)
{
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true : false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
    $host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url($s, $use_forwarded_host = false)
{
    return url_origin($s, $use_forwarded_host) . $s['REQUEST_URI'];
}

?>