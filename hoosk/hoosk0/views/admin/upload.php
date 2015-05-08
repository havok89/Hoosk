<?php

$attachment = $this->input->post('attachment');
$uploadedFile = $_FILES['attachment']['tmp_name']['file'];

$path = $_SERVER["DOCUMENT_ROOT"].'/images';
$url = BASE_URL.'/images';

// create an image name
$fileName = $attachment['name'];

// upload the image
move_uploaded_file($uploadedFile, $path.'/'.$fileName);

$this->output->set_output(json_encode(array('file' => array(
'url' => $url . '/' . $fileName,
'filename' => $fileName
))),
200,
array('Content-Type' => 'application/json')
);

exit;