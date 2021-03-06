<?php
/**
*
* Layout for the shopping cart
*
* @package	VirtueMart
* @subpackage Cart
* @author Max Milbers, George Kostopoulos
*
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: cart.php 4431 2011-10-17 grtrustme $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

if(!class_exists('shopFunctionsF')) require(JPATH_VM_SITE.DS.'helpers'.DS.'shopfunctionsf.php');
$comUserOption=shopfunctionsF::getComUserOption();
$uri = JFactory::getURI();
$url = $uri->toString(array('path', 'query', 'fragment'));
// vmdebug('$this->show ',$this);
if ($this->show and $this->JUser->id == 0  ) {
JHtml::_('behavior.formvalidation');
JHTML::_ ( 'behavior.modal' );
// vmdebug('cart',$this->cart);



$uri = JFactory::getURI();
$url = $uri->toString(array('path', 'query', 'fragment'));
 vmdebug('my url loginform '.$url);
// 	Hmmmm	$this->cart->userDetails->JUser->id === 0


	//Extra login stuff, systems like openId and plugins HERE
    if (JPluginHelper::isEnabled('authentication', 'openid')) {
        $lang = &JFactory::getLanguage();
        $lang->load('plg_authentication_openid', JPATH_ADMINISTRATOR);
        $langScript = 'var JLanguage = {};' .
                ' JLanguage.WHAT_IS_OPENID = \'' . JText::_('WHAT_IS_OPENID') . '\';' .
                ' JLanguage.LOGIN_WITH_OPENID = \'' . JText::_('LOGIN_WITH_OPENID') . '\';' .
                ' JLanguage.NORMAL_LOGIN = \'' . JText::_('NORMAL_LOGIN') . '\';' .
                ' var comlogin = 1;';
        $document = &JFactory::getDocument();
        $document->addScriptDeclaration($langScript);
        JHTML::_('script', 'openid.js');
    }

    //end plugins section

    //anonymous order section
    if ($this->order  ) {
    	?>

	    <div class="order-view">

	    <h1><?php echo JText::_('COM_VIRTUEMART_ORDER_ANONYMOUS') ?></h1>

	    <form action="<?php echo JRoute::_( 'index.php', true, 0); ?>" method="post" name="com-login">

	    	<div class="width30 floatleft" id="com-form-order">
	    		<label for="order_number"><?php echo JText::_('COM_VIRTUEMART_ORDER_NUMBER') ?></label><br />
	    		<input type="text" id="order_number " name="order_number" class="inputbox" size="18" alt="order_number " />
	    	</div>
	    	<div class="width30 floatleft" id="com-form-order">
	    		<label for="order_pass"><?php echo JText::_('COM_VIRTUEMART_ORDER_PASS') ?></label><br />
	    		<input type="text" id="order_pass" name="order_pass" class="inputbox" size="18" alt="order_pass" value="p_"/>
	    	</div>
	    	<div class="width30 floatleft" id="com-form-order">
	    		<input type="submit" name="Submitbuton" class="button" value="<?php echo JText::_('COM_VIRTUEMART_ORDER_BUTTON_VIEW') ?>" />
	    	</div>
	    	<div class="clr"></div>
	    	<input type="hidden" name="option" value="com_virtuemart" />
	    	<input type="hidden" name="view" value="orders" />
	    	<input type="hidden" name="layout" value="details" />
	    	<input type="hidden" name="return" value="" />

	    </form>
		<div class="clear"></div>
	    </div>

<?php   }


    ?>
    <form action="index.php" method="post" name="com-login" id="com-login">
	<?php if (!$this->from_cart ) { ?>
	<div>
		<p><?php echo JText::_('COM_VIRTUEMART_ORDER_CONNECT_FORM'); ?></p>
	</div>
<div class="clear"></div>
<?php } else { ?>
        <p><?php echo JText::_('COM_VIRTUEMART_ORDER_CONNECT_FORM'); ?></p>
<?php }   ?>
		<div class="width100">	
			<p class="floatleft width35" id="com-form-login-username">
				<label for="modlgn-username"><?php echo JText::_('TM_LOGIN_VALUE_USERNAME'); ?></label>
				<input class="inputbox"  type="text" name="username" alt="" value="" onblur="if(this.value=='') this.value='';" onfocus="if(this.value=='') this.value='';" />
			</p>
			<p class="floatleft width35" id="com-form-login-password">
				<label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>	
				<?php if ( JVM_VERSION===1 ) { ?>
				<input type="password" id="passwd" name="passwd" class="inputbox" size="18" alt="password" />
				<?php } else { ?>
				<input id="modlgn-passwd" type="password" name="password" class="inputbox" size="18"  />
				<?php } ?>
			</p>
		</div>
		<div class="clear"></div>
		<div class="width100 link">
        <div class="width35 floatleft">
		  <a   href="<?php echo JRoute::_('index.php?option='.$comUserOption.'&view=remind'); ?>">
            <?php echo JText::_('COM_VIRTUEMART_ORDER_FORGOT_YOUR_USERNAME'); ?></a><br/>
<?php /*?>			<?php 
			  $usersConfig = &JComponentHelper::getParams( 'com_users' );
			  if ($usersConfig->get('allowUserRegistration')) { ?>
			  <a  href="<?php echo JRoute::_( 'index.php?option=com_virtuemart&view=user' ); ?>">
			  <?php echo JText::_('COM_VIRTUEMART_ORDER_REGISTER'); ?></a>
			  <?php } ?>
<?php */?>        </div>

        <div class="width35 floatleft">
		    <a   href="<?php echo JRoute::_('index.php?option='.$comUserOption.'&view=reset'); ?>">
            <?php echo JText::_('COM_VIRTUEMART_ORDER_FORGOT_YOUR_PASSWORD'); ?></a>
        </div>
		
		 </div> 
		 <div class="clear"></div>
		<div class="width100" id="com-form-login-remember">
			<div class="width15 floatleft">
            <input type="submit" name="Submit" class="button" value="<?php echo JText::_('COM_VIRTUEMART_LOGIN') ?>" />
			</div>
			<div class="width20 floatleft remember">
            <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
				<label for="remember"><?php echo $remember_me = JVM_VERSION===1? JText::_('Remember me') : JText::_('JGLOBAL_REMEMBER_ME') ?></label>
				<input type="checkbox" id="remember" name="remember" class="inputbox" value="yes" alt="Remember Me" />
            <?php endif; ?>
			</div>
        </div>

        <?php if ( JVM_VERSION===1 ) { ?>
        <input type="hidden" name="task" value="login" />
        <?php } else { ?>
	<input type="hidden" name="task" value="user.login" />
        <?php } ?>
        <input type="hidden" name="option" value="<?php echo $comUserOption ?>" />
        <input type="hidden" name="return" value="<?php echo base64_encode($url) ?>" />
        <?php echo JHTML::_('form.token'); ?>
    </form>
	<div class="clear"></div>
<?php  }else if ($this->JUser->id  ){ ?>

   <form action="index.php" method="post" name="login" id="form-login">
        <?php echo JText::sprintf( 'COM_VIRTUEMART_HINAME', $this->JUser->name ); ?><br /><br />
	<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'COM_VIRTUEMART_BUTTON_LOGOUT'); ?>" />
        <input type="hidden" name="option" value="<?php echo $comUserOption ?>" />
        <?php if ( JVM_VERSION===1 ) { ?>
            <input type="hidden" name="task" value="logout" />
        <?php } else { ?>
            <input type="hidden" name="task" value="user.logout" />
        <?php } ?>
        <?php echo JHtml::_('form.token'); ?>
	<input type="hidden" name="return" value="<?php echo base64_encode($url) ?>" />
    </form>
	<div class="clear"></div>
<?php }

?>

