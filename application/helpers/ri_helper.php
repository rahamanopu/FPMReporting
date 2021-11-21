<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('getUserLevel')) {

    function getUserLevel($Designation)
    {
        if ($Designation == 'RSM') {
            $level = "Level3";
        } else if ($Designation == 'MSO') {
            $level = "Level1";
        } else if ($Designation == 'FM') {
            $level = "Level2";
        } else if ($Designation == 'SM') {
            $level = 'Level4';
        } else {
            $level = "Level3";
        }
        return $level;
    }

}

function mssql_escape($str)
{
    if (get_magic_quotes_gpc()) {
        $str = stripslashes(nl2br($str));
    }
    return str_replace("'", "''", $str);
}

if (!function_exists('select_option_Plant')) {

    function select_option_Plant($table, $field_id, $field_name, $userid)
    {
        $ci = get_instance();

        $ci->load->model('product_m');
        $option = $ci->product_m->option_select_Plant($table, $field_id, $userid);

        foreach ($option as $opt) {
            $opt_id = $opt[$field_id];
            $opt_name = $opt[$field_name];
            //echo "<option value=\"$opt_id\">$opt_name</option>";
            echo "<option value=" . "'" . $opt_id . "'" . ">$opt_name</option>";
        }
    }

}

if (!function_exists('select_option_Business')) {

    function select_option_Business($table, $field_id, $field_name, $userid)
    {
        $ci = get_instance();

        $ci->load->model('product_m');
        $option = $ci->product_m->option_select_Business($table, $field_id, $userid);

        foreach ($option as $opt) {
            $opt_id = $opt[$field_id];
            $opt_name = $opt[$field_name];
            //echo "<option value=\"$opt_id\">$opt_name</option>";
            echo "<option value=" . "'" . $opt_id . "'" . ">$opt_name</option>";
        }
    }

}

if (!function_exists('encrypt_password')) {
    function encrypt_password($password)
    {
        $encPassword = "";
        for ($i = strLen($password) - 1; $i >= 0; $i--) {
            $encPassword .= Chr(ord(substr($password, $i, 1)) + 104);
        }
        return $encPassword;
    }
}

if (!function_exists('decrypt_password')) {
    function decrypt_password($encryptedPassword)
    {
        $decPassword = "";
        for ($i = strLen($encryptedPassword) - 1; $i >= 0; $i--) {
            $decPassword .= Chr(ord(substr($encryptedPassword, $i, 1)) - 104);
        }
        return $decPassword;
    }
}

if (!function_exists('setFlashMsg')) {
    /**
     * set Flash Message
     * @param string $message
     * @param string $messageType
     */
    function setFlashMsg($message = "Successful", $messageType = "success")
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($messageType == 'success') {
            $_SESSION['success_msg'] = $message;
        } elseif ($messageType == 'error') {
            $_SESSION['error_msg'] = $message;
        } elseif ($messageType == 'info') {
            $_SESSION['info_msg'] = $message;
        } else {
            $_SESSION['default_msg'] = $message;
        }
    }
}


if (!function_exists('getFlashMsg')) {
    /**
     * get Flash Message
     * @return string
     */
    function getFlashMsg()
    {
        $message = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }        
        if (isset($_SESSION['success_msg']) && $_SESSION['success_msg'] != '') {
            $message = getMsgWithHtml($_SESSION['success_msg'], 'success');
            unset($_SESSION['success_msg']);
        } elseif (isset($_SESSION['error_msg']) && $_SESSION['error_msg'] != '') {
            $message = getMsgWithHtml($_SESSION['error_msg'], 'error');
            unset($_SESSION['error_msg']);
        } elseif (isset($_SESSION['info_msg']) && $_SESSION['info_msg'] != '') {
            $message = getMsgWithHtml($_SESSION['info_msg'], 'info');
            unset($_SESSION['info_msg']);
        } elseif (isset($_SESSION['default_msg']) && $_SESSION['default_msg'] != '') {
            $message = getMsgWithHtml($_SESSION['default_msg'], 'default');
            unset($_SESSION['default_msg']);
        }
        return $message;
    }
}


if (!function_exists('getMsgWithHtml')) {
    function getMsgWithHtml($message, $msgType = 'success')
    {
        $messageHtml = "";
        if ($message == '') return $messageHtml;

        if ($msgType == 'success') {
            $messageHtml = "<div class='alert alert-success noborder text-center weight-400 nomargin noradius'>" . $message . "</div>";
        } elseif ($msgType == 'error') {
            $messageHtml = "<div class='alert alert-danger noborder text-center weight-400 nomargin noradius'>" . $message . "</div>";
        } elseif ($msgType == 'info') {
            $messageHtml = "<div class='alert alert-info noborder text-center weight-400 nomargin noradius'>" . $message . "</div>";
        } else {
            $messageHtml = "<div class='alert alert-default noborder text-center weight-400 nomargin noradius'>" . $message . "</div>";
        }
        return $messageHtml;
    }
}

function getWorkDayType()
    {
        return [
            [
                'key' => 'RD',
                'value' => 'Regular Day'
            ],
            [
                'key' => 'WD',
                'value' => 'Working Day'
            ],
        ];
    }

    /**
     * get days of a month, if parameter is it gives days of current month
     * @param string $date as date format eg: 2020-01, which counts day of January month
     * @return array
     */
    function getDaysOfMonth($date = '')
    {
        $endDay = 31;
        if ($date) {
            $endDay = date("t", strtotime($date));
        }
        $days = [];
        for ($i = 1; $i <= $endDay; $i++) {
            $days[$i] = $i;
        }
        return $days;
    }

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}

function exportexcel($result, $filename)
{
    for ($i = 0; $i < count($result); $i++) {
        if (!isset($result[$i]['PageNo'])) {
            break;
        }
        unset($result[$i]['PageNo']);
    }
    $arrayheading[0] = !empty($result) ? array_keys($result[0]) : [];
    $result = array_merge($arrayheading, $result);

    header("Content-Disposition: attachment; filename=\"{$filename}.xls\"");
    header("Content-Type: application/vnd.ms-excel;");
    header("Pragma: no-cache");
    header("Expires: 0");
    $out = fopen("php://output", 'w');
    foreach ($result as $data) {
        fputcsv($out, $data, "\t");
    }
    fclose($out);
    exit();
}
