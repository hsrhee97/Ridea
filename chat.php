<?php
    session_start();
    $login = $_SESSION['login'];
    if (!isset($login)) {
        header('Location: home.php');
        exit;
    }
    $conn=mysqli_connect("db.luddy.indiana.edu","i494f22_team06","my+sql=i494f22_team06","i494f22_team06");

    if (!$conn) {
        die("데이터베이스 연결에 실패했습니다.");
    }

    $user_id = $_SESSION["id"];
    $receiver_id = $_GET["receiver_id"];

    // 채팅 상대 정보 조회
    $sql1 = "SELECT CONCAT(fname, ' ', lname) AS Name FROM PASSENGER WHERE PassengerID = '$receiver_id'";
    $result = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result) == 0) {
        die("채팅 상대를 찾을 수 없습니다.");
    }

    $receiver = mysqli_fetch_assoc($result);

    // 채팅 메시지 전송
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $message = mysqli_real_escape_string($conn, $_POST["message"]);

        if ($message != "") {
            $send_sql = "INSERT INTO CHAT (SenderID, ReceiverID, message) VALUES ('$user_id', '$receiver_id', '$message')";
            mysqli_query($conn, $send_sql);
        }
    }

    // 채팅 메시지 조회
    $search_sql = "SELECT * FROM CHAT WHERE (SenderID = '$user_id' AND ReceiverID = '$receiver_id') OR (SenderID = '$receiver_id' AND ReceiverID = '$user_id') ORDER BY message_time ASC";
    $search_result = mysqli_query($conn, $search_sql);

    if (mysqli_num_rows($search_result) > 0) {
        $messages = mysqli_fetch_all($search_result, MYSQLI_ASSOC);
    } else {
        $messages = array();
    }

    // 채팅 페이지 템플릿
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <style> <?php include 'css/chat.css'; ?> </style>
</head>

<?php include 'includes/nav.php'; ?>
<body>
    <main>
        <div class="header2">
            <h2><?= $receiver["Name"] ?></h2>
        </div>

    <div class="wrapper2">
    <div id="chat-container">
        <div id="chat-messages">
            <?php foreach ($messages as $message): ?>
                <?php if ($message["SenderID"] == $user_id): ?>
                    <div style="text-align: right;">
                        <strong>Me:</strong> <?= $message["message"] ?>
                    </div>
                <?php else: ?>
                    <div style="text-align: left;">
                        <strong><?= $receiver["Name"] ?>:</strong> <?= $message["message"] ?>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <form id="chat-form" method="post" onsubmit="location.reload()">
            <input type="text" id="message-input" name="message" placeholder="type the message">
            <button type="submit" id="send-button">Send</button>
        </form>
    </div>
    </div>

    <script>
        const form = document.getElementById("chat-form");
        const messageInput = document.getElementById("message-input");

        form.addEventListener("submit", event => {
            event.preventDefault();

            const message = messageInput.value.trim();

            if (message !== "") {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", window.location.href);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("message=" + encodeURIComponent(message));

                xhr.onload = () => {
                    if (xhr.status === 200) {
                        messageInput.value = "";
                    }
                };
            }
        });
        
        setInterval(getNewMessages, 1000);

        const messagesContainer = document.getElementById("chat-messages");
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        
    </script>
    </main>
</body>
</html>




