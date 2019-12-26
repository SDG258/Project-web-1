<?php
require_once 'init.php';

if (!$currentUser) {
    header('Location:index.php');
    exit();
}
include 'header.php';

$toUserID = findUserByID($_SESSION['id']); ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    var from = null,
        to = null,
        start = 0,
        url = 'http://localhost/deadline/Project/chat.php';
    $(document).ready(function() {
        from = "<?php echo $currentUser['id']; ?>";
        to = "<?php echo $toUserID['id']; ?>";
        load();
        $('form').submit(function(e) {
            $.post(url, {
                message: $('#message').val(),
                from: from,
                to: to
            })
            $('#message').val('');
            return false;
        })
    })

    function load() {
        $.get(url + '?start=' + start, function(result) {
            if (result.items) {
                result.items.forEach(item => {
                    start = item.id;
                    $('#messages').append(renderMessage(item));
                })
                $('#message').animate({
                    scrollTop: $('#message')[0].scrollHeight
                });
            };
            load();
        });
    }
    function renderMessage(item) {
            if (item.fromUserID == "<?php echo $currentUser['id']; ?>") {
                let time = new Date(item.createdAt);
                time = `${time.getHours()}:${time.getMinutes() < 10 ? '0' : ''}${time.getMinutes()}`;
                return `<div class="msg" style="float: right">${item.message}<span>${time}</span></div> <br> <br>`;
            } else {
                let time = new Date(item.createdAt);
                time = `${time.getHours()}:${time.getMinutes() < 10 ? '0' : ''}${time.getMinutes()}`;
                return `<div class="msg">${item.message}<span>${time}</span></div></div>`;
            }
    }
</script>
<style>
    body {
        margin: 0;
        overflow: hidden;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }

    #messages {
        height: 80vh;
        overflow: hidden;
        padding: 10px;
    }

    form {
        display: flex;
    }

    input {
        font-size: 1.2rem;
        padding: 10px;
        margin: 10px 5px;
        appearance: none;
        -webkit-appearance: none;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #message {
        flex: 2
    }

    .msg {
        background-color: #dcf8c6;
        padding: 5px 10px;
        border-radius: 5px;
        margin-bottom: 8px;
        width: fit-content
    }

    .msg p {
        margin: 0;
        font-weight: bold
    }

    .msg span {
        font-size: 0.7rem;
        margin-left: 15px
    }
</style>
</head>

<body>
    <div id="messages"></div>
    <form>

        <input type="text" id="message" autocomplete="off" autofocus placeholder="Type message...">
        <input type="submit" value="Send">
    </form>
</body>

</html>