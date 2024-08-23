<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_GET["did"])) {
    header("Location: ./add-departments.php");
    exit();
}

if(isset($_GET["edit"]) && isset($_GET["cid"])){
    $class_id = $_GET["cid"];
    $fetchDeptQuery = "SELECT Class_name FROM class WHERE Class_id=?";
    $stmt = $conn->prepare($fetchDeptQuery);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $class_name = $row["Class_name"];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_class_name = $_POST["sname"];
        if (!empty($new_class_name)) {
            $updateClassQuery = "UPDATE class SET Class_name=? WHERE Class_id=?";
            $stmt = $conn->prepare($updateClassQuery);
            $stmt->bind_param("si", $new_class_name, $class_id);
            if ($stmt->execute()) {
                echo "<script>alert('Class updated successfully!'); window.location.href='./add-classes.php?did=".$_GET["did"]."';</script>";
            } else {
                echo "<script>alert('Error updating Class!');</script>";
            }
        } else {
            echo "<script>alert('Class name cannot be empty!');</script>";
        }
    }
}

if(isset($_GET["delete"]) && isset($_GET["cid"])){
    $class_id = $_GET["cid"];
    $deleteClassQuery = "DELETE FROM class WHERE Class_id=?";
    $stmt = $conn->prepare($deleteClassQuery);
    $stmt->bind_param("i", $class_id);
    if ($stmt->execute()) {
        echo "<script>alert('Class deleted successfully!'); window.location.href='./add-classes.php?did=".$_GET["did"]."';</script>";
    } else {
        echo "<script>alert('Error deleting Class!');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET["edit"])) {
    $new_class_name = $_POST["sname"];
    if (!empty($new_class_name)) {
        $checkClassQuery = "SELECT COUNT(*) as count FROM class WHERE Class_name=?";
        $stmt = $conn->prepare($checkClassQuery);
        $stmt->bind_param("s", $new_class_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            echo "<script>alert('Class name already exists!');</script>";
        } else {
            $insertClassQuery = "INSERT INTO class (Class_name,Dept_id) VALUES (?,?)";
            $stmt = $conn->prepare($insertClassQuery);
            $stmt->bind_param("si", $new_class_name,$_GET["did"]);
            if ($stmt->execute()) {
                echo "<script>alert('Class added successfully!'); window.location.href='./add-classes.php?did=".$_GET["did"]."';</script>";
            } else {
                echo "<script>alert('Error adding class!');</script>";
            }
        }
    } else {
        echo "<script>alert('Class name cannot be empty!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/add-departments.css">
    <title>Add Classes</title>
    <script>
    function confirmDelete(classId, deptId) {
        if (confirm("Are you sure you want to delete this Class?\nAll DATA ASSOCIATED WITH THIS CLASS WILL BE DELETED (JOBS, STUDENTS, PLACEMENT COORDINATORS)\nThis action cannot be undone.")) {
            window.location.href = './add-classes.php?delete=1&cid=' + classId + '&did=' + deptId;
        }
    }
</script>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading">
                        <a href="./add-departments.php">
                            <i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i>
                        </a>
                        Classes
                    </h2>
                </div>

                <h3><?php echo isset($class_name) ? 'Edit Class' : 'Add Class'; ?></h3>
                <div class="form-adjust">
                    <form action="" method="post">
                        <div class="inputbox">
                            <label for=""><b>Class Name:</b></label>
                            <input type="text" name="sname" placeholder="Class" value="<?php echo isset($class_name) ? $class_name : ''; ?>">
                        </div>
                        <div class="button-container">
                            <button name="student-search-button" class="add-button"><?php echo isset($class_name) ? 'Update' : 'Add'; ?></button>
                        </div>
                    </form>
                </div>

                <div class="sections">
                    <table>
                        <tr>
                            <th>Class Name</th>
                            <th>Students</th>
                            <th>Edit Class Name</th>
                            <th>Remove Class</th>
                        </tr>
                        <?php
                            global $conn;
                            $fetchClassQuery = "SELECT Class_name,Class_id FROM class WHERE Dept_id = ?;";
                            $fetchClass = $conn->prepare($fetchClassQuery);
                            $fetchClass->bind_param("i",$_GET["did"]);
                            $fetchClass->execute();
                            $result = $fetchClass->get_result();

                            while ($row = $result->fetch_assoc()){
                                $fetchStudentsQuery = "SELECT COUNT(*) as total FROM student as s
                                INNER JOIN class as c on c.Class_id=s.S_Class_id
                                WHERE c.Class_id = ?;";
                                $fetchStudents = $conn->prepare($fetchStudentsQuery);
                                $fetchStudents->bind_param("i",$row["Class_id"]);
                                $fetchStudents->execute();
                                $totalresult = $fetchStudents->get_result();
                                $row1 = $totalresult->fetch_assoc();
                                $total = $row1["total"];
                                echo '<tr>
                                            <td>'.$row["Class_name"].'</td>
                                            <td>'.$total.'</td>
                                            <td><a href="./add-classes.php?edit=1&cid='.$row["Class_id"].'&did='.$_GET["did"].'"><button class="edit-button">Edit</button></a></td>
                                            <td><button class="remove-button" style="color:red" onclick="confirmDelete('.$row["Class_id"].','.$_GET["did"].')">Remove</button></td>
                                        </tr>';
                            }
                        ?>
                    </table>
                </div>                   
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>
</body>
</html>
