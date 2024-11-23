<?php 
include("dbconnect.php");
if (isset($_POST["studentid"], $_POST["name"], $_POST["faculty"], $_POST["gender"])) {
    $studentid = $_POST['studentid'];
    $name = $_POST['name'];
    $faculty = $_POST['faculty'];
    $gender = $_POST['gender'];
    $sql = "INSERT INTO student (student_id, name, faculty, gender) VALUES ('$studentid', '$name', '$faculty', '$gender')";
    $insert = mysqli_query($conn, $sql);

    if ($insert) {
        echo "Record added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
echo "<h2>Student List</h2>";
echo '<table border="1">
    <tr>
        <th>NO</th>
        <th>Student ID</th>
        <th>NAME</th>
        <th>FACULTY</th>
        <th>GENDER</th>
        <th>Action</th>
    </tr>';
$result = mysqli_query($conn, "SELECT * FROM student");
$no = 1;

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>$no</td>
        <td>{$row['student_id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['faculty']}</td>
        <td>{$row['gender']}</td>
        <td>
            <a href='delete.php?id={$row['id']}'>Delete</a> &nbsp;
            <a href='editdata.php?id={$row['id']}'>Update</a>
        </td>
    </tr>";
    $no++;
}
echo '</table>';
?>
