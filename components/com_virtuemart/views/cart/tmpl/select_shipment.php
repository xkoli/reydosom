<?php
/**
 *
 * Template for the shipment selection
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Max Milbers
 *
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: cart.php 2400 2010-05-11 19:30:47Z milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.formvalidation');
JHTML::stylesheet('vmpanels.css', JURI::root() . 'components/com_virtuemart/assets/css/');
?>
<style type="text/css">
    .invalid {
        border-color: #f00;
        background-color: #ffd;
        color: #000;
    }
    label.invalid {
        background-color: #fff;
        color: #f00;
    }
</style>
<script language="javascript">
    function myValidator(f, t)
    {
        f.task.value=t;
        if (f.task.value=='cancel') {
            f.submit();
            return true;
        }
        if (document.formvalidator.isValid(f)) {
            f.submit();
            return true;
        } else {
            var msg = '<?php echo addslashes( JText::_('COM_VIRTUEMART_USER_FORM_MISSING_REQUIRED_JS') ); ?>';
            alert (msg);
        }
        return false;
    }
</script>
<?php
if (VmConfig::get('oncheckout_show_steps', 1)) {
    echo '<h1 class="checkoutStep" id="checkoutStep2">' . JText::_('COM_VIRTUEMART_USER_FORM_CART_STEP2') . '</h1>';
}
?>
<?php if ($this->cart->prices['billTotal'][1]) { ?>
<form method="post" id="userForm" name="chooseShipmentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate">
<?php
	echo "<p>".JText::_('COM_VIRTUEMART_CART_SELECT_SHIPMENT')."</p>";
    if ($this->found_shipment_method) {


	   echo "<fieldset>\n";
	// if only one Shipment , should be checked by default
	    foreach ($this->shipments_shipment_rates as $shipment_shipment_rates) {
		if (is_array($shipment_shipment_rates)) {
		    foreach ($shipment_shipment_rates as $shipment_shipment_rate) {
			echo $shipment_shipment_rate."<br />\n";
		    }
		}
	    }
	    echo "</fieldset>\n";
    } else {
	 echo "<p>".$this->shipment_not_found_text."</p>";
    }

    ?>
<?php

	
	if($this->cart->getInCheckOut()){
		$buttonclass = 'button';
	} else {
		$buttonclass = 'button';
	}
	?>
	<div class="buttonBar-right">

	        <button class="<?php echo $buttonclass ?>" type="submit" ><?php echo JText::_('COM_VIRTUEMART_SAVE'); ?></button>  &nbsp;
	<button class="<?php echo $buttonclass ?>" type="reset" onClick="window.location.href='<?php echo JRoute::_('index.php?option=com_virtuemart&view=cart'); ?>'" ><?php echo JText::_('COM_VIRTUEMART_CANCEL'); ?></button>
	</div>

    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="view" value="cart" />
    <input type="hidden" name="task" value="setshipment" />
    <input type="hidden" name="controller" value="cart" />
</form>
<?php } else { ?>
<p>Add Cart Products</p>
<?php } ?>