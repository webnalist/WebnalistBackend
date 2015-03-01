<?php
if (isset($_GET['url']) || empty($_GET['url'])) {
    throw new Exception('Url is not defined.');
}
$query = parse_url($url, PHP_URL_QUERY);
$queryPrefix = ($query) ? '&' : '?';
$articleUrlYes = sprintf('%s%swn_purchase_id=0&wn_token=%s', $url, $queryPrefix, 0, 'validToken');
$articleUrlInvalid = sprintf('%s%swn_purchase_id=0&wn_token=invalidToken', $url, $queryPrefix);
$articleUrlNo = $url;
$isPurchased = substr($_GET['url'], -10) === '#purchased';

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
    </form>
