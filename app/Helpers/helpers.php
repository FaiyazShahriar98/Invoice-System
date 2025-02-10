<?php

if (!function_exists('sortIcon')) {
    function sortIcon($column, $sortColumn, $sortDirection) {
        if ($sortColumn === $column) {
            return $sortDirection === 'asc' ? '↓' : '↑';
        }
        return '';
    }
}
