<html>
  <head>
    <title> <?=$this->siteTitle(); ?> </title>
    <link rel="stylesheet" type="text/css" href="<?=PROOT?>public/css/gen.css" />
    <link rel="stylesheet" type="text/css" href="<?=PROOT?>public/css/app.css" />
    <script type="text/javascript" src="<?=PROOT?>public/js/app.js"></script>
    <?= $this->content('head') ?>
  </head>

  <body>
  
    <?= $this->content('body') ?>

  </body>
</html>
