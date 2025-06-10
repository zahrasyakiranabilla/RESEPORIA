<?php

if (!function_exists('highlightSearch')) {
    function highlightSearch($text, $query) {
        if (empty($query)) {
            return $text;
        }
        
        return preg_replace(
            '/(' . preg_quote($query, '/') . ')/i',
            '<mark class="bg-yellow-200 px-1 rounded">$1</mark>',
            $text
        );
    }
}