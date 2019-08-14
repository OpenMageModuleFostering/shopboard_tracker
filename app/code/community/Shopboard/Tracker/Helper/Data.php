<?php
/**
 * Shopboard Tracker data helper
 *
 * @category   Shopboard
 * @package    Shopboard_Tracker
 */
class Shopboard_Tracker_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Config paths for using throughout the code
     */
    const XML_PATH_ACTIVE  = 'tracker/config/active';
    const XML_PATH_TRACKING_CODE = 'tracker/config/trackingCode';

    /**
     * Whether Shopboard Tracker is ready to use
     *
     * @param mixed $store
     * @return bool
     */
    public function isShopboardTrackerAvailable($store = null)
    {
        $trackingCode = Mage::getStoreConfig(self::XML_PATH_TRACKING_CODE, $store);
        return $trackingCode && Mage::getStoreConfigFlag(self::XML_PATH_ACTIVE, $store);
    }

    public function getCartTrackingCode() {
      $code = sprintf("_sbt.push(['setCartTotalValue', %s]);\n", $this->_getCartGrandTotal());
      $code .= sprintf("_sbt.push(['setCartContent', %s]);", json_encode($this->_getCartItemsArray()));
      return $code;
    }

    public function _getCartItemsArray()
    {
      $cartItems = $this->_getQuote()->getAllVisibleItems();
      $shopboardCart = array();
      foreach ($cartItems as $item) {
        $shopboardCart[] = (array($item->getName(), $item->getQty()));
      }
      return $shopboardCart;
    }

    public function _getCartGrandTotal()
    {
      $quote = $this->_getQuote();
      return floatval($quote->getGrandTotal());
    }

    protected function _getQuote() {
      return Mage::helper('checkout/cart')->getCart()->getQuote();
    }
}
