<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Dashboard Guys</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <?php echo $this->Html->link('User Profile', array('controller' => 'users', 'action' => 'view_profile'), array('class' => 'nav-link')); ?>
                        </li>
                        <li class="nav-item">
                            <?php echo $this->Html->link('Messages', array('controller' => 'messages', 'action' => 'inbox'), array('class' => 'nav-link')); ?>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'), array('class' => 'nav-link')); ?>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-content">
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
    </div>
</div>
