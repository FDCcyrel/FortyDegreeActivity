
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title_for_layout; ?></title>
    
    <?php echo $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'); ?>
    <?php echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'); ?>
    <?php echo $this->Html->css('styles.css'); ?>
    <?php 
    echo $this->Html->css('register.css'); 
    echo $this->Html->meta('icon');
    echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js');
    echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js');
    echo $this->Html->script('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js');
    ?>
    
</head>
<body>
    <div class="container">
        <?php echo $this->fetch('error-message'); ?>
        <?php echo $this->fetch('content'); ?>
    </div>
    
    <?php echo $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'); ?>
    

</body>
</html>
