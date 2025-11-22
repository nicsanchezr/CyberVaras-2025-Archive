<?php
// Este script solo puede ser visto por localhost
if ($_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '::1') {
    echo "ACCESO INTERNO CONCEDIDO. flag{l00pb4ck_is_n0t_s4f3}";
} else {
    echo "ACCESO DENEGADO. Solo visible desde localhost. Tu IP: " . $_SERVER['REMOTE_ADDR'];
}
?>
