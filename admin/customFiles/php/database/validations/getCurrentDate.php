<?php
require_once("../../directories/directories.php");
require_once(__F_VALIDATIONS__);
checkAdminSideAccess();

echo json_encode(getCurrentDateAsUTCtimestamp());
?>