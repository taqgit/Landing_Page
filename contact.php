<?php
	function send_mail($email, $fullname, $message){
		$to = "admin@carmazon.ca";

		$from = "no-reply@carmazon.ca";

		$subject = $fullname. " is trying to reach Carmazon";


		$body	='<body style="font-size: 16px">
							Email: '.$email.'<br>
							Full Name: '.$fullname.'<br>
							Message: '.$message.'
						</body>';

		$ers = "MIME-Version:1.0\r\n";

		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

		$headers .= "From: Carmazon<'".$from."'>\r\n";

		$res;
		if(mail($to,$subject,$body,$headers)){
		  $res = array('submitted' => true);

		}
		else {
			$res = array('submitted' => false);
		}
		echo json_encode($res);
	}

	function post_data($url){
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER ,true);
		curl_exec($curl);
		curl_close($curl);
	}


	if(isset($_POST)){
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		if($_POST['message']){
			$message = $_POST['message'];
		}
		elseif ($_POST['phone']) {
			$message = $_POST['phone'];
		}
		// $url = "https://k7lj0tpl5j.execute-api.ca-central-1.amazonaws.com/dev/signup" -H "accept: application/json" -H "Content-Type: application/json" -d "{\"name\":\"".$full_name."\",\"surname\":\"\",\"email\":\"".$email."\",\"password\":\"Password1!\",\"phone\":\"4164161234\",\"postalCode\":\"L5M4Z5\",\"address\":\"string\",\"isEmailVerified\":false,\"isPhoneVerified\":false}"
		// $url = "https://www.google.com";
		// post_data($url);
		send_mail($email, $fullname, $message);
	}
 ?>
