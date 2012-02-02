<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Dweet</title>
  <meta name="description" content="a simple twitter clone">
  <meta name="author" content="ajo@mydevnull.net">

  <link rel="stylesheet" href="<?php echo Dweet_Helper::baseurl() ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo Dweet_Helper::baseurl() ?>/css/excite-bike/jquery-ui-1.8.17.custom.css">
</head>

<body>
    <div id="container">
        <header>
            <div class="center">
                <h1>
                    <a href="<?php echo Dweet_Helper::baseurl() ?>/page/home">Dweet</a>
                </h1>
                <div id="menu">
                    <a href="<?php echo Dweet_Helper::baseurl() ?>/page/home">Home</a>
                    <a href="<?php echo Dweet_Helper::baseurl() ?>/page/about">About</a>
                </div>
            </div>
        </header>
        <div id="main" class="center">
            <?php echo $content ?>
        </div>
        <footer>
            <div class="center">
                <a href="http://mydevnull.net" target="_blank">~/dev/null</a>
            </div>
        </footer>
    </div>
    <script src="<?php echo Dweet_Helper::baseurl() ?>/js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo Dweet_Helper::baseurl() ?>/js/jquery-ui-1.8.17.custom.min.js"></script>
    <script src="<?php echo Dweet_Helper::baseurl() ?>/js/jquery.simplyCountable.js"></script>
    <script type="text/javascript">
        //we define here the parameters that are required in the js/app.js file

        var baseurl = '<?php echo Dweet_Helper::baseurl() ?>';
    </script>
    <script src="<?php echo Dweet_Helper::baseurl() ?>/js/app.js"></script>
</body>
</html>

