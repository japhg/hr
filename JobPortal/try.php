<?php

require_once 'special_features/vendor/autoload.php';
require_once 'special_features/vendor/convertapi/convertapi-php/lib/ConvertApi/autoload.php';

use \ConvertApi\ConvertApi;

ConvertApi::setApiSecret('KtIpjO4BQuxnmeDD');
$result = ConvertApi::convert('pdf', ['File' => 'ResumeJames.docx']);

# save to file
$result->getFile()->save('job/file.pdf');

# get file contents (without saving the file locally)
$contents = $result->getFile()->getContents();

?>
