
<!-- Internal page template -->

	<?php if ($breadcrumb != ""): ?>
	<div class="row grid_12 breadcrumbs">
	<?php print render($breadcrumb); ?>
	</div>
	<?php endif; ?>


	<?php if ($page["sidebar_first"] || $page["sidebar_second"]) { ?>
		<div class="row">
		 <div class="grid_9 push_3">
	<?php } else { ?>
		<div class="row grid_12">
	<?php } ?>

	<h1 class="page_title"><?php print $title; ?></h1>

	<?php if($page["above_content"]): ?>
	  <div class="above_content">
	    <?php print render($page["above_content"]); ?>
	  </div>
	<?php endif; ?>

	<div class="content" id="main-content">
		<?php if ($show_messages && $messages): print render($messages); endif; ?>
		<?php if($page["help"]): print '<div class="help">' . render($page["help"]) . '</div>'; endif; ?>
		<?php print render($tabs); ?>
		<?php print render($action_links); ?>
		<?php print render($page["content"]); ?>
	</div>

	<?php if($page["below_content"]): ?>
    <div class="below_content">
        <?php print render($page["below_content"]); ?>
    </div>
	<?php endif; ?>

	<?php if ($page["sidebar_first"] || $page["sidebar_second"]) { ?>
	</div>
		<div class="grid_3 pull_9 left_content alpha">
			<?php print render($page["sidebar_first"]); ?>
			<?php print render($page["sidebar_second"]); ?>
		</div>
	</div>
	<?php } ?>
