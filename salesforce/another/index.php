<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>
        <!-- Page content-->
        <div class="container">
<?php
exit;
if ( $_POST['email_domain'] ) {

    $email = $_POST['email_domain'];
     
    // make sure we've got a valid email
    if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        // split on @ and return last value of array (the domain)
        $domain = array_pop(explode('@', $email));

        require __DIR__ . '/vendor/autoload.php';

        $options = [
            'grant_type' => 'password',
            'client_id' => '3MVG9xqN3LZmHU7kmCib7q..30wJpJvK59R9jApG4Okk283gOk2PJBJ7c7dVpjDDrTNQtqIEKQ1.oSKR6uvdr',
            'client_secret' => '4E9517506B7D5834BB48B43125B59A42F5706D379038AA7AB65B6C0A46D966BF',
            'username' => 'peoplesafe@chillibyte.co.uk.staging',
            'password' => 'wobCeb-6niqxe-tevbecMusK6XWQMdlfvTb0yqLN2WiZU'
        ];

        $salesforce = new bjsmasth\Salesforce\Authentication\PasswordAuthentication($options);
        $salesforce->setEndpoint('https://test.salesforce.com/');
        $salesforce->authenticate();

        $access_token = $salesforce->getAccessToken();
        $instance_url = $salesforce->getInstanceUrl();

        $query = "SELECT Name, Email FROM Lead WHERE Email LIKE '%" . $domain . "' LIMIT 1";

        $crud = new \bjsmasth\Salesforce\CRUD();
        $testing = $crud->query($query);

        //echo $testing['records'][0]['Email'];
        //echo "<br>";
        //echo count($testing['records']);
        //echo "<br>";

        if ( count($testing['records']) > 0 ) {
            echo '<div class="mt-5">';
            echo "<h1>Email domain - " . $domain . " - has been found in Salesforce!</h1>";
            echo "<h2>" . $testing['records'][0]['Name'] . "</h2>";
            echo "<h2>" . $testing['records'][0]['Email'] . "</h2>";
            echo '</div>';
        } else {
            echo '<div class="mt-5">';
            echo "<h1>Email domain - " . $domain . " - has NOT been found in Salesforce!</h1>";
            echo '</div>';
        }

        //echo "<pre>";
        //print_r($testing);
        //echo "</pre>";
    }
}
?>          
            <div class="mt-5">      
                <form method="post">
                    <div class="mb-3">
                        <label for="email_domain" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email_domain" name="email_domain" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>