<style>
/* Basic styling for chat UI */
#user-list { width: 20%; float: left; overflow-y: scroll;}
#chat-box { width: 80%; float: right; border: 1px solid #ddd; overflow-y: auto; }
#chat-box p { margin: 5px; padding: 10px; border-radius: 5px; }
.sender { background-color: #d1ffd1; text-align: right; }
.receiver { background-color: #f1f1f1; text-align: left; }
#message {
    width: 94%;
    padding: 10px;
    border: 1px solid #56b155;
}
#send-btn {
    padding: 10px 13px;
    background: #56b155;
    color: #fff;
    border: 1px solid #56b155;
}
h3 {
    padding: 8px;
    margin: 0px;
    background: #eee;
    margin-bottom: 13px;
}
.messager,#user-list,#chat-box {
height: 65vh;
}
div#user-list h3{
    margin:0px;
}
div#user-list{
    background: aliceblue;
}
div#user-list li a {
    display: inline-block;
    background: aliceblue;
    width: 100%;
    padding: 7px 15px 7px;
}
#user-list li a.active {
    background-color: #25a07a;
    color: #fff;
    font-weight: bold;
    border-radius: 0px;
}
div#user-list ul {
    list-style: none;
    padding:0px;
}
.messager {
    margin: 62px 15px;
    border: 1px solid #fbd8e6;
}
    </style>
    <div>
<div id="content-container">
<div id="page-title">
<h1 class="page-header text-overflow custompagetitle">CHAT</h1>
</div>
<div class="messager">
    <div id="user-list">
        <h3>Users</h3>
        <ul>
            <?php            
            foreach ($users as $user):
            ?>
                <li><a href="#" onclick="startChat(<?=$user['admin_id']?>, '<?=$user['name']?>')"><?= $user['name']; if($_SESSION['admin_id'] == $user['admin_id']){ echo ' (You)';}?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div id="chat-box">
        <h3>Chat with <span id="chat-with"></span></h3>
        <div id="messages"></div>
    </div>

    <input type="text" id="message" placeholder="Type a message">
    <button id="send-btn" onclick="sendMessage()">Send</button>

    </div>
    </div>
    </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        var senderId = <?php echo $_SESSION['admin_id']?>; // Logged-in user ID
        var receiverId = null;

        function startChat(userId, userName) {
            receiverId = userId;
            $('#chat-with').text(userName);
            $('#messages').empty();
            fetchMessages();
            $('#user-list li a').removeClass('active'); // Remove active class from all users
        $(`#user-list li a[onclick="startChat(${userId}, '${userName}')"]`).addClass('active'); // Add to selected
        }

        function fetchMessages() {
            if (receiverId) {
                $.ajax({
                    url: "<?= base_url('admin/orders/fetchMessages') ?>",
                    type: "POST",
                    data: { sender_id: senderId, receiver_id: receiverId },
                    dataType: "json",
                    success: function(data) {
                        $('#messages').html('');
                        data.messages.forEach(function(message) {
                            var messageClass = message.sender_id == senderId ? 'sender' : 'receiver';
                            $('#messages').append('<p class="' + messageClass + '">' + message.message + '</p>');
                        });
                        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                    }
                });
            }
        }

        function sendMessage() {
            var message = $('#message').val();
            if (message && receiverId) {
                $.ajax({
                    url: "<?= base_url('admin/orders/sendMessage') ?>",
                    type: "POST",
                    data: { sender_id: senderId, receiver_id: receiverId, message: message },
                    success: function() {
                        $('#message').val(''); // Clear input
                        fetchMessages(); // Reload messages
                    }
                });
            }
        }

        setInterval(fetchMessages, 3000); // Auto-refresh messages every 3 seconds

        $(document).ready(function() {
        // Check if there's at least one user in the list and select the first one by default
        $('#user-list li a').first().click();
    });
    </script>