<?php



// if($result = file_get_contents('http://sms6.rmlconnect.net:8080/bulksms/bulksms?username=THRIIVEGLOBAL&password=y371H2Hv&type=0&dlr=1&source=THRIIV&message=We+have+connected+you+with+abhayt999yahoo-com+who+is+a+Verified+Therapist+.+This+conversation+is+completely+private+and+confidential&destination=919873476520'))
	// {
// echo "====".$result;
		// echo  generateJSON('success','Message sent successfully.','');
	// }
	// else
	// {
		// echo generateJSON('error','Message not sent successfully.','');	
	// }

// die;
if($_FILES['file']['name'] != ''){
    $test = explode('.', $_FILES['file']['name']);
    $extension = end($test);    
    $name = rand(100,999).'.'.$extension;

    $location = 'wp-content/uploads/'.$name;
    move_uploaded_file($_FILES['file']['tmp_name'], $location);
if($extension == 'docs' || $extension == 'doc' || $extension == 'docx')
{
	 echo '<img src="http://35.232.100.164/wp-content/uploads/imagesword.png" height="100" width="100" />&'.$location;
}
 // elseif($extension == 'xls' || $extension == 'xlsx')
// {
	 // echo '<img src="http://35.232.100.164/wp-content/uploads/imagesexcel.jpg" height="100" width="100" />&'.$location;
// }
 elseif($extension == 'pdf')
{
	 echo '<img src="http://35.232.100.164/wp-content/uploads/images.png" height="100" width="100" />&'.$location;
}
// elseif($extension == 'txt')
// {
	 // echo '<img src="http://35.232.100.164/wp-content/uploads/imagesfile.jpg" height="100" width="100" />&'.$location;
// }
 else if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png')
 {
 	echo '<img src="/'.$location.'" height="100" width="100" />&'.$location;
 }
else
{
echo 'Invalid File Format. Kindly upload the file in DOC, PDF, JPG, PNG format.&text';
}

   
}
    ?>