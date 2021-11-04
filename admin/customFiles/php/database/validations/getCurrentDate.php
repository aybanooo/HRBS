<?php
require_once("../../directories/directories.php");
require_once(__F_VALIDATIONS__);

echo json_encode(getCurrentDateAsUTCtimestamp());
?>