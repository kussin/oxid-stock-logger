<?php

/**
 * Helper for OXID 6 Configuration
 */
class Oxid_Config_Helper
{
    /**
     * @param $sKey
     * @return mixed
     */
    public function get($sKey)
    {
        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.inc.php';

        return $this->{$sKey};
    }
}

// LOAD OXID CONFIGURATION
$oConfig = new Oxid_Config_Helper();

// DB CONNECTION
$oDb = mysqli_connect(
    $oConfig->get('dbHost') . ':' . $oConfig->get('dbPort'),
    $oConfig->get('dbUser'),
    $oConfig->get('dbPwd'),
    $oConfig->get('dbName'));

if (!$oDb) {
    exit('DB Connection Error: ' . mysqli_connect_error());
} else {
    $oDb->set_charset('utf8');

    // GET PRODUCTS
    $oResult = mysqli_query($oDb, 'SELECT OXID, OXEAN, OXSTOCK FROM oxarticles ORDER BY OXARTNUM ASC;');

    // INIT CSV
    $aCsv = array();

    while($oProduct = mysqli_fetch_object($oResult))
    {
        $aCsv[] = implode(',', array(
            $oProduct->OXID,
            $oProduct->OXEAN,
            $oProduct->OXSTOCK
        ));
    }

    // SAVE LOG
    if (count($aCsv) > 0) {
        // CHECK IF DIRECTORY EXISTS
        $sLogDir = $oConfig->get('sShopDir') . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'stock' . DIRECTORY_SEPARATOR;

        if (!file_exists($sLogDir)) {
            mkdir($sLogDir, 0777, TRUE);
        }

        // WRITE CSV
        file_put_contents($sLogDir . time() . '.csv', implode(PHP_EOL, $aCsv));
    }
}