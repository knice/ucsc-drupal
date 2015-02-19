<?php

################################################################################
# if we have a custom CSS, add it to the mix                                   #
################################################################################

$ucscv2_css_url = theme_get_setting("ucscv2_css_url");

if ($ucscv2_css_url != "") {
  drupal_add_css(
    $ucscv2_css_url,
    array(
      "type" => "external",
    )
  );
}

################################################################################
# determine if this page should be displayed full-width or fixed-width, based  #
# on the theme settings and the current path                                   #
################################################################################

$ucscv2_fixed_width_default = (theme_get_setting("ucscv2_fixed_width_default") == "" ? "all" : theme_get_setting("ucscv2_fixed_width_default"));

$ucscv2_fixed_width_exceptions = theme_get_setting("ucscv2_fixed_width_exceptions");

$path = drupal_strtolower(drupal_get_path_alias($_GET['q']));

$page_match = drupal_match_path($path, $ucscv2_fixed_width_exceptions);

if ($page_match) {
  if ($ucscv2_fixed_width_default == "all") {
    $ucscv2_fixed_width = false;
  } else {
    $ucscv2_fixed_width = true;
  }
} else {
  if ($ucscv2_fixed_width_default == "all") {
    $ucscv2_fixed_width = true;
  } else {
    $ucscv2_fixed_width = false;
  }
}

if ($ucscv2_fixed_width) {
  echo "<div id=\"outer\" class=\"fixed-width\">\n";
} else {
  echo "<div id=\"outer\" class=\"full-width\">\n";
}

?>



	<!-- Accessibility links. Hidden until they receive :focus -->
  <ul id="access-links">
      <li><a href="#content">Skip to main content</a></li>
      <li><a href="#main-nav">Skip to primary navigation</a></li>
  </ul>

<div id="wrap" class="rob-was-here">
<div class="container_12">

    	<div class="grid_9 omega">
    		<ul id="utility-nav">
    			<li class="home"><a href="http://www.ucsc.edu">University Home</a></li>
    			<li><a href="http://my.ucsc.edu" title="Go to the MyUCSC portal">MyUCSC</a></li>
    			<li><a href="http://www.ucsc.edu/tools/people.html" title="Find People - UCSC People Search">People</a></li>
    			<li><a href="http://www.ucsc.edu/tools/calendars.html" title="View UCSC events, academic, and administrative calendars">Calendars</a></li>
    			<li><a href="http://www.ucsc.edu/tools/azindex.html" title="A to Z index of important links">A-Z Index</a></li>
    		</ul>
    	</div>

    	<div class="grid_3 omega" id="search">
          <?php print render($page["search"]); ?>
    	</div>

      <div class="clear"></div>

    	<div class="grid_12">

	    	<a href="http://www.ucsc.edu" title="Go to UCSC homepage" id="logo">UC Santa Cruz home</a>

	    	  <?php

          $site_name_length = strlen($site_name);

 	        if ($site_name_length >= 52) {
 	          $title_class = "title-mega-long";
 	        } else if ($site_name_length >= 46) {
	          $title_class = "title-super-long";
	        } else if ($site_name_length >= 38) {
	          $title_class = "title-extra-long";
	        } else if ($site_name_length >= 34) {
	          $title_class = "title-long";
	        } else if ($site_name_length >= 30) {
	          $title_class = "title-medium";
	        } else if ($site_name_length >= 28) {
	          $title_class = "title-short";
	        } else {
	          $title_class = "title-standard";
	        }

          $ucscv2_site_name = preg_replace(
            "/  /",
            "<br>",
            $site_name
          );

          ?>

	    	  <h1 id="site-title" class="<?php print $title_class; ?>">
	    	    	<?php echo l($ucscv2_site_name, "<front>", array('attributes' => array('title' => t('Back to homepage')),'html' => TRUE));?>
	    	  </h1>
    	</div>

    <div class="clear"></div>

    	<div class="grid_12 alpha" id="main-nav">
    		<?php print render($page["main_menu"]); ?>
    	</div>

    <div class="clear"></div>


<?php
// Logic to grab the appropriate template partial.
if ($is_front) {

	if (theme_get_setting("ucscv2_frontpage_template") == "leftcol") {
		require_once("partials/page-home-left.tpl.php");
	} elseif (theme_get_setting("ucscv2_frontpage_template") == "rightcol") {
		require_once("partials/page-home-right.tpl.php");
	} elseif (theme_get_setting("ucscv2_frontpage_template") == "department") {
    require_once("partials/page-home-dept.tpl.php");
  } else {
		require_once("partials/page-home-default.tpl.php");
	}

} else {
	require_once("partials/page-internal.tpl.php");
}

 ?>


<div class="clear"></div>

<div id="footer">

  <?php /* Set classes for footer divs */
    if ($page["footer"]) {
      // Links region is populated
      $footer_grid_class = "grid_6 pull_6";
    }
    else {
      // Links region is empty
      $footer_grid_class = "grid_12";
    }
  ?>

	<?php if($page["footer"]): ?>
    <div class="grid_6 push_6" id="footer-links">
		  <?php print render($page["footer"]); ?>
    </div>
	<?php endif; ?>

	<div class="<?php print $footer_grid_class; ?>" id="campus-info">
		<p>This site is maintained by:
<?php

echo "<script type=\"text/javascript\">\n";

echo
  "document.write(Base64.decode('" .
  base64_encode(
    "<a href=\"mailto:" .
    variable_get("site_mail", $_SERVER["SERVER_ADMIN"]) .
    "\">" .
    variable_get("site_mail", $_SERVER["SERVER_ADMIN"]) .
    "</a>"
  ) .
  "'));\n";

echo "</script>\n";

?>
    </p>
    <p>University of California Santa Cruz, 1156 High Street, Santa Cruz, CA 95064</p>
		<p>&copy; <?php print date("Y"); ?> The Regents of the University of California. All Rights Reserved.</p>

	</div>

	<div class="clear"></div>

</div>
    <!-- Clearing floated elements from #footer -->
    <div class="clear"></div>
</div><!-- /.container_12 -->
</div><!-- /#wrap -->
</div><!-- /#outer -->
