<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.techmuzz.com
 * @since      1.0.0
 *
 * @package    Custom_HL
 * @subpackage Custom_HL/admin/partials
 */
?>
<div id="custom-hl-ajax-saving">
    <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/ajax-loader.gif'; ?>" alt="loading" id="loading" />
</div>
<div class="custom-hl-content">
    <div class="form-v1-content">
        <div class="wizard-form">
            <form class="form-register" id="custom-hl-options" method="post" name="custom_hl_options" action="options.php">
                <?php
                    //Grab all options
                    $options = get_option($this->plugin_name);

                    $switch = $options['switch'];
                    $domains = $options['domains'];
                    $element = $options['element'];
                    $target = $options['target'];
                    $exampleText = $options['exampleText'];
                ?>
                <?php
                    settings_fields($this->plugin_name);
                    do_settings_sections($this->plugin_name);
                ?>
                <div id="form-total">
                    <!-- SECTION 1 -->
                    <h2>
                        <span class="step-text">Configure Anchor tag</span>
                    </h2>
                    <section>
                        <div class="inner">
                            <div class="wizard-header">
                                <h3 class="heading">Configure Anchor tag</h3>
                                <p>Choose options to update anchor tag in post/article.</p>
                            </div>
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <fieldset>
                                        <legend>Target</legend>
                                        <select id="<?php echo $this->plugin_name; ?>-target" name="<?php echo $this->plugin_name; ?>[target]" >
                                            <option value="-1" <? echo (($target=="-1") ? "selected" : ""); ?>>Select Target</option>
                                            <option value="_blank" <? echo ($target=="_blank" ? "selected" : ""); ?>>_blank</option>
                                            <option value="_self" <? echo ($target=="_self" ? "selected" : ""); ?>>_self</option>
                                            <option value="_parent" <? echo ($target=="_parent" ? "selected" : ""); ?>>_parent</option>
                                            <option value="_top" <? echo ($target=="_top" ? "selected" : ""); ?>>_top</option>
                                            <option value="framename" <? echo ($target=="framename" ? "selected" : ""); ?>>framename</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <fieldset>
                                        <legend>Exclude Domains</legend>
                                        <textarea id="<?php echo $this->plugin_name; ?>-domains" rows="5" name="<?php echo $this->plugin_name; ?>[domains]" placeholder="Provide domains to exclude as seperate line like www.domain.com"><?php if(!empty($domains)) echo $domains; ?></textarea>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <fieldset>
                                        <legend>HTML to append</legend>
                                        <textarea id="<?php echo $this->plugin_name; ?>-element" name="<?php echo $this->plugin_name; ?>[element]" placeholder='<img src="https://techmuzz.com/favicon.ico" />' ><?php if(!empty($element)) echo $element; ?></textarea>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- SECTION 2 -->
                    <h2>
                        <span class="step-text">Preview & Apply</span>
                    </h2>
                    <section>
                        <div class="inner">
                            <div class="wizard-header">
                                <h3 class="heading">Preview & Apply</h3>
                                <p>Note: CSS in your website can impact the output.</p>
                            </div>
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <fieldset>
                                        <legend>Example Text</legend>
                                        <textarea id="<?php echo $this->plugin_name; ?>-exampleText" rows="3" name="<?php echo $this->plugin_name; ?>[exampleText]" ><?php echo (!is_null($exampleText) && !empty($exampleText)) ? $exampleText : 'This is the best <a href="https://www.domain.com" target="_blank">website</a> in this world.'; ?></textarea>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <fieldset>
                                        <legend>Output Text</legend>
                                        <p id="outputText">This is the best <a href="https://www.google.com" target="_blank">website</a> in this world.</p>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-holder">
                                    <fieldset>
                                        <legend>Apply Changes</legend>
                                        <label class="switch">
                                            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-switch" name="<?php echo $this->plugin_name; ?>[switch]" value="1" <?php checked($switch, 1); ?> />
                                            <span class="slider round"></span>
                                        </label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
</div>