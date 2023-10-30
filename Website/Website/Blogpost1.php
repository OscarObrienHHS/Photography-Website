<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Blogpost1.css">
    <Title>Oscar Obrien Photography</Title>
</head>

<body>
    <div class="Sidebar">
            <h1>Oscar <br> Obrien <br> Photography</h1>
            <ul>
                <a href="Home.php"><li>Home</li></a>
                <a href="Blog.php"><li>Blog</li></a>
                <a href="https://linktr.ee/oscar_obrien?utm_source=linktree_admin_share"><li>Socials</li></a>
            <ul>
        </div>
    <div class="Blogpost">
        
    </div>
    <div class="Comments">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        Username: <input type="text" name="user_name"><br>
        Comment: <input type="text" name="user_comment"><br>
        <input type="submit" name="submit">
    </form>
    <?php
        $mysqli = new mysqli("localhost", "root", "", "comments");
        $res = $mysqli->query("SELECT * FROM comment_table");
        if(isset($_POST['submit'])) {
            $stmt = $mysqli->prepare("INSERT INTO comment_table(user_name, user_comment, date) VALUES (?, ?, now())");
            $stmt->bind_param("ss", $_POST['user_name'], $_POST['user_comment']);
            $stmt->execute();
            unset($_POST);
            header('Location:' . $_SERVER['PHP_SELF']);
        }
        for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
            $res->data_seek($row_no);
            $row = $res->fetch_assoc();
            printf("comment_id: %s  user_name: %s  user_comment: %s  date: %s", $row["comment_id"], $row["user_name"], $row["user_comment"], $row["date"]);
        }
    ?>
</div>
</body>
