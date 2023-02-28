<?php
    session_start();
?>
<?php
    // 데이터베이스 연결
    $conn=mysqli_connect("db.luddy.indiana.edu","i494f22_team06","my+sql=i494f22_team06","i494f22_team06");

    if (!$conn) {
        die("데이터베이스 연결에 실패했습니다.");
    }

    // 유저 인증

    $user_id = $_SESSION['id'];

    // 채팅 상대 선택
    $sql = "SELECT DISTINCT 
            CASE 
                WHEN SenderID = $user_id THEN ReceiverID 
                ELSE SenderID 
            END AS id 
            FROM CHAT 
            WHERE SenderID = $user_id OR ReceiverID = $user_id;
            ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        die("There are no chat partners.");
    }

    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);


// 채팅 대상 선택 폼 템플릿
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style> <?php include 'css/help.css'; ?> </style>
    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<?php include 'includes/nav.php'; ?>
<body>
    <h1>Chat lists </h1>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <a href="chat.php?receiver_id=<?php echo $user["id"]; ?>">
                    <?php
                        $pass_name = "SELECT CONCAT(fname, ' ', lname) AS Name FROM PASSENGER WHERE PassengerID = {$user['id']}";
                        $name_result = mysqli_query($conn, $pass_name);
                        $pass_info = mysqli_fetch_array($name_result, MYSQLI_ASSOC);
                        echo $pass_info["Name"];
                    ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>