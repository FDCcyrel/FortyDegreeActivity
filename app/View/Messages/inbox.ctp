<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-4">Inbox Messages</h2>
        </div>
        <div class="col-md-6 text-right">
            <?php echo $this->Html->link('New Message', array('controller' => 'messages', 'action' => 'compose'), array('class' => 'btn btn-primary')); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>From</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($latestMessages)): ?>
                    <?php foreach ($latestMessages as $latestMessage): ?>
                    
                        <tr>
                            <td>
                                <?php
                                if ($latestMessage['Message']['sender_id'] == $myid) {
                                    echo 'Me';
                                } else {
                                    echo h($latestMessage['Sender']['name']); // Assuming 'h()' is used for HTML escaping if needed
                                }
                                ?>
                            </td>
                            <td><?php echo $latestMessage['Message']['date_created']; ?></td>
                            <td>
                                <?php echo $this->Html->link('View', array('controller' => 'messages', 'action' => 'view', $latestMessage['Message']['sender_id'],$latestMessage['Message']['receiver_id']), array('class' => 'btn btn-sm btn-primary')); ?>
                                <?php echo $this->Html->link('Delete', array('controller' => 'messages', 'action' => 'delete', $latestMessage['Message']['sender_id'],$latestMessage['Message']['receiver_id']), array('class' => 'btn btn-sm btn-danger', 'confirm' => 'Are you sure you want to delete this message?')); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No messages found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>

            </table>

        </div>
    </div>

    <div class="text-center">
        <?php
            echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled'));
            echo $this->Paginator->numbers();
            echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled'));
        ?>
    </div> 
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Initialize Select2 for search input
        $('#search-input').select2({
            placeholder: 'Search for a user',
            minimumInputLength: 2, // Minimum characters before displaying suggestions
            ajax: {
                url: '<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'search')); ?>',
                dataType: 'json',
                delay: 250, // Delay in milliseconds before making the request
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
