<?php if (!empty($_POST)): 
    $file = '../config.php';
    
	$contents = "<?php \n";
    $contents .= "//Database details \n";
    $contents .= "define ('DB_HOST', '".$_POST['dbHost']."'); \n";
    $contents .= "//Username \n";
    $contents .= "define ('DB_USERNAME', '".$_POST['dbUserName']."'); \n";
    $contents .= "//Pass \n";
    $contents .= "define ('DB_PASS', '".$_POST['dbPass']."'); \n";
    $contents .= "//Database Name \n";
	$contents .= "define ('DB_NAME', '".$_POST['dbName']."'); \n";
	$contents .= "//Base URL \n";
	$contents .= "define ('BASE_URL', 'http://".$_POST['siteURL']."'); \n";
	$contents .= "//Email/Cookie URL \n";
	$contents .= "define ('EMAIL_URL', '".$_POST['siteURL']."'); \n";
	$contents .= "?>";	
	
	$mysql_host = $_POST['dbHost'];
	$mysql_username = $_POST['dbUserName'];
	$mysql_password = $_POST['dbPass'];
	$mysql_database = $_POST['dbName'];
	// Name of the file
$filename = 'hoosk.sql';


// Connect to MySQL server
mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{ 
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == '~')
{
	$templine = str_replace(";~", ";", $templine);
    // Perform the query
    mysql_query($templine) or die(print('Error performing query \'<strong>' . htmlspecialchars($templine) . '\': ' . mysql_error() . '<br /><br />'));
    // Reset temp variable to empty
    $templine = '';
}
}
file_put_contents($file, $contents);
// Create connection
$conn = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE hoosk_settings SET siteTitle='".$_POST['siteName']."' WHERE siteID=0";

if ($conn->query($sql) === TRUE) {
   } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Install Hoosk</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="./css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
<link href="./css/styles.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

<!-- JUMBOTRON 
=================================-->
<div class="jumbotron text-center errorpadding">
    <div class="container">
      <div class="row">
        <div class="col col-lg-12 col-sm-12">
        <img src="images/large_logo.png" />
        <h1>Installation Completed!</h1>
        <p>The default username is admin and password is h00sk</p>
        <p><strong>Change these when you login!</strong></p>
        <p>Please now delete the /install directory</p>
		<a href="http://<?php echo $_POST['siteURL']; ?>/admin" class="btn-success btn">Login</a>
        </div>
      </div>
    </div> 
</div>
<!-- /JUMBOTRON container-->

    <!-- FOOTER
    =================================-->
    <div class="container">
     <p>&copy; Hoosk 2014</p>
    </div>
	<!-- /FOOTER ============-->

   	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>

<?php else: ?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Install Hoosk</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="./css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
<link href="./css/styles.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

<!-- JUMBOTRON 
=================================-->
<div class="jumbotron text-center errorpadding">
    <div class="container">
      <div class="row">
        <div class="col col-lg-12 col-sm-12">
        <img src="images/large_logo.png" />
        <h1>Install Hoosk.</h1>

        </div>
      </div>
    </div> 
</div>
<!-- /JUMBOTRON container-->
<!-- CONTENT
=================================-->
<div class="container text-center">
	<div class="row" id="getDetails">
    <div class="col col-lg-3 col-sm-3"></div>
    	<div class="col col-lg-6 col-sm-6">
        <div class="alert alert-info">All fields are required!</div>
            <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
        		<div class="control-group">		
					<label class="control-label" for="siteName">Site Name</label>
					<div class="controls">
						<input type="text" id="siteName" name="siteName" class="span5">
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
        		<div class="control-group">		
					<label class="control-label" for="siteURL">Site URL (without http:// or trailing slash)</label>
					<div class="controls">
						<input type="text" id="siteURL" name="siteURL" value="" class="span5">
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
        		<hr>
        		<div class="control-group">		
					<label class="control-label" for="dbName">Database Name</label>
					<div class="controls">
						<input type="text" id="dbName" name="dbName" class="span5">
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
        		<div class="control-group">		
					<label class="control-label" for="dbUserName">Database Username</label>
					<div class="controls">
						<input type="text" id="dbUserName" name="dbUserName" class="span5">
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
        		<div class="control-group">		
					<label class="control-label" for="dbPass">Database Password</label>
					<div class="controls">
						<input type="text" id="dbPass" name="dbPass" class="span5">
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
         		<div class="control-group">		
					<label class="control-label" for="dbHost">Database Host</label>
					<div class="controls">
						<input type="text" id="dbHost" name="dbHost" value="localhost" class="span5">
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
        
        <button class="btn-primary btn">Install</button>
        </div>
        <div class="col col-lg-3 col-sm-3"></div>
	</div>
  	<hr>
</div>
<!-- /CONTENT ============-->

    <!-- FOOTER
    =================================-->
    <div class="container">
     <p>&copy; Hoosk 2014</p>
    </div>
	<!-- /FOOTER ============-->

   	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
<?php endif; ?>