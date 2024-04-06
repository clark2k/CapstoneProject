<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Print Custom Certificate</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2; /* Light gray background */
    color: #333; /* Dark text color */
    margin: 0;
    padding: 0;
  }
  h1 {
    text-align: center;
    color: #003300; /* Dark green for headings */
  }
  #container {
    max-width: 800px;
    margin: 20px auto;
    background-color: #fff; /* White background for container */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Light shadow */
  }
  #downloadBtn {
    display: block;
    width: 200px;
    margin: 20px auto;
    padding: 10px 20px;
    background-color: #4CAF50; /* Green button background */
    color: #fff; /* White text color */
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
  }
  #downloadBtn:hover {
    background-color: #45a049; /* Darker green on hover */
  }
  #instructions {
    text-align: center;
    margin-top: 20px;
    color: #666; /* Gray text color for instructions */
  }
</style>
</head>
<body>

<div id="container">

<h1>Print Custom Certificate</h1>

<!-- Button to download default certificate file -->
<a id="downloadBtn" href="Certificate.docx" download>Download Default Certificate</a>

<!-- Instructions for editing and printing -->
<div id="instructions">
  <p>1. Download the default certificate file using the button above.</p>
  <p>2. Open the downloaded file in Microsoft Word or any other compatible program.</p>
  <p>3. Edit the certificate as needed.</p>
  <p>4. Print the edited certificate from the program.</p>
</div>

</div>

</body>
</html>
