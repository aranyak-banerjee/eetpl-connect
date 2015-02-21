<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Kolkata');

function formatNumber($v, $noOfDec = 2, $pad = null) {
    $num = sprintf("%.{$noOfDec}f", (float) $v);
    return $num;

    // this to be fixed latter
    if ($num >= 100000) {
        $num = $num / 100000;
        $num = formatNumber($num);
        $num = $num . "Lakh";
    } else if ($num >= 1000) {
        $num = $num / 1000;
        $num = formatNumber($num);
        $num = $num . "<b> K </b>";
    }
}

function formatDate($date, $format = "d-m-Y") {
    if ($date == "0000-00-00" || $date == null || !isset($date))
        return "-";
    $date = date_create($date);
    return date_format($date, $format);
}

function getCurrentDateTime() {
    $d = new DateTime("now", new DateTimeZone("Asia/Kolkata"));
    return $d->format("Y-m-d H:i:s");
}

function getPreviousDate($date) {
    $date = date_create($date);
    date_add($date, date_interval_create_from_date_string('-1 day'));
    return date_format($date, "Y-m-d");
}

function dayReferance($date, $format = "d-m-Y") {
    if (formatDate($date) == formatDate(getCurrentDateTime())) {
        return "Today";
    } elseif (formatDate($date) == formatDate(getPreviousDate(getCurrentDateTime()))) {
        return "Yesterday";
    } else {
        return formatDate($date, $format);
    }
}

function getNextDate($date) {
    $date = date_create($date);
    date_add($date, date_interval_create_from_date_string('1 day'));
    return date_format($date, "Y-m-d");
}

function validateDate($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') == $date;
}

function convertObjtoArray($o) {
    if (is_object($o)) {
        $no = Array();
        foreach ($o as $n => $v) {
            $no[$n] = convertObjtoArray($v);
        }
        $o = $no;
        unset($no);
    }
    if (is_array($o)) {
        foreach ($o as $n => $v) {
            $o[$n] = convertObjtoArray($v);
        }
    }
    return $o;
}

function getUserName($id, $notifyYou = TRUE) {
    $ci = get_instance();
    $sql = "select id,f_name as name from " . USERS . " where id=$id and status = 1 ";
    $query = $ci->db->query($sql);
    if ($query->num_rows()) {
        if (isset($ci->session->userdata('user_details')->id) && $notifyYou && $query->result()[0]->id == $ci->session->userdata('user_details')->id) {
            $res = "You";
        } else {
            $res = $query->result()[0]->name;
        }
    } else {
        $res = 'delete_user';
    }
    return $res;
}
