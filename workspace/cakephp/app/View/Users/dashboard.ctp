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
                        <!-- Account dropdown menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Account
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php echo $this->Html->link('Edit Profile', array('controller' => 'users', 'action' => 'edit'), array('class' => 'dropdown-item')); ?>
                                <?php echo $this->Html->link('Change Password', array('controller' => 'users', 'action' => 'change_password'), array('class' => 'dropdown-item')); ?>
                                <?php echo $this->Html->link('Change Email', array('controller' => 'users', 'action' => 'change_email'), array('class' => 'dropdown-item')); ?>
                                <div class="dropdown-divider"></div>
                                <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'), array('class' => 'dropdown-item')); ?>
                            </div>
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
