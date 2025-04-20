<?php
$mysqli = new mysqli("localhost", "root", "", "my_app");

if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Insert
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mysqli->query("INSERT INTO users (name, email) VALUES ('$name', '$email')");
    header("Location: index.php");
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mysqli->query("UPDATE users SET name='$name', email='$email' WHERE id=$id");
    header("Location: index.php");
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM users WHERE id=$id");
    header("Location: index.php");
}

$users = $mysqli->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP CRUD App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <center><h1>Manage Users</h1><center>
    <form id="userForm" method="POST" action="">
        <input type="hidden" name="id" id="userId">
        <label for="nom">Nom:</label>
        <input type="text" name="name" id="name" placeholder="Name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <br>
        <button type="submit" name="save" id="saveBtn">Save</button>
        <button type="submit" name="update" id="updateBtn" style="display: none;">Update</button>
    </form>

    <table>
        <thead>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php while($row = $users->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td>
                        <button onclick='editUser(<?= json_encode($row) ?>)' class=table-btn>Edit</button>
                        <a href="?delete=<?= $row['id']  ?>" onclick="return confirm('Delete this user?')" class=table-btn>Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>    
    </table>
</div>
<script src="script.js"></script>
</body>
</html>
