
        <?php 
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        // The URL of the Tika Server API
        $tika_url = "http://localhost:9998/tika";

        // The path of the file to extract text from
        $file_path = "../ResumeJames.docx";

        // Read the file contents into a variable
        $file = file_get_contents($file_path);

        // Get the MIME type of the file
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file_path);
        finfo_close($finfo);

        // Create a cURL session
        $ch = curl_init();

        // Set the URL and other options for the cURL session
        curl_setopt($ch, CURLOPT_URL, $tika_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Accept: text/plain",
            "Content-Type: $mime_type"
        ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $file);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL session
        $content = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Close the cURL session
        curl_close($ch);
        

        // Check the HTTP status code
        if ($status_code == 200) {

            echo $content;

        }   
        ?>
<?php

//Your API key
$apiKey = "38c5b31a1721f717862290593433fd90710ee1fe";

// The text to be processed
$text = "This is a sample text for entity extraction. My email address is test@test.com and my phone number is 123-456-7890. I live in New York and my name is John Doe.";

$chunkSize = 1000;
$chunks = str_split($text, $chunkSize);

// API endpoint for NER
$endpoint = "https://api.nlpcloud.io/v1/en_core_web_lg/entities";

foreach ($chunks as $chunk) {
    // Prepare the API request for the chunk
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer " . $apiKey,
        "Content-Type: application/json"
    ));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("text" => $chunk)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
    // Send the API request and get the response
    $response = curl_exec($ch);
    curl_close($ch);
    // Decode the JSON response
    $result = json_decode($response, true);
  
    // Print the named entities
    $sortedEntities = [];
    foreach ($result["entities"] as $entity) {
        if (array_key_exists("entity", $entity) && ($entity["entity"] == "PERSON" || $entity["entity"] == "GPE")) {
        $sortedEntities[] = $entity;
    }
  }
  
  // Extract email addresses and phone numbers
  preg_match_all("/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/", $chunk, $emails);
  preg_match_all("/\b\d{3}[-.]?\d{3}[-.]?\d{4}\b/", $chunk, $phones);
  
  // Add the extracted email addresses and phone numbers to the list of entities
  foreach ($emails[0] as $email) {
      $sortedEntities[] = array(
          "text" => $email,
          "entity" => "EMAIL"
      );
  }
  foreach ($phones[0] as $phone) {
$sortedEntities[] = array(
"text" => $phone,
"entity" => "PHONE"
);
}

// Sort the entities by their start position
usort($sortedEntities, function ($a, $b) {
return $a["start"] - $b["start"];
});

// Print the sorted entities
foreach ($sortedEntities as $entity) {
echo $entity["text"] . " (" . $entity["entity"] . ")" . PHP_EOL;
}
}
?>
<?php
    // shell_exec('start /wait soffice --headless --convert-to pdf --outdir "." "../Classic_3_Functional-1.docx"');
?>


<?php

// URL of the File.io API
$url = "https://file.io/?expires=1w";

// Name of the input file
$file_name = "../ResumeJames.docx";

// Read the contents of the input file
$file_contents = file_get_contents($file_name);

// Create a cURL session
$curl = curl_init();

// Set the URL and other options for the cURL request
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, array('file' => '@'.$file_name));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Send the cURL request and get the response
$response = curl_exec($curl);

// Close the cURL session
curl_close($curl);

// Decode the JSON response
$response_json = json_decode($response, true);

// Get the URL of the PDF file
$pdf_url = $response_json["link"];

// Download the PDF file
$pdf_contents = file_get_contents($pdf_url);

// Save the PDF file
file_put_contents("output.pdf", $pdf_contents);

?>