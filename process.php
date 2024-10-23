<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv_file'])) {
    // Define path to store the uploaded file
    $upload_dir = 'uploads/';
    $upload_file = $upload_dir . basename($_FILES['csv_file']['name']);
    
    // Ensure the uploads directory exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Move the uploaded file to the server
    if (move_uploaded_file($_FILES['csv_file']['tmp_name'], $upload_file)) {
        echo "File uploaded successfully. Processing...<br>";

        // Process the CSV file
        $file = fopen($upload_file, 'r');
        $results = [];
        $header = ['URL', 'Title', 'Description'];

        // Open a new CSV file to store the results
        $output_csv = $upload_dir . 'meta_results_' . time() . '.csv';
        $output_file = fopen($output_csv, 'w');
        fputcsv($output_file, $header);  // Write CSV header

        // Iterate through each URL in the CSV
        while (($data = fgetcsv($file)) !== FALSE) {
            $url = $data[0];
            $result = check_meta_tags($url);
            fputcsv($output_file, $result);  // Save the result to output CSV
        }

        fclose($file);
        fclose($output_file);

        echo "Meta tags checked. <a href='$output_csv'>Download the results here</a>.";

    } else {
        echo "File upload failed.";
    }
}

// Function to check meta title and description
function check_meta_tags($url) {
    $title = "No title found";
    $description = "No description found";

    // Suppress warnings from DOMDocument in case of invalid HTML
    libxml_use_internal_errors(true);

    // Fetch the HTML content
    $html = @file_get_contents($url);

    if ($html) {
        $doc = new DOMDocument();
        $doc->loadHTML($html);

        // Extract the title
        $title_tags = $doc->getElementsByTagName('title');
        if ($title_tags->length > 0) {
            $title = $title_tags->item(0)->textContent;
        }

        // Extract the meta description
        $meta_tags = $doc->getElementsByTagName('meta');
        foreach ($meta_tags as $meta) {
            if ($meta->getAttribute('name') == 'description') {
                $description = $meta->getAttribute('content');
                break;
            }
        }
    } else {
        $title = "Error fetching URL";
    }

    return [$url, $title, $description];
}
