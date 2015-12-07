# WebnalistBackend
Php library to fast integration WebnalistPayment on the merchant store.

## References
* Works together with [WebnalistFrontend](https://github.com/webnalist/WebnalistFrontend)
* Demo page: http://demo.webnalist.com

## Sample usage
```php
<?php
include_once('WebnalistBackend.php');
$isPurchased = false;
$error = false;
$wnPublicKey = ''; //Merchant public key
$wnSecretKey = ''; //Merchant private key
$currentArticleUrl = ''; //Article url (identifier on webnalist.com)
$webnalist = new WebnalistBackend($wnPublicKey, $wnSecretKey);

try {
  $isPurchased = $webnalist->canRead($currentArticleUrl);
} catch (WebnalistException $we) {
  $error = $we->getMessage();
} catch (Exception $e) {
  $error = 'Error occurred.'
}

$view = 'RENDER INTRO WITH READ MORE BUTTON';

if($error){
  $view .= $error; //show error
}

if ($isPurchased) { 
  $view .= 'RENDER FULL ARTICLE'; //article is purchased, access approved
} else { // article is not purchased
  $view .= '<a href="' . $currentArticleUrl . '" class="wn-link">Buy Now</a>'; //render buy now button
}

echo $view;
```

##Demo
------
You can run demo with selfhosted sandbox mode.

```bash
git clone https://github.com/webnalist/WebnalistBackend.git
cd WebnalistBackend
git submodule update --init --recursive
cd demo
cp conf.php.dist conf.php
```

Setup demo/conf.php Authorization keys in sandbox mode are ignored.
