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
$articleUrl = ''; //Article url (identifier on webnalist.com)
$webnalist = new WebnalistBackend($wnPublicKey, $wnSecretKey);

try {
  $isPurchased = $webnalist->canRead($articleUrl);
} catch (WebnalistException $we) {
  $error = $we->getMessage();
} catch (Exception $e) {
  $error = 'Error occured.'
}

if ($isPurchased && !$error) { //article is purchased, access approved
  $view = 'RENDER FULL ARTICLE';
} else { //artile is not purchased or access denied
  $view = 'RENDER INTRO WITH READ MORE BUTTON';
  if ($error) {
    $view .= sprintf('<p class="error">%s</p>', $error); // PRINT ERROR
  }
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
