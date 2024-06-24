<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title_for_layout; ?></title>

    <!-- Bootstrap CSS -->
    <?php echo $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'); ?>
    <?php echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'); ?>

    <!-- Select2 CSS -->
    <?php echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css'); ?>
    
    <!-- Custom CSS -->
    <?php echo $this->Html->css('styles.css'); ?>
    <?php echo $this->Html->css('register.css'); ?>

    <!-- jQuery -->
    <?php echo $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js'); ?>

    <!-- Bootstrap JS (3.4.1 is loaded after 4.5.2, ensure compatibility) -->
    <?php echo $this->Html->script('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'); ?>
    <?php echo $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'); ?>
    
    <!-- Select2 JS -->
    <?php echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js'); ?>

    <!-- jQuery UI -->
    <?php echo $this->Html->script('https://code.jquery.com/ui/1.13.0/jquery-ui.min.js'); ?>
    <?php echo $this->Html->css('https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css'); ?>

    <?php echo $this->Html->meta('icon'); ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light col-md-6">
                <a class="navbar-brand" href="#">Message List</a>
            </nav>
            <div class="col-md-6 text-right">
                <p>
                    <?php echo $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout'], ['class' => 'nav-link']); ?>
                </p>
            </div>
        </div>

        <div id="content">
           
            <?php echo $this->fetch('content'); ?> 
            <hr>
            <footer>
                <p>&copy; <?php echo date('Y'); ?> Forty Degree Celcius Inc.</p>
            </footer>
        </div>
    </div>

    <div id="loading-indicator" style="display:none;">
        <img src="<?php echo $this->Html->url('/img/loading.gif'); ?>" alt="Loading...">
    </div>

    <?php echo $this->Html->script('scripts'); ?>
</body>
</html>
