<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<!-- Currency Selector Module -->
<?php echo $text_before ?>
<form id="select-form" class="xxx" action="<?php echo JRoute::_('index.php'); ?>" method="post">
	<?php echo JHTML::_('select.genericlist', $currencies, 'virtuemart_currency_id', 'class="inputbox"', 'virtuemart_currency_id', 'currency_txt', $virtuemart_currency_id) ; ?>
    <input class="button" type="submit" name="submit" value="<?php echo JText::_('Change') ?>" />
</form>
