<?php

// Libera o acesso do wp-login por 2 minutos
setcookie('fam_acesso_wp', '0c47936260c6a1ff14a47d11947aa418', time() + 60 * 5, '/');

header('Location: /wp-login.php');