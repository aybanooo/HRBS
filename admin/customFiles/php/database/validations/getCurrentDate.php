<?php
require_once("../../directories/directories.php");
require_once(__validations__);

echo json_encode(getCurrentDateAsUTCtimestamp());
?>