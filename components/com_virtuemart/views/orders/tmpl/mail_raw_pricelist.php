<?php

defined('_JEXEC') or die('Restricted access');
/**
 *
 * Layout for the shopping cart
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Max Milbers, Valerie Isaksen
 *
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 *
 */
// Plain text formating
// echo sprintf("[%s]\n",      $s); // affichage d'une cha�ne standard
// echo sprintf("[%10s]\n",    $s); // justification � droite avec des espaces
// echo sprintf("[%-10s]\n",   $s); // justification � gauche avec des espaces
// echo sprintf("[%010s]\n",   $s); // l'espacement nul fonctionne aussi sur les cha�nes
// echo sprintf("[%'#10s]\n",  $s); // utilisation du caract�re personnalis� de s�paration '#'
// echo sprintf("[%10.10s]\n", $t); // justification � gauche mais avec une coupure � 10 caract�res
// $s = 'monkey';
// [monkey]
// [    monkey]
// [monkey    ]
// [0000monkey]
// [####monkey]
// [many monke]
// Check to ensure this file is included in Joomla!
// jimport( 'joomla.application.component.view');
// $viewEscape = new JView();
// $viewEscape->setEscape('htmlspecialchars');
// TODO Temp fix !!!!! *********************************>>>
//$skuPrint = echo sprintf( "%64.64s",strtoupper (JText::_('COM_VIRTUEMART_CART_SKU') ) ) ;

// Head of table
echo strip_tags(JText::sprintf('COM_VIRTUEMART_ORDER_PRINT_TOTAL', $this->currency->priceDisplay($this->order['details']['BT']['order_total']))) ."\n";
echo sprintf("%'-64.64s", '') . "\n";
echo JText::_('COM_VIRTUEMART_ORDER_ITEM') . "\n";
foreach ($this->order['items'] as $item) {
    echo "\n";
    echo $item['product_quantity'] . ' X ' . $item['order_item_name'] . ' (' . strtoupper(JText::_('COM_VIRTUEMART_CART_SKU')) . $item['order_item_sku'] . ')' ."\n";

    if (!empty($item['basePriceWithTax']) && $item['basePriceWithTax'] != $item['product_final_price']) {
	echo $item['product_basePriceWithTax'] . "\n";
    }

    echo JText::_('COM_VIRTUEMART_ORDER_PRINT_TOTAL') . $item['product_final_price'];
    if (VmConfig::get('show_tax')) {
	echo ' (' . JText::_('COM_VIRTUEMART_ORDER_PRINT_PRODUCT_TAX') . ':' . $this->currency->priceDisplay($item['product_tax']) . ')' ."\n";
    }
    echo "\n";
}
echo sprintf("%'-64.64s", '');
echo "\n";

// Coupon
if (!empty($this->order['details']['BT']['coupon_code'])) {
    echo JText::_('COM_VIRTUEMART_COUPON_DISCOUNT') . ':' . $this->order['details']['BT']['coupon_code'] . ' ' . JText::_('COM_VIRTUEMART_CART_PRICE') . ':' . $this->currency->priceDisplay($this->order['details']['BT']['coupon_discount']);
    echo "\n";
}



foreach ($this->order['calc_rules'] as $rule) {
    if ($rule['calc_kind'] == 'DBTaxRulesBill') {
	echo $rule['calc_rule_name'] . $this->currency->priceDisplay($rule['calc_amount']) ."\n";
    } elseif ($rule['calc_kind'] == 'taxRulesBill') {
	echo $rule['calc_rule_name'] . ' ' . $this->currency->priceDisplay($rule['calc_amount']) ."\n";
    } elseif ($rule['calc_kind'] == 'DATaxRulesBill') {
	echo $rule['calc_rule_name'] . ' ' . $this->currency->priceDisplay($rule['calc_amount'])."\n";
    }
}


echo strtoupper(JText::_('COM_VIRTUEMART_ORDER_PRINT_SHIPPING')) . ' (' . strip_tags(str_replace("<br />", "\n",$this->shipment_name)) . ' ) ' . "\n";
echo JText::_('COM_VIRTUEMART_ORDER_PRINT_TOTAL') . ' : ' . $this->currency->priceDisplay($this->order['details']['BT']['order_shipment']);
if (VmConfig::get('show_tax')) {
    echo ' (' . JText::_('COM_VIRTUEMART_ORDER_PRINT_TAX') . ' : '. $this->currency->priceDisplay($this->order['details']['BT']['order_shipment_tax']) . ')';
}
echo "\n";
echo strtoupper(JText::_('COM_VIRTUEMART_ORDER_PRINT_PAYMENT')) . ' (' . strip_tags(str_replace("<br />", "\n",$this->payment_name) ) . ' ) ' . "\n";
echo JText::_('COM_VIRTUEMART_ORDER_PRINT_TOTAL') . ':' . $this->currency->priceDisplay($this->order['details']['BT']['order_payment']);
if (VmConfig::get('show_tax')) {
    echo ' (' . JText::_('COM_VIRTUEMART_ORDER_PRINT_TAX') . ' : ' . $this->currency->priceDisplay($this->order['details']['BT']['order_payment_tax']) . ')';
}
echo "\n";

echo sprintf("%'-64.64s", '') . "\n";
// total order
echo JText::_('COM_VIRTUEMART_CART_SUBTOTAL_DISCOUNT_AMOUNT') . ' : ' . $this->currency->priceDisplay($this->order['details']['BT']['order_billDiscountAmount'])."\n";

echo strtoupper(JText::_('COM_VIRTUEMART_ORDER_PRINT_TOTAL')) . ' : ' . $this->currency->priceDisplay($this->order['details']['BT']['order_total'])."\n";
if (VmConfig::get('show_tax')) {
    echo ' (' . JText::_('COM_VIRTUEMART_ORDER_PRINT_TAX') . ' : ' . $this->currency->priceDisplay($this->order['details']['BT']['order_billTaxAmount']) . ')'."\n";
}
echo "\n";
?>
