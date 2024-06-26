<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $this->fetch('title'); ?></title>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include jQuery and jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom styles -->
    <style>
        body {
            padding-top: 50px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .form-control-file {
            overflow: hidden;
        }
        .preview-container {
            margin-top: 10px;
        }
        .preview-container img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Profile Form</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'first'), array('class' => 'nav-link')); ?>
                </li>
                <li class="nav-item">
                    <?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index'), array('class' => 'nav-link')); ?>
                </li>
                <li class="nav-item">
                    <?php echo $this->Html->link('User Profiles', array('controller' => 'user_profiles', 'action' => 'index'), array('class' => 'nav-link')); ?>
                </li>
               
            </ul>
        </div>
    </div>
</nav>

<main role="main">
    <div class="container">
    <?php echo $this->fetch('error-message'); ?>
        <?php echo $this->fetch('content'); ?>
    </div>
</main>

<!-- Scripts and any additional JavaScript -->
<?php echo $this->fetch('script'); ?>

</body>
</html>
