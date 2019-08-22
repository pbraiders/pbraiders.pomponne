<?php
/*************************************************************************
 *                                                                       *
 * Copyright (C) 2010   Olivier JULLIEN - PBRAIDERS.COM                  *
 * Tous droits réservés - All rights reserved                            *
 *                                                                       *
 *************************************************************************
 *                                                                       *
 * Except if expressly provided in a dedicated License Agreement,you     *
 * are not authorized to:                                                *
 *                                                                       *
 * 1. Use,copy,modify or transfer this software component,module or      *
 * product,including any accompanying electronic or paper documentation  *
 * (together,the "Software").                                            *
 *                                                                       *
 * 2. Remove any product identification,copyright,proprietary notices    *
 * or labels from the Software.                                          *
 *                                                                       *
 * 3. Modify,reverse engineer,decompile,disassemble or otherwise         *
 * attempt to reconstruct or discover the source code,or any parts of    *
 * it,from the binaries of the Software.                                 *
 *                                                                       *
 * 4. Create derivative works based on the Software (e.g. incorporating  *
 * the Software in another software or commercial product or service     *
 * without a proper license).                                            *
 *                                                                       *
 * By installing or using the "Software",you confirm your acceptance     *
 * of the hereabove terms and conditions.                                *
 *                                                                       *
 * file encoding: UTF-8                                                  *
 *                                                                       *
 *************************************************************************/
if( !defined('PBR_VERSION') || !defined('PBR_DB_LOADED') )
    die('-1');

/**
  * function: RentsMonthGet
  * description: Get real, planned, canceled sum rents and maximum rents
  *              for a specific year and month.
  * parameters: STRING|sLogin   - login identifier
  *             STRING|sSession - session identifier
  *             STRING|sInet    - concatenation of IP and USER_AGENT
  *              CDate|pDate    - instance of CDate . Requested date.
  * return: BOOLEAN - FALSE if an exception occures
  *         or
  *         INTEGER - -1 when a private error occures
  *                   -2 when an authentication error occures.
  *                   -3 when an access denied error occures.
  *                   -4 when a duplicate error occures.
  *         or
  *         ARRAY of none, one or more records (day,real,planned,canceled,max)
  * author: Olivier JULLIEN - 2010-02-04
  * update: Olivier JULLIEN - 2010-05-24 - use ErrorDBLog instead of CErrorList::AddDB(...) and CDBLayer::GetInstance()->LogError(...)
  * update: Olivier JULLIEN - 2010-06-15 - improvement
  */
function RentsMonthGet( $sLogin, $sSession, $sInet, CDate $pDate)
{
	/** Initialize
     *************/
    $iReturn = -1;
    $sMessage = '';
    $sErrorTitle = __FUNCTION__ .'('.$sLogin.','.$sSession.',[obfuscated],'.$pDate->GetRequestMonth().','.$pDate->GetRequestYear().')';

	/** Request
     **********/
    if( (CDBLayer::GetInstance()->IsOpen()===TRUE)
     && IsScalarNotEmpty(PBR_DB_DBN)
     && IsStringNotEmpty($sLogin)
     && IsStringNotEmpty($sSession)
     && IsStringNotEmpty($sInet) )
    {
        try
        {
            // Prepare
    		$sSQL = 'SELECT r.`day` AS "day", IFNULL(SUM(r.`rent_real`),0) AS "real", IFNULL(SUM(r.`rent_planned`),0) AS "planned", IFNULL(SUM(r.`rent_canceled`),0) AS "canceled", IFNULL(MAX(r.`rent_max`),0) AS "max" FROM `'.PBR_DB_DBN.'`.`reservation` AS r WHERE r.`year`=:iYear AND r.`month`=:iMonth GROUP BY r.`day`';
            $pPDOStatement = CDBLayer::GetInstance()->GetDriver()->prepare($sSQL);
            // Bind
            $pPDOStatement->bindValue(':iMonth',$pDate->GetRequestMonth(),PDO::PARAM_INT);
            $pPDOStatement->bindValue(':iYear',$pDate->GetRequestYear(),PDO::PARAM_INT);
            // Execute
            $pPDOStatement->execute();
            // Fetch
            $iReturn = array();
            while( $tRow = $pPDOStatement->fetch(PDO::FETCH_ASSOC) )
            {
                $iReturn[$tRow['day']] = $tRow;
            }//while
        }
        catch(PDOException $e)
        {
            $iReturn = FALSE;
            $sMessage = $e->getMessage();
        }//try

        // Free resource
        $pPDOStatement = NULL;

    }//if(...

    // Error
    if( is_scalar($iReturn) )
    {
        ErrorDBLog( $sLogin, $sErrorTitle, $sMessage, $iReturn, TRUE);
    }//if( is_scalar($iReturn) )

    return $iReturn;
}

?>
