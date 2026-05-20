<?php
include 'server.php';

$student_id = 1;

$profile_result = mysqli_query($conn, "SELECT * FROM education_profile WHERE student_id=$student_id");
$profile = mysqli_fetch_assoc($profile_result);
$profile_exists = $profile ? true : false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $metric = $_POST['metric'] ?? 0;
    $inter = $_POST['inter'] ?? 0;
    $has_bs = $_POST['has_bs'] ?? 'no';
    $bs_cgpa = $_POST['bs_cgpa'] ?? 0;
    $has_ms = $_POST['has_ms'] ?? 'no';
    $ms_cgpa = $_POST['ms_cgpa'] ?? 0;

    if (isset($_POST['save'])) {
        if ($profile_exists) {
            mysqli_query($conn, "UPDATE education_profile SET
                metric_percentage='$metric',
                inter_percentage='$inter',
                has_bs='$has_bs',
                bs_cgpa='$bs_cgpa',
                has_ms='$has_ms',
                ms_cgpa='$ms_cgpa'
                WHERE student_id=$student_id
            ");
        } else {
            mysqli_query($conn, "INSERT INTO education_profile 
                (student_id, metric_percentage, inter_percentage, has_bs, bs_cgpa, has_ms, ms_cgpa)
                VALUES ($student_id, '$metric', '$inter', '$has_bs', '$bs_cgpa', '$has_ms', '$ms_cgpa')
            ");
        }
        header("Location: scholarships.php");
        exit();
    }

    if (isset($_POST['update'])) {
        mysqli_query($conn, "UPDATE education_profile SET
            metric_percentage='$metric',
            inter_percentage='$inter',
            has_bs='$has_bs',
            bs_cgpa='$bs_cgpa',
            has_ms='$has_ms',
            ms_cgpa='$ms_cgpa'
            WHERE student_id=$student_id
        ");
        header("Location: scholarships.php");
        exit();
    }

    if (isset($_POST['delete'])) {
        mysqli_query($conn, "DELETE FROM education_profile WHERE student_id=$student_id");
        header("Location: profile.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Education Profile</title>
</head>
<body>
<h2>Student Education Profile Form</h2>

<form method="POST" action="profile.php">
    
    <label>Metric Percentage:</label><br>
    <input type="number" step="0.01" name="metric" value="<?= $profile['metric_percentage'] ?? '' ?>" required><br><br>

    
    <label>Inter Percentage:</label><br>
    <input type="number" step="0.01" name="inter" value="<?= $profile['inter_percentage'] ?? '' ?>" required><br><br>

    
    <label>Have you done BS?</label><br>
    <select name="has_bs" required>
        <option value="yes" <?= (isset($profile['has_bs']) && $profile['has_bs']=='yes')?'selected':'' ?>>Yes</option>
        <option value="no" <?= (isset($profile['has_bs']) && $profile['has_bs']=='no')?'selected':'' ?>>No</option>
    </select><br><br>

    <label>BS CGPA:</label><br>
    <input type="number" step="0.01" name="bs_cgpa" value="<?= $profile['bs_cgpa'] ?? '' ?>"><br><br>

    <label>Have you done MS?</label><br>
    <select name="has_ms" required>
        <option value="yes" <?= (isset($profile['has_ms']) && $profile['has_ms']=='yes')?'selected':'' ?>>Yes</option>
        <option value="no" <?= (isset($profile['has_ms']) && $profile['has_ms']=='no')?'selected':'' ?>>No</option>
    </select><br><br>

    <label>MS CGPA:</label><br>
    <input type="number" step="0.01" name="ms_cgpa" value="<?= $profile['ms_cgpa'] ?? '' ?>"><br><br>

    <?php if ($profile_exists): ?>
        <button type="submit" name="update">Update</button>
        <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete your profile?')">Delete</button>
    <?php else: ?>
        <button type="submit" name="save">Save</button>
    <?php endif; ?>
</form>

</body>
</html>
