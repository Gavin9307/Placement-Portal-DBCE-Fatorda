<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}

if(isset($_GET["edit"]) && isset($_GET["did"])){
    $dept_id = $_GET["did"];
    $fetchDeptQuery = "SELECT Dept_name FROM department WHERE Dept_id=?";
    $stmt = $conn->prepare($fetchDeptQuery);
    $stmt->bind_param("i", $dept_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $dept_name = $row["Dept_name"];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_dept_name = $_POST["sname"];
        if (!empty($new_dept_name)) {
            $updateDeptQuery = "UPDATE department SET Dept_name=? WHERE Dept_id=?";
            $stmt = $conn->prepare($updateDeptQuery);
            $stmt->bind_param("si", $new_dept_name, $dept_id);
            if ($stmt->execute()) {
                echo "<script>alert('Department updated successfully!'); window.location.href='./add-departments.php';</script>";
            } else {
                echo "<script>alert('Error updating department!');</script>";
            }
        } else {
            echo "<script>alert('Department name cannot be empty!');</script>";
        }
    }
}

if(isset($_GET["delete"]) && isset($_GET["did"])){
    $dept_id = $_GET["did"];
    $deleteDeptQuery = "DELETE FROM department WHERE Dept_id=?";
    $stmt = $conn->prepare($deleteDeptQuery);
    $stmt->bind_param("i", $dept_id);
    if ($stmt->execute()) {
        echo "<script>alert('Department deleted successfully!'); window.location.href='./add-departments.php';</script>";
    } else {
        echo "<script>alert('Error deleting department!');</script>";
    }
}

// Handling Add Department
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET["edit"])) {
    $new_dept_name = $_POST["sname"];
    if (!empty($new_dept_name)) {
        // Check if the department name already exists
        $checkDeptQuery = "SELECT COUNT(*) as count FROM department WHERE Dept_name=?";
        $stmt = $conn->prepare($checkDeptQuery);
        $stmt->bind_param("s", $new_dept_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            echo "<script>alert('Department name already exists!');</script>";
        } else {
            $insertDeptQuery = "INSERT INTO department (Dept_name) VALUES (?)";
            $stmt = $conn->prepare($insertDeptQuery);
            $stmt->bind_param("s", $new_dept_name);
            if ($stmt->execute()) {
                echo "<script>alert('Department added successfully!'); window.location.href='./add-departments.php';</script>";
            } else {
                echo "<script>alert('Error adding department!');</script>";
            }
        }
    } else {
        echo "<script>alert('Department name cannot be empty!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/add-departments.css">
    <title>Add Departments</title>
    <script>
        function confirmDelete(deptId) {
            if (confirm("Are you sure you want to delete this department?\nAll DATA ASSOCIATED WITH THIS DEPARTMENT WILL BE DELETED (JOBS,STUDENTS,PLACEMENT COORDINATORS)\nThis action cannot be undone.")) {
                window.location.href = './add-departments.php?delete=1&did=' + deptId;
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
                        <a href="./dashboard.php">
                            <i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i>
                        </a>
                        Departments
                    </h2>
                </div>

                <h3><?php echo isset($dept_name) ? 'Edit Department' : 'Add Department'; ?></h3>
                <div class="form-adjust">
                    <form action="" method="post">
                        <div class="inputbox">
                            <label for=""><b>Department Name:</b></label>
                            <input type="text" name="sname" placeholder="Department" value="<?php echo isset($dept_name) ? $dept_name : ''; ?>">
                        </div>
                        <div class="button-container">
                            <button name="student-search-button" class="add-button"><?php echo isset($dept_name) ? 'Update' : 'Add'; ?></button>
                        </div>
                    </form>
                </div>

                <div class="sections">
                    <table>
                        <tr>
                            <th>Department Name</th>
                            <th>Students</th>
                            <th>View Classes</th>
                            <th>Edit Department Name</th>
                            <th>Remove Department</th>
                        </tr>
                        <?php
                            global $conn;
                            $fetchDepartmentQuery = "SELECT Dept_name,Dept_id FROM department;";
                            $fetchDepartment = $conn->prepare($fetchDepartmentQuery);
                            $fetchDepartment->execute();
                            $result = $fetchDepartment->get_result();
                            while ($row = $result->fetch_assoc()){
                                $fetchStudentsQuery = "SELECT COUNT(*) as total FROM student as s
                                INNER JOIN class as c on c.Class_id=s.S_Class_id
                                INNER JOIN department as d on c.Dept_id=d.Dept_id
                                WHERE d.Dept_id = ?;";
                                $fetchStudents = $conn->prepare($fetchStudentsQuery);
                                $fetchStudents->bind_param("i",$row["Dept_id"]);
                                $fetchStudents->execute();
                                $totalresult = $fetchStudents->get_result();
                                $row1 = $totalresult->fetch_assoc();
                                $total = $row1["total"];
                                echo '<tr>
                                            <td>'.$row["Dept_name"].'</td>
                                            <td>'.$total.'</td>
                                            <td><a href="./add-classes.php?did='.$row["Dept_id"].'"><button class="edit-button">Classes</button></a></td>
                                            <td><a href="./add-departments.php?edit=1&did='.$row["Dept_id"].'"><button class="edit-button">Edit</button></a></td>
                                            <td><button class="remove-button" style="color:red" onclick="confirmDelete('.$row["Dept_id"].')">Remove</button></td>
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
