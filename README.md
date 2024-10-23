# title-and-description-checker
This PHP project allows users to upload a CSV file with URLs and automatically checks each webpage for meta titles and descriptions. It fetches the HTML content, extracts the relevant meta tags, and saves the results in a new downloadable CSV file for easy review and analysis.
# Explanation of the Code:
HTML Form: The form in index.php allows the user to upload a .csv file. It uses the POST method and sends the file to process.php.

# File Upload and Processing (process.php):

The uploaded file is saved to a directory called uploads/.
The file is then opened and processed line by line.
For each URL, the function check_meta_tags is called, which uses PHP’s DOMDocument to load the HTML and extract the <title> and <meta name="description"> tags.
The extracted data is stored in a new CSV file (meta_results.csv), which the user can download after processing.
# Meta Tag Extraction:

The check_meta_tags function takes a URL as input and tries to fetch its content using file_get_contents().
It uses DOMDocument to parse the HTML and extract the title and description meta tags.
CSV Output: The processed results are written to a new CSV file that the user can download.

# Usage:
Upload a CSV file (e.g., url_list.csv) containing URLs.
The server processes the file and checks for meta titles and descriptions for each URL.
Once completed, the user is given a download link for the CSV file with the results.

# Notes:
Error Handling: If a URL cannot be fetched, an error message will be placed in the result CSV file.
File Storage: Uploaded CSV files and result files are stored in the uploads/ directory. You may want to add a cleanup routine to remove old files after a certain period.
This project should give you a fully functional PHP-based tool for uploading CSV files and checking meta tags from URLs!
