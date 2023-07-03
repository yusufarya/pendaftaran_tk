<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * This function used to get the CI instance
 */
if (!function_exists('get_instance')) {
    function get_instance()
    {
        $CI = &get_instance();
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if (!function_exists('getHashedPassword')) {
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if (!function_exists('verifyHashedPassword')) {
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

/**
 * This method used to get current browser agent
 */
if (!function_exists('getBrowserAgent')) {
    function getBrowserAgent()
    {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser()) {
            $agent = $CI->agent->browser() . ' ' . $CI->agent->version();
        } else if ($CI->agent->is_robot()) {
            $agent = $CI->agent->robot();
        } else if ($CI->agent->is_mobile()) {
            $agent = $CI->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}

if (!function_exists('setFlashData')) {
    function setFlashData($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}

// function renderPdf($nama_dokumen, $html)
// {

//     // ini_set("memory_limit", "-1");
//     $style = '<style>
//     hidden {
//         display: none;
//     }</style>';

//     $html .= $style;
//     require_once __DIR__ . '/vendor/autoload.php';

//     $mpdf = new \Mpdf\Mpdf();
//     $mpdf->SetVisibility('screenonly');
//     $mpdf->WriteHTML($html);
//     $mpdf->Output($nama_dokumen . ".pdf", 'D');
// }

function FormatPeriod_($cKey)
{
    return Left($cKey, 2) . "/" . Right($cKey, 4);
}

function Left($Str, $Len)
{
    return substr($Str, 0, $Len);
}

function Right($Str, $Len)
{
    return substr($Str, -$Len);
}

function Mid($Str, $Start, $Len)
{
    return substr($Str, $Start, $Len);
}

function SetPeriod_($cKey)
{
    return Left($cKey, 2) . Right($cKey, 4);
}

function SetAcc_($cKey)
{
    return Left($cKey, 4) . Right($cKey, 4);
}

function FormatAcc_($cKey)
{
    return Left($cKey, 4) . "." . Right($cKey, 4);
}

function FormatDate_($cDate, $cFormat)
{
    return date($cFormat, strtotime($cDate));
}

function FormatNo_($cKey)
{
    return Left($cKey, 2) . "-" . Mid($cKey, 2, 4) . "/" . Mid($cKey, 6, 2) . "-" . Right($cKey, 4);
}

function SetNo_($cKey)
{
    return Left($cKey, 2) . Mid($cKey, 3, 4) . Mid($cKey, 8, 2) . Right($cKey, 4);
}

// function FormatCurrency_($cKey)
// {
//     return number_format($cKey, DEC_PRC);
// }

// function FormatMoney_($cKey)
// {
//     if ($cKey >= 0)
//         return number_format($cKey, DEC_PRC);
//     else
//         return '(' . number_format(abs($cKey), DEC_PRC) . ')';
// }

function Space_($nLen)
{
    return str_repeat("&nbsp;", $nLen);
}

function CekDatabase_($dbName)
{
    $CI = get_instance();
    $row =  $CI->db->query("SHOW DATABASES LIKE '%$dbName%'")->num_rows();
    if ($row > 0)
        return true;
    else
        return false;
}

function Find_($arrData, $colName, $strToFind)
{

    $result = in_array($strToFind, array_column($arrData, $colName));

    return $result;
}

function replace_mychar($str)
{
    $string = str_replace(['\'', '"'], '`', $str);
    return $string;
}

function blank_to_zero($str)
{
    $zero = $str && $str != 'NaN' && $str != 'null' && $str != 'NULL' && $str != 'undefined' && $str != 'Undefined' ? $str : 0;
    return $zero;
}

function dateToWeek($qDate)
{
    $dt = strtotime($qDate);
    $day  = date('j', $dt);
    $month = date('m', $dt);
    $year = date('Y', $dt);
    $totalDays = date('t', $dt);
    $weekCnt = 1;
    $retWeek = 0;
    for ($i = 1; $i <= $totalDays; $i++) {
        $curDay = date("N", mktime(0, 0, 0, $month, $i, $year));
        if ($curDay == 7) {
            if ($i == $day) {
                $retWeek = $weekCnt + 1;
            }
            $weekCnt++;
        } else {
            if ($i == $day) {
                $retWeek = $weekCnt;
            }
        }
    }
    return $retWeek;
}

function cekSession()
{
    $CI = get_instance();
    $CI->db->select('users.*');
    $CI->db->from('users');
    $CI->db->where('users.email', $CI->session->userdata('email'));
    $CI->db->where('users.status', 1);
    $cekSession = $CI->db->get()->row_array();
    if ($cekSession == '') {
        $CI->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum login.</div>');
        redirect('login');
    }
    return $cekSession;
}

function cekSessionUser()
{
    $CI = get_instance();
    $CI->db->select('*');
    $CI->db->from('murid');
    $CI->db->where('email', $CI->session->userdata('email'));
    // $CI->db->where('status', 1);
    $cekSession = $CI->db->get()->row_array();
    if ($cekSession == '') {
        $CI->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum login.</div>');
        redirect('login');
    }
    return $cekSession;
}

// ADD BY YUSUF
function getNamaBulan($bulan)
{
    switch ($bulan) {
        case '01':
            $bulan = 'Januari';
            break;
        case '02':
            $bulan = 'Februari';
            break;
        case '03':
            $bulan = 'Maret';
            break;
        case '04':
            $bulan = 'April';
            break;
        case '05':
            $bulan = 'Mei';
            break;
        case '06':
            $bulan = 'Juni';
            break;
        case '07':
            $bulan = 'Juli';
            break;
        case '08':
            $bulan = 'Agustus';
            break;
        case '09':
            $bulan = 'September';
            break;
        case '10':
            $bulan = 'Oktober';
            break;
        case '11':
            $bulan = 'November';
            break;
        case '12':
            $bulan = 'Desember';
            break;
        default:
            $bulan = '';
    }

    return $bulan;
}
