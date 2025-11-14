<?php
namespace App\Helper;

// Provide a helper class with a static method so callers can use
// App\Helper\customHelp::formatName(...) as well as the function.
class customHelp
{
    public static function formatName($name)
    {
        // trim + normalize casing
        return trim(ucwords(strtolower($name)));
    }
}

