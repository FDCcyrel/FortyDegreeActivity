<!-- app/View/Messages/inbox.ctp -->

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-4">Inbox Messages</h2>
        </div>
        <div class="col-md-6 text-right">
            <?php echo $this->Html->link('New Message', array('controller' => 'messages', 'action' => 'compose'), array('class' => 'btn btn-primary')); ?>
        </div>
    </div>

    <!-- Search Bar
    <div class="row mb-3">
        <div class="col-md-6">
            <?php
                echo $this->Form->create(null, array('role' => 'form', 'class' => 'form-inline'));
                echo $this->Form->input('search', array(
                    'div' => false,
                    'label' => false,
                    'placeholder' => 'Search messages...',
                    'class' => 'form-control mr-sm-2',
                    'id' => 'search-input'
                ));
                echo $this->Form->button('Search', array('type' => 'submit', 'class' => 'btn btn-outline-primary my-2 my-sm-0'));
                echo $this->Form->end();
            ?>
        </div>
    </div> -->

    <div class="row">
        <div class="col-md-12">
            <!-- Display messages -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td><?php echo $message['Sender']['name']; ?></td>

                            <td><?php echo $message['Message']['messages']; ?></td>
                            <td><?php echo $message['Message']['date_created']; ?></td>
                            <td>
                                <?php echo $this->Html->link('View', array('controller' => 'messages', 'action' => 'view', $message['Message']['id']), array('class' => 'btn btn-sm btn-primary')); ?>
                                <?php echo $this->Html->link('Delete', array('controller' => 'messages', 'action' => 'delete', $message['Message']['id']), array('class' => 'btn btn-sm btn-danger', 'confirm' => 'Are you sure you want to delete this message?')); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="text-center">
                <?php
                    echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled'));
                    echo $this->Paginator->numbers();
                    echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled'));
                ?>
            </div>
        </div>
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
