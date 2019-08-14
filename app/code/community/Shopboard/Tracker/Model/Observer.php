<?php
/**
 * Shopboard Tracker module observer
 *
 * @category   Shopboard
 * @package    Shopboard_Tracker
 */
class Shopboard_Tracker_Model_Observer
{
  /**
   *  TODO: figure out how to inject the javascript with an AJAX update of the cart.
   */
  public function handleUpdateCart(Varien_Event_Observer $observer)
  {
    $code = sprintf('<script type="text/javascript">%s</script>', Mage::helper('tracker')->getCartTrackingCode());
  }
}
