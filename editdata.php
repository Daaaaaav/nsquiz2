<?php
include("dbconnect.php");
$id = isset($_GET['id']) ? $_GET['id'] : null;
$sql = "SELECT * FROM student WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) === 0) {
    die("No record found for the provided ID.");
}
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Student</title>
</head>
<body>
<form action="updated.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <table align="center" border="1">
        <tr>
            <td>Student ID</td>
            <td>:</td>
            <td><input name="studentid" type="text" value="<?php echo $row['student_id']; ?>" required></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>:</td>
            <td><input name="name" type="text" value="<?php echo $row['name']; ?>" required></td>
        </tr>
        <tr>
            <td>Faculty</td>
            <td>:</td>
            <td>
                <select name="faculty" required>
                    <option value="<?php echo $row['faculty']; ?>" selected>
                        <?php echo $row['faculty']; ?>
                    </option>
                    <?php 
                    $faculty_result = mysqli_query($conn, "SELECT * FROM faculty");
                    while ($data = mysqli_fetch_assoc($faculty_result)) {
                        echo '<option value="' . $data['faculty'] . '">' . $data['faculty'] . '</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>:</td>
            <td>
                <input type="radio" name="gender" value="Female" <?php echo ($row['gender'] === 'Female') ? 'checked' : ''; ?>>Female<br>
                <input type="radio" name="gender" value="Male" <?php echo ($row['gender'] === 'Male') ? 'checked' : ''; ?>>Male
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" value="Update">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
