<?php

function ucscv3_form_system_theme_settings_alter(&$form, &$form_state) {
  ################################################################################
  # basic ucsc settings                                                        #
  ################################################################################

  $form["ucscv3"] = array(
    "#type" => "fieldset",
    "#title" => "UCSC Settings",
    "#description" => "<p>These settings control the appearance and functionality of the UCSC theme.</p>",
  );

    $form["ucscv3"]["ucsc_frontpage_template"] = array(
    "#type" => "radios",
    "#title" => t("Choose a template to use for your home page."),
    "#default_value" => (theme_get_setting("ucsc_frontpage_template") == "" ? "default" : theme_get_setting("ucsc_frontpage_template")),
    "#options" => array(
      "default" => "Division",
      "department" => "Department",
      "leftcol" => "Left Column",
      "rightcol" => "Right Column",
      ),
      "#required" => true,
  );

  $form["ucscv3"]["ucsc_google_cse"] = array(
    "#type" => "textfield",
    "#title" => t("Google Custom Search Engine ID"),
    "#default_value" => theme_get_setting("ucsc_google_cse"),
  );

  $form["ucscv3"]["ucsc_google_url"] = array(
    "#type" => "textfield",
    "#title" => t("Google Custom Search Engine URL"),
    "#default_value" => theme_get_setting("ucsc_google_url"),
  );

  $form["ucscv3"]["ucscv3_css_url"] = array(
    "#type" => "textfield",
    "#title" => t("Supplementary CSS URL"),
    "#default_value" => theme_get_setting("ucscv3_css_url"),
  );

  ################################################################################
  # add a section to the theme settings page that controls which pages on the    #
  # site are full-width and which are fixed-width                                #
  ################################################################################

  $form["ucscv3"]["ucsc_fixed_width_default"] = array(
    "#type" => "radios",
    "#title" => t("Show fixed width on specific pages"),
    "#default_value" => (theme_get_setting("ucsc_fixed_width_default") == "" ? "all" : theme_get_setting("ucsc_fixed_width_default")),
    "#options" => array(
      "all" => "All pages except those listed",
      "listed" => "Only the listed pages",
    ),
    "#required" => true,
  );

  $form["ucscv3"]["ucsc_fixed_width_exceptions"] = array(
    "#type" => "textarea",
    "#title" => t("Site Width Exceptions"),
    "#default_value" => theme_get_setting("ucsc_fixed_width_exceptions"),
    "#description" => "Specify pages by using their paths. Enter one path per line. The '*' character is a wildcard. Example paths are blog for the blog page and blog/* for every personal blog. <front> is the front page.",
  );

  ####################
  # UCSC logo upload #
  ####################

  $form["logo"]["settings"]["logo_path"]["#weight"] = 9;
  $form["logo"]["settings"]["logo_upload"]["#weight"] = 11;

  return $form;
}

?>
