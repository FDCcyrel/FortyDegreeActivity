<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-4">Conversations</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form id="reply-form" class="text-right">
                <input type="hidden" id="receiver-id" name="receiver_id" value="<?php echo $receiver_id; ?>">
                <input type="hidden" id="sender-id" name="sender_id" value="<?php echo $sender_id; ?>">
                <div class="form-group">
                    <label for="reply-message">Reply Message</label>
                    <textarea class="form-control" id="reply-message" name="message" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Reply</button>
            </form>

            <div id="message-list">
                <?php foreach ($messages as $message): ?>
                    <div class="message-item <?php echo ($message['Message']['sender_id'] == $myid) ? 'text-right' : 'text-left'; ?>" id="message-<?php echo $message['Message']['id']; ?>">
                        <?php if ($message['Message']['sender_id'] == $myid): ?>
                            <strong>To: Me</strong><br>
                        <?php else: ?>
                            <strong>From: <?php echo isset($message['Sender']['name']) ? h($message['Sender']['name']) : 'Unknown'; ?></strong><br>
                        <?php endif; ?>
                        <span><?php echo isset($message['Message']['messages']) ? h($message['Message']['messages']) : 'No message content'; ?></span><br>
                        <small>Date: <?php echo isset($message['Message']['date_created']) ? h($message['Message']['date_created']) : 'Unknown'; ?></small><br>
                        <?php echo $this->Html->link('Delete', '#', array('class' => 'delete-message-btn btn btn-danger', 'data-message-id' => $message['Message']['id'])); ?>
                        <hr>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center">
            <?php
                $lastMessageId = end($messages)['Message']['id'];
                $nextOffset = count($messages) > 0 ? $offset : 0; // Ensure nextOffset starts from 0 if no messages are loaded yet

                echo $this->Html->link(
                    'Show more',
                    [
                        'controller' => 'messages',
                        'action' => 'view',
                        '?' => ['offset' => $nextOffset] // Use '?' to ensure offset is passed as query parameter
                    ],
                    [
                        'class' => 'show-more-btn btn btn-secondary',
                        'escape' => false,
                        'id' => 'show-more-link',
                        'data-last-id' => $lastMessageId,
                        'data-offset' => $nextOffset // Pass the next offset as a data attribute
                    ]
                );
                ?>


            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Delete message AJAX functionality
        $('.delete-message-btn').on('click', function(e) {
            e.preventDefault();
            var messageId = $(this).data('message-id');

            if (confirm('Are you sure you want to delete this message?')) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'deleteMessage')); ?>',
                    data: { message_id: messageId },
                    dataType: 'json', 
                    success: function(response) {
                        if (response.success) { 
                            $('#message-' + messageId).fadeOut('slow', function() {
                                $(this).remove();
                            });
                            
                        } else {
                            alert('Failed to delete message. ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Error deleting message. Please try again.');
                    }
                });
            }
        });

        $('#reply-form').on('submit', function(e) {
            e.preventDefault();
            var replyMessage = $('#reply-message').val();
            var receiverId = $('#receiver-id').val(); 
            var senderId = $('#sender-id').val();
         
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'replyMessage')); ?>',
                data: {
                    message: replyMessage,
                    receiver_id: receiverId,
                    sender_id:senderId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Assume response includes the new message HTML
                        var newMessageHtml = '<div class="message-item" id="message-' + response.message.Message.id + '">' +
                                                '<strong>From: ' + (response.message.Sender.name ? response.message.Sender.name : 'Unknown') + '</strong><br>' +
                                                '<span>' + response.message.Message.messages + '</span><br>' +
                                                '<small>Date: ' + response.message.Message.date_created + '</small><br>' +
                                                '<a href="#" class="delete-message-btn btn btn-danger" data-message-id="' + response.message.Message.id + '">Delete</a><br>' +
                                                '<hr>' +
                                            '</div>';
                        $('#message-list').prepend(newMessageHtml); // Prepend new message to the top
                        $('#reply-message').val(''); // Clear reply message textarea
                        
                        // Reload the page after successful reply
                        window.location.reload();
                    } else {
                        alert('Failed to reply to message. ' + response.message);
                    }
                },
                error: function() {
                    alert('Error replying to message. Please try again.');
                }
            });
        });



        $('#show-more-link').on('click', function(e) {
        e.preventDefault();

        var nextLastId = parseInt($(this).data('last-id'));
        var nextOffset = parseInt($(this).data('offset'));

        $.ajax({
            type: 'GET',
            url: '<?php echo $this->Html->url(['controller' => 'messages', 'action' => 'view']); ?>',
            data: {
                last_id: nextLastId,
                offset: nextOffset
            },
            dataType: 'json',
            success: function(response) {
                console.log('Success:', response);

                if (response.messages.length > 0) {
                    response.messages.forEach(function(item) {
                        var message = item.Message;
                        var sender = item.Sender;

                        var messageHtml = '<div class="message-item ' + (message.sender_id == <?php echo $myid; ?> ? 'text-right' : 'text-left') + '" id="message-' + message.id + '">' +
                            '<strong>' + (sender.name ? 'From: ' + sender.name : 'Unknown') + '</strong><br>' +
                            '<span>' + message.messages + '</span><br>' +
                            '<small>Date: ' + message.date_created + '</small><br>' +
                            '<a href="#" class="delete-message-btn btn btn-danger" data-message-id="' + message.id + '">Delete</a><br>' +
                            '<hr>' +
                            '</div>';

                        $('#message-list').append(messageHtml); // Append new message to the end of the list

                        // Attach click event handler for the delete button
                        $('#message-' + message.id + ' .delete-message-btn').on('click', function(e) {
                            e.preventDefault();
                            var messageId = $(this).data('message-id');

                            if (confirm('Are you sure you want to delete this message?')) {
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'deleteMessage')); ?>',
                                    data: { message_id: messageId },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.success) {
                                            $('#message-' + messageId).fadeOut('slow', function() {
                                                $(this).remove();
                                            });
                                        } else {
                                            alert('Failed to delete message. ' + response.message);
                                        }
                                    },
                                    error: function() {
                                        alert('Error deleting message. Please try again.');
                                    }
                                });
                            }
                        });
                    });

                    // Update "Show more" link with the new last message ID and offset
                    var newLastId = response.messages[response.messages.length - 1]['Message']['id'];
                    var newOffset = nextOffset + response.messages.length;

                    $('#show-more-link')
                        .data('last-id', newLastId)
                        .data('offset', newOffset)
                        .attr('href', '<?php echo $this->Html->url(['controller' => 'messages', 'action' => 'view']); ?>?last_id=' + newLastId + '&offset=' + newOffset);
                } else {
                    $('#show-more-link').hide(); // Hide "Show more" link if no more messages
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr, status, error);
                alert('Error: Failed to load more messages. Please try again.');
            }
        });
    });






    });
</script>
