<?php 
/**
 * BySwadi
 * Used functions in the project
 * php version 7.3.1
 *
 * @category Utilities
 * @package  App\Globals
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  BySwadi https://www.muath.swadi
 * @link     BySwadi https://www.muath.swadi/
 */
namespace App\Helpers;


/**
 * Used functions in the project
 *
 * @category Utilities
 * @package  App\Globals
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  BySwadi https://www.muath.swadi
 * @link     BySwadi https://www.muath.swadi/
 */
class Utilities
{
    /**
     * Check if an array is a multidimensional array.
     *
     * @param array $x The array to check
     * 
     * @return boolean Whether the the array is a multidimensional array or not
     */
    public static function isMultiArray( $x )
    {
        if (count(array_filter($x, 'is_array')) > 0) {
            return true;  
        } 
        return false;
    }

    /**
     * Convert an object to an array.
     *
     * @param array $object The object to convert
     * 
     * @return array The converted array
     */
    public static function objectToArray($object) 
    {
        if (!is_object($object) && !is_array($object) ) {
            return $object;
        }
        
        return array_map('\App\Helpers\Utilities::objectToArray', (array) $object);
    }

    /**
     * Check if a value exists in the array/object.
     *
     * @param $needle   mixed The value that you are searching for
     * @param $haystack mixed The array/object to search
     * @param $strict   boolean Whether to use strict search or not 
     * 
     * @return boolean Whether the value was found or not
     */
    public function searchForValue($needle, $haystack, $strict=true ) 
    {
        $haystack = Utilities::objectToArray($haystack);
        if (is_array($haystack) ) {
            if (Utilities::isMultiArray($haystack)) {
                // Multidimensional array
                foreach ($haystack as $subhaystack) {
                    if (Utilities::searchForValue($needle, $subhaystack, $strict)) {
                        return true;
                    }
                }
            } elseif (array_keys($haystack) !== range(0, count($haystack) - 1) ) {
                // Associative array
                foreach ($haystack as $key => $val) {
                    if ($needle == $val && !$strict) {
                        return true;
                    } elseif ($needle === $val && $strict) {
                        return true;
                    }
                }
                return false;
            } else {
                // Normal array
                if ($needle == $haystack && !$strict) {
                    return true;
                } elseif ($needle === $haystack && $strict) {
                    return true;
                }
            }
        }
        return false;
    }


    /**
     * Check if a value exists in the array/object.
     * For Global use [same as searchForValue()]
     *
     * @param mixed   $needle   The value that you are searching for
     * @param mixed   $haystack The array/object to search
     * @param boolean $strict   Whether to use strict search or not
     * 
     * @return boolean Whether the value was found or not
     */
    public static function inArrayOrObject($needle, $haystack, $strict=true) 
    {
        $haystack = Utilities::objectToArray($haystack);
        if (is_array($haystack)) {
            if (Utilities::isMultiArray($haystack)) {
                // Multidimensional array
                foreach ($haystack as $subhaystack) {
                    if (Utilities::inArrayOrObject($needle, $subhaystack, $strict)) {
                        return true;
                    }
                }
            } elseif (array_keys($haystack) !== range(0, count($haystack) - 1)) {
                // Associative array
                foreach ($haystack as $key => $val) {
                    if ($needle == $val && !$strict) {
                        return true;
                    } elseif ($needle === $val && $strict) {
                        return true;
                    }
                }
                return false;
            } else {    
                // Normal array
                if ($needle == $haystack && !$strict) {
                    return true;
                } elseif ($needle === $haystack && $strict) {
                    return true;
                }
            }
        }
        return false;
    }

}
