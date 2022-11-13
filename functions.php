<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;  

// funtions.php is empty so you can easily track what code is needed in order to Vite + Tailwind JIT run well


// Main switch to get fontend assets from a Vite dev server OR from production built folder
// it is recommeded to move it into wp-config.php
define('IS_VITE_DEVELOPMENT', false);

include "inc/inc.php";
include "inc/inc.vite.php";

include "Components/include.php";


