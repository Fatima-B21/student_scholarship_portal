<?php
include 'server.php';

$results = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inst  = strtolower($_POST['institute'] ?? '');
    $deg   = strtolower($_POST['degree'] ?? '');
    $country = strtolower($_POST['country'] ?? '');
    $cgpa  = floatval($_POST['cgpa'] ?? 0);

    $query = "SELECT * FROM scholarships WHERE 1=1";

    if ($inst) $query .= " AND LOWER(institute) LIKE '%$inst%'";
    if ($deg) $query .= " AND LOWER(degree)='$deg'";
    if ($country) $query .= " AND LOWER(country)='$country'";
    if ($cgpa) $query .= " AND min_cgpa <= $cgpa";

    $results = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manual Scholarship Search</title>
</head>
<body>
<h2>Search Scholarships</h2>

<form method="POST">
    Institute Name: <input type="text" name="institute"><br><br>
    Degree: 
    <select name="degree">
        <option value="">--Any--</option>
        <option value="BS">BS</option>
        <option value="MS">MS</option>
    </select><br><br>
    Country: <input type="text" name="country"><br><br>
    Your CGPA: <input type="number" step="0.01" name="cgpa"><br><br>
    <button type="submit">Search</button>
</form>

<hr>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<h3>Search Results:</h3>";

    if (mysqli_num_rows($results) > 0) {
        while ($sch = mysqli_fetch_assoc($results)) {
            echo "<b>Institute:</b> {$sch['institute']}<br>";
            echo "<b>Degree Required:</b> {$sch['degree']}<br>";
            echo "<b>Country:</b> {$sch['country']}<br>";
            echo "<b>Minimum CGPA:</b> {$sch['min_cgpa']}<br>";
            echo "<b>Benefits:</b> {$sch['benefits']}<br><br>";
        }
    } else {
        echo "No scholarships found matching your criteria.";
    }
}
?>

</body>
</html>
