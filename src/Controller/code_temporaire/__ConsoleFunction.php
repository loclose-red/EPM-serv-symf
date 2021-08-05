<?php

    // petite fonction pour créer un consolelog artificiel
    // usage: consoleLog('coucou'); 
    function consoleLog($msg)
    {
        echo '<script type="text/javascript">console.log('
            . str_replace('<', '\\x3C', json_encode($msg))
            . ');</script>';
    }

