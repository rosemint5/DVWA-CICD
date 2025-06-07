<?php

if( isset( $_GET[ 'Login' ] ) ) {
	// Get username
	$user = $_GET[ 'username' ];

	// Get password
	$pass = $_GET[ 'password' ];
	$pass = md5( $pass );

	// Check the database
	$stmt = $GLOBALS["___mysqli_ston"]->prepare("SELECT * FROM users WHERE user = ? AND password = ?");
   	$stmt->bind_param("ss", $user, $pass); // ss = 2x string
    	$stmt->execute();
	$result = $stmt->get_result();

	if( $result && $result->num_rows === 1 ) {
		// Get users details
		$row    = $result->fetch_assoc();;
		$avatar = $row["avatar"];

		// Login successful
		$html .= "<p>Welcome to the password protected area {$user}</p>";
		$html .= "<img src=\"{$avatar}\" />";
	}
	else {
		// Login failed
		$html .= "<pre><br />Username and/or password incorrect.</pre>";
	}

	$stmt->close();
    	$GLOBALS["___mysqli_ston"]->close();
}

?>
