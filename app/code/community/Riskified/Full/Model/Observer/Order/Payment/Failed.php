<?php

/**
 * Riskified Full failed order payment observer.
 *
 * @category Riskified
 * @package  Riskified_Full
 * @author   Piotr Pierzak <piotrek.pierzak@gmail.com>
 */
class Riskified_Full_Model_Observer_Order_Payment_Failed
{
    /**
     * Default failed transaction handler.
     *
     * @param Varien_Event_Observer $observer Observer object.
     *
     * @return Riskified_Full_Model_Observer_Order_Payment_Failed
     */
    public function handleDefaultFailedTransaction(
        Varien_Event_Observer $observer
    ) {
        $order = $observer->getEvent()->getOrder();

        if (!Mage::registry("riskified-order")) {
            Mage::register("riskified-order", $order);
        }

        $helper = Mage::helper("full/order");

        Mage::unregister("riskified-order");

        $helper->postOrder(
            $order,
            Riskified_Full_Helper_Order::ACTION_CHECKOUT_DENIED
        );

        return $this;
    }
}
