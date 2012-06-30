<?php

header('Content-type: text/css');

include('../../../../wp-config.php'); 

$file = '../plugin.php'

?>

@font-face {
  font-family: "FontAwesome";
  src: url('<?= plugins_url('/font/fontawesome-webfont.eot', __FILE__ ); ?>');
  src: url('<?= plugins_url('/font/fontawesome-webfont.eot?#iefix', __FILE__ ); ?>') format('eot'), url('<?= plugins_url( '/font/fontawesome-webfont.woff', __FILE__ ); ?>') format('woff'), url('<?= plugins_url('/font/fontawesome-webfont.ttf', __FILE__ ); ?>') format('truetype'), url('<?= plugins_url('/font/fontawesome-webfont.svg#FontAwesome', __FILE__ ); ?>') format('svg');
  font-weight: normal;
  font-style: normal;
}