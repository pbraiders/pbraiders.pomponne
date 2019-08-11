<?php

/**
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

// loads the application environment
include __DIR__ . '/bootstrap.php';

exit(0);

/** Defines
 **********/
define('PBR_PATH', dirname(__DIR__));

/** Include config
 *****************/
require(PBR_PATH . '/config.php');

/** Include functions
 ********************/
require(PBR_PATH . '/includes/function/functions.php');

/** Initialize context
 *********************/
require(PBR_PATH . '/includes/init/context.php');

/** Authenticate
 ***************/
require(PBR_PATH . '/includes/init/authuser.php');

/** Initialize
 *************/
require(PBR_PATH . '/includes/class/cdate.php');
$pDate = new CDate();
$bAdmin = FALSE;
$bReturn = TRUE;

/** Read input parameters
 ************************/
if (filter_has_var(INPUT_POST, CDate::YEARTAG)) {
    // Read POST parameters
    $bReturn = $pDate->ReadInput(INPUT_POST);
} elseif (filter_has_var(INPUT_GET, CDate::YEARTAG)) {
    // Read GET parameters
    $bReturn = $pDate->ReadInput(INPUT_GET);
} //if( filter_has_var(
if (!$bReturn) {
    // mandatory parameters are not valid
    unset($pDate);
    $sTitle = 'fichier: ' . basename(__FILE__) . ', ligne:' . __LINE__;
    ErrorLog(CAuth::GetInstance()->GetUsername(), $sTitle, 'action interdite', E_USER_WARNING, FALSE);
    RedirectError(-2, __FILE__, __LINE__);
    exit;
} //if( !$bReturn )

/** Get the rent day infos
 *************************/
require(PBR_PATH . '/includes/db/function/rentsmonthget.php');
$tRecordset = RentsMonthGet(
    CAuth::GetInstance()->GetUsername(),
    CAuth::GetInstance()->GetSession(),
    GetIP() . GetUserAgent(),
    $pDate
);

if (!is_array($tRecordset)) {
    // Error
    RedirectError($tRecordset, __FILE__, __LINE__);
    exit;
} //if( !is_array($tRecordset) )

/** Build header
 ***************/
require(PBR_PATH . '/includes/class/cheader.php');
$pHeader = new CHeader();
$sBuffer = $pDate->GetMonthName($pDate->GetRequestMonth()) . ' ' . $pDate->GetRequestYear();
$pHeader->SetNoCache();
$pHeader->SetTitle($sBuffer);
$pHeader->SetDescription($sBuffer);
$pHeader->SetKeywords($sBuffer);

/** Admin case
 *************/
if (SessionValid(CAuth::GetInstance()->GetUsername(), CAuth::GetInstance()->GetSession(), 10, GetIP() . GetUserAgent()) > 0) {
    $bAdmin = TRUE;
} //admin case

/** Display
 **********/
require(PBR_PATH . '/includes/display/header.php');
require(PBR_PATH . '/includes/display/calendar.php');
require(PBR_PATH . '/includes/display/footer.php');

/** Delete objects
 *****************/
unset($pDate);
unset($pHeader);
include(PBR_PATH . '/includes/init/clean.php');
