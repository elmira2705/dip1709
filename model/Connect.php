<?php
    ini_set( "display_errors", true );
    define( "DB_USERNAME", "aktambaeva" );
    define( "DB_NAME", "aktambaeva" );
    define( "DB_PASSWORD", "neto1710" );
    define( "CHARSET", "utf8" );
    define( "DB_DSN", "mysql:host=localhost;dbname=" . DB_NAME . ";charset=" . CHARSET );

    function handleException( $exception ) {
        echo "Error";
        error_log($exception->getMessage(), 3, 'log.txt');
    }

    set_exception_handler( 'handleException' );
