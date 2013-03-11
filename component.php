<?php
/**
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined('_JEXEC') or die;
?>
<?php if (JRequest::getString('type')=='raw'):?>
<jdoc:include type="component" />
<?php else: ?>
<!DOCTYPE html>
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/base.css" type="text/css" media="screen, print" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/layout.css" type="text/css" media="screen, print" />
</head>
<body class="contentpane">
<div class="headerlogo"> <a href="<?php echo $this->baseurl ?>" id="logo"> <IMG src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/logo.png" alt="joomskeleton"> </a> </div>
<jdoc:include type="message" />
<jdoc:include type="component" />
</body>
</html>
<?php endif; ?>
