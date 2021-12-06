<?php

if (!function_exists('getLocale')) {
    function getLocale()
    {
        return app()->getLocale();
    }
}

if (!function_exists('checkLocale')) {
    function checkLocale($locale)
    {
        return app()->isLocale($locale) ? true : false;
    }
}

if (!function_exists('getFullQuery')) {
    function getFullQuery($query)
    {
        $sql = $query->toSql();
        foreach ($query->getBindings() as $binding) {
            $value = is_numeric($binding) ? $binding : "'" . $binding . "'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        return $sql;
    }
}

if (!function_exists('getTimeAgo')) {
    function getTimeAgo($date, $full = false)
    {
        $now = now();
        $ago = date('Y-m-d H:i:s', strtotime($date));
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

if (!function_exists('sliceDate')) {
    function sliceDate($date, $format)
    {
        return date($format, strtotime($date));
    }
}

if (!function_exists('formatMoney')) {
    function formatMoney($price)
    {
        $money = number_format($price, 0, ",", ".") . ' VND';
        return $money;
    }
}

if (!function_exists('onlyDateTime')) {
    function onlyDateTime($date)
    {
        return date('d-m-Y', strtotime($date));
    }
}

if (!function_exists('shortString')) {
    /**
     * Making short string
     *
     * @param $string
     * @param int $char
     * @param bool $hasDot
     * @return bool|string
     */
    function shortString($string, $char = 30, $hasDot = true)
    {
        $newString = substr($string, 0, $char);
        $newString = $hasDot ? $newString . ' ...' : $newString;
        return $newString;
    }
}

if (!function_exists('sendSuccess')) {

    /**
     * Return success response
     *
     * @param $data
     * @param string $message
     * @return array
     */

    function sendSuccess($data, $message = '')
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message,
        ];

        return $response;
    }
}

if (!function_exists('sendError')) {
    /**
     * Return error response
     *
     * @param $data
     * @param string $errorMessages
     * @return array
     */

    function sendError($data, $errorMessages = '')
    {
        $response = [
            'success' => false,
            'data' => [],
            'message' => $errorMessages,
        ];
        if (!empty($data)) {
            $response['data'] = $data;
        }

        return $response;
    }
}

if (!function_exists('formatDigits')) {

    /**
     * Number format 5 digits
     *
     * @param $number
     * @param $length
     * @return string
     */
    function formatDigits($number, $length)
    {
        return str_pad($number, $length, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('successReturn')) {

    /**
     * @param $result
     * @param $message
     * @param $name
     * @param $code
     * @return array
     */
    function successReturn($result, $message, $name, $code)
    {
        return [
            'response' => sendSuccess($result, __($message, ['name' => $name])),
            'code' => $code
        ];
    }
}

if (!function_exists('errorReturn')) {

    /**
     * @param $result
     * @param $message
     * @param $name
     * @param $code
     * @return array
     */
    function errorReturn($result, $message, $name, $code)
    {
        return [
            'response' => sendError($result, __($message, ['name' => $name])),
            'code' => $code
        ];
    }
}

