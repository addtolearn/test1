<?php
$api_key = "a4e49fda362394bf07847be2b98e2ae1"; // Your API Key Here
if(isset($_POST['aadhar_number'])) {
    $aadhaar_no = base64_encode($_POST['aadhar_number']);
    $url = 'https://apizone.in/api/v1/services/short_pan/shortonly.php?aadhaar='.$aadhaar_no.'&api_key='.$api_key;

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $resdata = json_decode($response, true);

    // Process and display the response
    if (isset($resdata['status']) && $resdata['status'] === 'success') {
        echo "Aadhar Number: " . $_POST['aadhar_number'] . "<br>";
        echo "Short PAN: " . $resdata['short_pan'] . "<br>";
        // Display any other information you want to show
    } else {
        echo "Error: " . $resdata['message'];
    }
}
?>
