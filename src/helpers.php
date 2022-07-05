<?php

if (! function_exists('addy_scripts') ) :

    function addy_scripts(): string {
        return '<script src="'.asset('path').'"/>';
    }

endif;