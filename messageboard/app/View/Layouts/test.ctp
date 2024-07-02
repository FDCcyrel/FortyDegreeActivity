<!-- In your default.ctp layout or equivalent -->
<!DOCTYPE html>
<html>
<head>
    <!-- Include Bootstrap CSS -->
    <?php echo $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'); ?>
    <?php echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'); ?>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
    <!-- Include any custom CSS files or styles here -->
</head>
<body>
    <?php echo $this->fetch('content'); ?>
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- Include your custom JS scripts here -->
    <?php echo $this->fetch('script'); ?>
</body>
</html>
