<?php
include 'server.php';
$student_id = 1;

$profile = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM education_profile WHERE student_id=$student_id")
);

$metric = $profile['metric_percentage'];
$inter  = $profile['inter_percentage'];
$bs     = $profile['bs_cgpa'];
$has_bs = $profile['has_bs'];
$ms     = $profile['ms_cgpa'];
$has_ms = $profile['has_ms'];

$scholarships_result = mysqli_query($conn, "SELECT * FROM scholarships");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Scholarships</title>
</head>
<body>

<h2>Search Scholarships</h2>
<a href="search_scholarships.php">Click here to search scholarships manually</a>
<hr>

<h2>Available Scholarships Based on Your Profile</h2>

<?php
$shown = false;

while ($sch = mysqli_fetch_assoc($scholarships_result)) {
    $eligible = false;

    if ($sch['degree'] == 'BS' && $has_bs == 'yes' && $bs >= $sch['min_cgpa']) {
        $eligible = true;
    }
    if ($sch['degree'] == 'MS' && $has_ms == 'yes' && $ms >= $sch['min_cgpa']) {
        $eligible = true;
    }

    if ($eligible) {
        $shown = true;
        echo "<h3>{$sch['name']}</h3>";
        echo "Institute: {$sch['institute']}<br>";
        echo "Degree Required: {$sch['degree']}<br>";
        echo "Minimum CGPA: {$sch['min_cgpa']}<br>";
        echo "Country: {$sch['country']}<br>";
        echo "Benefits: {$sch['benefits']}<br><br>";
    }
}

if (!$shown) {
    echo "No scholarships match your current education profile.";
}
?>

</body>
</html>
