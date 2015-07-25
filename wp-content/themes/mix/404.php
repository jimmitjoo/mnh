<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http:/wpopal.com
 * @support  http://wpopal.com
 */

/*
*Template Name: 404 Page
*/

?>

<?php get_header( $wpoEngine->getHeaderLayout() ); ?>

<section class="wpo-mainbody clearfix 404-page">
	<section class="container">
		<div class="page_not_found text-center clearfix">
			<h1 class="skin_color error-title">404</h1>
			<div class="col-sm-6 col-sm-offset-3">
				<header class="h1 error-content text-none">
					<?php echo wpo_theme_options('404','Oops 404 again! That page can\'t be found.'); ?>
				</header>
				<footer class="page-footer">
					<p>It looks like nothing was found at this location. Maybe try one of the links below?</p>
					<?php get_search_form(); ?>
				</footer>
			</div>
		</div>
	</section>
</section>

<?php get_footer(); ?>