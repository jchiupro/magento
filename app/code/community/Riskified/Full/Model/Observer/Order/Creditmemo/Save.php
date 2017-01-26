<?php

/**
 * Riskified Full order creditmemo save observer.
 *
 * @category Riskified
 * @package  Riskified_Full
 * @author   Piotr Pierzak <piotrek.pierzak@gmail.com>
 */
class Riskified_Full_Model_Observer_Order_Creditmemo_Save
{
    /**
     * Handle credit memo save.
     *
     * @param Varien_Event_Observer $observer Observer object.
     *
     * @return Riskified_Full_Model_Observer_Order_Creditmemo_Save
     */
    public function handleCreditmemoSave(
        Varien_Event_Observer $observer
    ) {
        $creditmemo = $observer->getEvent()->getCreditmemo();

        /**
         * @var Riskified_Full_Helper_Order $orderHelper
        */
        $orderHelper = Mage::helper("full/order");

        $orderHelper->postOrder(
            $creditmemo,
            Riskified_Full_Helper_Order::ACTION_REFUND
        );

        return $this;
    }
}
