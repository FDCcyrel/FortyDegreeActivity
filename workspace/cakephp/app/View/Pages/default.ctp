
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title_for_layout; ?></title>
    
    <?php echo $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'); ?>
    <?php echo $this->Html->css('styles.css'); ?>
    
    
</head>
<body>
    <div class="container">
        <?php echo $this->fetch('content'); ?>
    </div>
    
    <?php echo $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'); ?>
   
</body>
</html>
