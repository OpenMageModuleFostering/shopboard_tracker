<?php

/**
 * Shopboard Tracker Page Block
 *
 * @category   Shopboard
 * @package    Shopboard_Tracker
 */
class Shopboard_Tracker_Block_Sbt extends Mage_Core_Block_Template
{
  protected function _getCartTrackingCode()
  {
    return Mage::helper('tracker')->getCartTrackingCode();
  }

  /**
   * Render Shopboard Tracker script
   *
   * @return string
   */
  protected function _toHtml()
  {
    if (!Mage::helper('tracker')->isShopboardTrackerAvailable()) {
      return '';
    }

    return parent::_toHtml();
  }
}
