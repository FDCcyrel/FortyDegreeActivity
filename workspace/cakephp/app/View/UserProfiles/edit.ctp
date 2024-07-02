<!-- View/UserProfiles/add_edit.ctp -->

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php
                echo $this->Form->create('UserProfile', [
                    'role' => 'form',
                    'class' => 'form-horizontal', 
                    'id' => 'profileForm' // Optional ID for the form
                ]);

                echo $this->Session->flash(); // Display flash messages if any
            ?>
            
            <h2><?php echo isset($profile['UserProfile']['id']) ? 'Edit Profile' : 'Create Profile'; ?></h2>
            
            <?php
                echo $this->Form->input('photo_path', [
                    'label' => 'Photo (JPEG, GIF, PNG)',
                    'type' => 'file',
                    'class' => 'form-control',
                    'required' => true,
                    'accept' => '.jpg,.jpeg,.gif,.png', // Specify accepted file types
                    'onchange' => 'previewFile()' // Function to preview selected file
                ]);

                // Preview image container
                echo '<div id="imagePreview" style="margin-top: 10px;"></div>';
                
                echo $this->Form->input('name', [
                    'label' => 'Name',
                    'class' => 'form-control',
                    'required' => true
                ]);

                echo $this->Form->input('birthday', [
                    'label' => 'Birthday',
                    'class' => 'form-control datepicker', 
                    'type' => 'text', 
                    'data-date-format' => 'yyyy-mm-dd', 
                    'autocomplete' => 'off' 
                ]);

                echo '<div class="form-group">';
                echo '<div class="col-md-10">';
                echo $this->Form->radio('gender', [
                    '1' => 'Male',
                    '2' => 'Female'
                ], [
                    'div' => false, 
                    'label' => ['class' => 'radio-inline mr-3'] 
                ]);
                echo '</div>';
                echo '</div>';

                echo $this->Form->input('hobby', [
                    'label' => 'Hobby',
                    'class' => 'form-control',
                    'required' => true,
                    'type' => 'textarea', // Use textarea for long text
                    'rows' => 5 // Adjust rows as needed
                ]);

                
                echo $this->Form->hidden('id');

                echo $this->Form->submit('Submit', ['class' => 'btn btn-primary']);
                echo $this->Html->link('Cancel', ['controller' => 'user_profiles', 'action' => 'index'], ['class' => 'btn btn-default']);

                echo $this->Form->end();
            ?>
        </div>
    </div>
</div>

<script>
    // JavaScript function for previewing selected file
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
    
    // Datepicker initialization
    $(document).ready(function() {
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd', // Set the date format
            changeYear: true, // Allow changing the year
            changeMonth: true, // Allow changing the month
            yearRange: '-100:+0', // Optional: Adjust the range as per your requirement
            showButtonPanel: true // Optional: Show button panel for easy navigation
        });
    });
</script>
