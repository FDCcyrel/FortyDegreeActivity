<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Message Board</title>
  <link rel="icon" type="image/png" href="/icon/icon.png">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="/app/webroot/css/style.css" rel="stylesheet"> 
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
        <?php
        // Check for authentication errors and display if any
        if ($this->Session->check('Message.auth')) :
            echo '<div class="alert alert-danger">' . $this->Session->flash('auth') . '</div>';
        endif;
        ?>

        <h1>Welcome to the Message Board GWAPO</h1>
        <p class="lead">Please log in or register to continue.</p>
        <div>
        <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'loginview')); ?>" class="btn btn-primary btn-lg btn-custom">Log In</a>
        <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'usersave')); ?>" class="btn btn-secondary btn-lg btn-custom">Register</a>
        </div>
      </div>
    </div>
  </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
