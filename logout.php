<?php
session_start();
session_destroy();
?>
<script language="javascript">
alert("Anda yakin akan logout??");
document.location="form_login.php";
</script>