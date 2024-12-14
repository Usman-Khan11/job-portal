<?php

if (!function_exists('uploadFile')) {
    function uploadFile($file, $path, $oldFile = '')
    {
        if (!empty($oldFile)) {
            deleteImage($oldFile);
        }

        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $year = date('Y');
        $month = date('m');
        $path = rtrim($path, '/') . "/$year/$month/";
        $destination = public_path($path);

        // Ensure directory exists
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);
        return rtrim($path, '/') . '/' . $filename;
    }
}

if (!function_exists('deleteImage')) {
    function deleteImage($filePath)
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}

if (!function_exists('menuActive')) {
    function menuActive($routeName, $type = null)
    {
        if ($type == 3) {
            $class = 'side-menu-open';
        } elseif ($type == 2) {
            $class = 'active open';
        } else {
            $class = 'active';
        }
        if (is_array($routeName)) {
            foreach ($routeName as $key => $value) {
                if (request()->routeIs($value)) {
                    return $class;
                }
            }
        } elseif (request()->routeIs($routeName)) {
            return $class;
        }
    }
}
