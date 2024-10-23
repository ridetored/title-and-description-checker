<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meta Tag Checker</title>
</head>
<body>
    <h1>Upload CSV File to Check Meta Titles and Descriptions</h1>
    <form action="process.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="csv_file" accept=".csv" required>
        <button type="submit">Upload and Check</button>
    </form>
</body>
</html>
