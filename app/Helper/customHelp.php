<?php
namespace App\Helper;

// Backwards-compatible helper function
if (!function_exists('\App\Helper\FormatName')) {
    function FormatName($name)
    {
        return ucwords(strtolower($name));
    }
}

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

