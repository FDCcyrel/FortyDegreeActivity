<div class="container mt-4">
    <h2>Compose New Message</h2>
    <?php echo $this->Form->create('Message', array('role' => 'form')); ?>
    <div class="form-group">
        <!-- Receiver Search Input with Select2 -->
        <?php echo $this->Form->input('receiver_id', array(
            'label' => 'To', 
            'class' => 'form-control', 
            'id' => 'search-input', // Ensure ID matches selector in the script
            'data-url' => $this->Html->url(array('controller' => 'users', 'action' => 'search')), // AJAX URL for Select2
        )); ?>
    </div>
    <div class="form-group">
  
        <?php echo $this->Form->input('messages', array('label' => 'Message', 'rows' => '5', 'class' => 'form-control')); ?>
    </div>
    <?php echo $this->Form->submit('Send', array('class' => 'btn btn-primary')); ?>
    <?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#search-input').select2({
        placeholder: 'Search for a user',
        minimumInputLength: 2,
        ajax: {
            url: '<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'search')); ?>',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
});

</script>
