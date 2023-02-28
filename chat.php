<?php
    session_start();

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
    <title>채팅 페이지</title>
    <style>
        #chat-container {
            width: 80%;
            height: 80vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 2rem;
        }

        #chat-messages {
            width: 100%;
            height: 70vh;
            padding: 1rem;
            overflow-y: scroll;
        }

        #chat-form {
            width: 100%;
            display: flex;
            align-items: center;
        }

        #message-input {
            width: 80%;
            margin-right: 1rem;
        }

        #send-button {
            width: 20%;
            font-weight: bold;
            background-color: #3d5a80;
            color: white;
            border: none;
            border-radius: 0.2rem;
            padding: 0.5rem 1rem;
        }
    </style>
</head>

<?php include 'includes/nav.php'; ?>
<body>
    <h1><?= $receiver["Name"] ?></h1>
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

        const messagesContainer = document.getElementById("chat-messages");
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    </script>
</body>
</html>




