<?php
include 'server.php';
$message = '';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM scholarships WHERE id=$id");
    header("Location: manage_scholarships.php");
    exit();
}

$edit = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM scholarships WHERE id=$id"));
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $institute = $_POST['institute'];
    $degree = $_POST['degree'];
    $min_cgpa = $_POST['min_cgpa'];
    $country = $_POST['country'];
    $benefits = $_POST['benefits'];

    if (isset($_POST['id']) && $_POST['id'] != '') {
        $id = intval($_POST['id']);
        mysqli_query($conn, "UPDATE scholarships SET
            name='$name',
            institute='$institute',
            degree='$degree',
            min_cgpa='$min_cgpa',
            country='$country',
            benefits='$benefits'
            WHERE id=$id
        ");
        $message = "Scholarship updated successfully!";
    } else {
        mysqli_query($conn, "INSERT INTO scholarships 
            (name, institute, degree, min_cgpa, country, benefits)
            VALUES ('$name','$institute','$degree','$min_cgpa','$country','$benefits')");
        $message = "Scholarship added successfully!";
    }

    header("Location: manage_scholarships.php");
    exit();
}

$results = mysqli_query($conn, "SELECT * FROM scholarships");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Scholarships</title>
</head>
<body>
<h2><?= $edit ? 'Edit Scholarship' : 'Add New Scholarship' ?></h2>

<?php if($message) echo "<p>$message</p>"; ?>

<form method="POST">
    <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">
    Name: <input type="text" name="name" value="<?= $edit['name'] ?? '' ?>" required><br><br>
    Institute: <input type="text" name="institute" value="<?= $edit['institute'] ?? '' ?>" required><br><br>
    Degree: 
    <select name="degree" required>
        <option value="BS" <?= (isset($edit['degree']) && $edit['degree']=='BS')?'selected':'' ?>>BS</option>
        <option value="MS" <?= (isset($edit['degree']) && $edit['degree']=='MS')?'selected':'' ?>>MS</option>
    </select><br><br>
    Minimum CGPA: <input type="number" step="0.01" name="min_cgpa" value="<?= $edit['min_cgpa'] ?? '' ?>" required><br><br>
    Country: <input type="text" name="country" value="<?= $edit['country'] ?? '' ?>" required><br><br>
    Benefits: <textarea name="benefits" required><?= $edit['benefits'] ?? '' ?></textarea><br><br>
    <button type="submit" name="submit"><?= $edit ? 'Update Scholarship' : 'Add Scholarship' ?></button>
</form>

<hr>
<h2>All Scholarships</h2>
<table border="1" cellpadding="5">
<tr>
    <th>Name</th>
    <th>Institute</th>
    <th>Degree</th>
    <th>Min CGPA</th>
    <th>Country</th>
    <th>Benefits</th>
    <th>Actions</th>
</tr>

<?php while($sch = mysqli_fetch_assoc($results)) { ?>
<tr>
    <td><?= $sch['name'] ?></td>
    <td><?= $sch['institute'] ?></td>
    <td><?= $sch['degree'] ?></td>
    <td><?= $sch['min_cgpa'] ?></td>
    <td><?= $sch['country'] ?></td>
    <td><?= $sch['benefits'] ?></td>
    <td>
        <a href="manage_scholarships.php?edit=<?= $sch['id'] ?>">Edit</a> |
        <a href="manage_scholarships.php?delete=<?= $sch['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
    </td>
</tr>
<?php } ?>

</table>
</body>
</html>
