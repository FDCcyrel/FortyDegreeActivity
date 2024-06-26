

<div class="container">
<div class="row">
                <div class="col-md-6">
                <h2>Edit Profile</h2>
                </div>
                <div class="col-md-6 text-right">
                <p>
                        <?php echo $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout'], ['class' => 'nav-link']); ?>
                    </p>
                </div>
            </div>
            <?php
    if (!empty($errors)) {
        echo '<div id="validation-messages" class="alert alert-danger">';
        echo '<ul>';
        foreach ($errors as $field => $error) {
            foreach ($error as $errMsg) {
                echo '<li>' . $errMsg . '</li>';
            }
        }
        echo '</ul>';
        echo '</div>';
    }
    ?>
    
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php
                echo $this->Form->create('User', [
                    'role' => 'form',
                    'class' => 'form-horizontal',
                    'id' => 'profileForm',
                    'type' => 'file' 
                ]);

                
                echo $this->Session->flash();
            ?>
            
            
            

            
            <?php
               
                echo $this->Form->input('photo_path', [
                    'label' => 'Photo (JPEG, GIF, PNG)',
                    'type' => 'file',
                    'class' => 'form-control-file', // Use form-control-file for file input
                    'required' => true,
                    'accept' => '.jpg,.jpeg,.gif,.png', // Specify accepted file types
                    'onchange' => 'previewFile()' // Function to preview selected file
                ]);

                // Preview image container
                if (!empty($profile['User']['photo_path'])) {
                    echo '<div id="imagePreview" style="margin-top: 10px;"><img src="' . $this->Html->url('/img/uploads/' . $profile['User']['photo_path']) . '" style="max-width: 100%;" /></div>';
                } else {
                    echo '<div id="imagePreview" style="margin-top: 10px;"></div>';
                }
                
                // Display name field
                echo $this->Form->input('name', [
                    'label' => 'Name',
                    'class' => 'form-control',
                    'required' => true
                ]);

               
                echo $this->Form->input('birthday', [
                    'label' => 'Birthday',
                    'class' => 'form-control datepicker',
                    'type' => 'text',
                    'autocomplete' => 'off',
                    'value' => isset($profile['User']['birthday']) ? date('Y-m-d', strtotime($profile['User']['birthday'])) : '', 
                    'data-date-format' => 'yyyy-mm-dd', 
                    'readonly' => true,
                    'required' => true
                ]);
                
             
                echo $this->Form->input('email', [
                    'label' => 'Email',
                    'class' => 'form-control',
                    'required' => true 
                ]);

                
                echo '<div class="form-group">';
                echo '<div class="col-md-10">';
                echo $this->Form->radio('gender', [
                    '1' => 'Male',
                    '2' => 'Female'
                ], [
                    'div' => false,
                    'label' => ['class' => 'radio-inline mr-3'],
                    'required' => true
                ]);
                echo '</div>';
                echo '</div>';

               
                echo $this->Form->input('hobby', [
                    'label' => 'Hobby',
                    'class' => 'form-control',
                    'required' => true,
                    'type' => 'textarea', 
                    'rows' => 5 
                ]);

                echo $this->Form->input('password', [
                    'label' => 'Password',
                    'type' => 'password',
                    'class' => 'form-control',
                    'autocomplete' => 'new-password', 
                    'value' => ''
                ]);
                
                echo $this->Form->input('confirm_password', [
                    'label' => 'Confirm Password',
                    'type' => 'password',
                    'class' => 'form-control',
                    'autocomplete' => 'new-password', 
                  
                    'value' => ''
                ]);
                
                
               
                echo $this->Form->hidden('id');
                
               
                echo $this->Form->submit('Submit', ['class' => 'btn btn-primary']);
                echo $this->Html->link('Cancel', ['controller' => 'users', 'action' => 'view_profile'], ['class' => 'btn btn-default']);

                echo $this->Form->end();
            ?>
        </div>
    </div>
</div>

<script>
    
    function previewFile() {
        var preview = document.getElementById('imagePreview');
        var file = document.querySelector('input[type=file]').files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            var img = document.createElement('img');
            img.src = reader.result;
            img.style.maxWidth = '100%';
            preview.innerHTML = '';
            preview.appendChild(img);
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    }
    
    
    $(document).ready(function() {
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd', 
            changeYear: true, 
            changeMonth: true,
            yearRange: '-100:+0', 
            showButtonPanel: true 
        });
    });
</script>
