<?php

require_once(Mage::getBaseDir('lib') . DIRECTORY_SEPARATOR . 'riskified_php_sdk' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Riskified' . DIRECTORY_SEPARATOR . 'autoloader.php');
use Riskified\Common\Signature;
use Riskified\DecisionNotification\Model\Notification as DecisionNotification;


class Riskified_Full_Helper_Response extends Mage_Core_Helper_Abstract
{
    public function parse($request)
    {
        $header_name = Signature\HttpDataSignature::HMAC_HEADER_NAME;
        $headers = array($header_name => $request->getHeader($header_name));
        $body = $request->getRawBody();
        Mage::helper('full/log')->log("Received new notification request with headers: " . json_encode($headers) . " and body: $body. Trying to parse.");
        return new DecisionNotification(new Signature\HttpDataSignature(), $headers, $body);
    }
}
