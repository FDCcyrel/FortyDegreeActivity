<!-- app/View/UserProfiles/view_profile.ctp -->

<div class="container">
    <div class="row">
        <div class="col-md-6">
           <h2>User Profile</h2>
        </div>
        <div class="col-md-6 text-right">
        <p>
                <?php echo $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout'], ['class' => 'nav-link']); ?>
            </p>
        </div>
    </div>

    <?php
    // Display flash message if it exists
    if ($this->Session->check('Flash.flash')) {
        echo '<div class="alert alert-info" role="alert">';
        echo $this->Session->flash();
        echo '</div>';
    }
    ?>

    <div class="row">
        <div class="col-md-3">
            <?php if (!empty($user['User']['photo_path'])): ?>
                <div id="profilePicture" style="margin-top: 20px;">
                    <img src="<?php echo $this->Html->url('/app/webroot/img/' . $user['User']['photo_path']); ?>" style="max-width: 100%; height: 200px;" />
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-9">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td><?php echo isset($user['User']['name']) ? h($user['User']['name']) : ''; ?></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>
                        <?php
                        $gender = isset($user['User']['gender']) ? $user['User']['gender'] : '';
                        echo ($gender == 1) ? 'Male' : (($gender == 2) ? 'Female' : '');
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Birthday</th>
                    <td><?php echo isset($user['User']['birthday']) ? h($user['User']['birthday']) : ''; ?></td>
                </tr>
                <tr>
                    <th>Joined</th>
                    <td><?php echo isset($user['User']['date_created']) ? h($user['User']['date_created']) : ''; ?></td>
                </tr>
                <tr>
                    <th>Last Login</th>
                    <td><?php echo isset($user['User']['last_login_time']) ? h($user['User']['last_login_time']) : ''; ?></td>
                </tr>
                <tr>
                    <th>Hobby</th>
                    <td><?php echo isset($user['User']['hobby']) ? h($user['User']['hobby']) : ''; ?></td>
                </tr>
            </table>
        </div>
    </div>

    <p>
        <?php echo $this->Html->link('Edit Profile', ['controller' => 'users', 'action' => 'edit', $user['User']['id']], ['class' => 'btn btn-primary']); ?>
        <?php echo $this->Html->link('Back', ['controller' => 'users', 'action' => 'first'], ['class' => 'btn btn-default']); ?>
    </p>

</div>
