<?php
    //echo password_hash('secret', PASSWORD_BCRYPT, array('cost' => 12));
    echo password_hash('secret', PASSWORD_ARGON2I);