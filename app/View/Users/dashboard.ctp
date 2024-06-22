<div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="sidebar">
                    <h2>Dashboard Menu HELLO YOUTUBE</h2>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <?php echo $this->Html->link('Dashboard', array('controller' => 'pages', 'action' => 'display', 'home'), array('class' => 'nav-link')); ?>
                        </li>
                        <li class="nav-item">
                            <?php echo $this->Html->link('Link 1', array('controller' => 'controller_name', 'action' => 'action_name'), array('class' => 'nav-link')); ?>
                        </li>
                        <li class="nav-item">
                            <?php echo $this->Html->link('Link 2', array('controller' => 'controller_name', 'action' => 'action_name'), array('class' => 'nav-link')); ?>
                        </li>
                        <!-- Add more menu items as needed -->
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>
        </div>
    </div>