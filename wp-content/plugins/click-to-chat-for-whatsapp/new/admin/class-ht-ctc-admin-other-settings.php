<?php
/**
 * Other settings page - admin 
 * 
 * this main settings page contains .. 
 * 
 *  Analytics, .. 
 * 
 * @package ctc
 * @subpackage admin
 * @since 3.0 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Admin_Other_Settings' ) ) :

class HT_CTC_Admin_Other_Settings {

    public function menu() {

        add_submenu_page(
            'click-to-chat',
            'Other-Settings',
            'Other Settings',
            'manage_options',
            'click-to-chat-other-settings',
            array( $this, 'settings_page' )
        );
    }

    public function settings_page() {

        if ( ! current_user_can('manage_options') ) {
            return;
        }

        ?>

        <div class="wrap">

            <?php settings_errors(); ?>

            <div class="row">
                <div class="col s12 m12 xl8 options">
                    <form action="options.php" method="post" class="">
                        <?php settings_fields( 'ht_ctc_os_page_settings_fields' ); ?>
                        <?php do_settings_sections( 'ht_ctc_os_page_settings_sections_do' ) ?>
                        <?php submit_button() ?>
                    </form>
                </div>
                <!-- <div class="col s12 m12 xl6 ht-ctc-admin-sidebar">
                </div> -->
            </div>

        </div>

        <?php

    }

    public function settings() {

        register_setting( 'ht_ctc_os_page_settings_fields', 'ht_ctc_othersettings' , array( $this, 'options_sanitize' ) );
        
        add_settings_section( 'ht_ctc_os_settings_sections_add', '', array( $this, 'main_settings_section_cb' ), 'ht_ctc_os_page_settings_sections_do' );
        
        add_settings_field( 'ht_ctc_analytics', 'Analytics', array( $this, 'ht_ctc_analytics_cb' ), 'ht_ctc_os_page_settings_sections_do', 'ht_ctc_os_settings_sections_add' );
        add_settings_field( 'ht_ctc_animations', 'Animations', array( $this, 'ht_ctc_animations_cb' ), 'ht_ctc_os_page_settings_sections_do', 'ht_ctc_os_settings_sections_add' );
        add_settings_field( 'ht_ctc_othersettings', 'Other Settings', array( $this, 'ht_ctc_othersettings_cb' ), 'ht_ctc_os_page_settings_sections_do', 'ht_ctc_os_settings_sections_add' );
        
    }

    public function main_settings_section_cb() {
        ?>
        <h1>Other Settings</h1>
        <?php
        do_action('ht_ctc_ah_admin' );
    }

    function ht_ctc_analytics_cb() {

        $options = get_option('ht_ctc_othersettings');
        $dbrow = 'ht_ctc_othersettings';

        ?>
        <ul class="collapsible" data-collapsible="accordion" id="ht_ctc_analytics">
        <li class="active">
        <div class="collapsible-header"><?php _e( 'Analytics', 'click-to-chat-for-whatsapp' ); ?></div>
        <div class="collapsible-body">
        
        <?php

        // Google Analytics
        if ( isset( $options['google_analytics'] ) ) {
            ?>
            <p>
                <label>
                    <input name="<?php echo $dbrow ?>[google_analytics]" type="checkbox" value="1" <?php checked( $options['google_analytics'], 1 ); ?> id="google_analytics" />
                    <span><?php _e( 'Google Analytics', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <?php
        } else {
        ?>
        <p>
            <label>
                <input name="<?php echo $dbrow ?>[google_analytics]" type="checkbox" value="1" id="google_analytics" />
                <span><?php _e( 'Google Analytics', 'click-to-chat-for-whatsapp' ); ?></span>
            </label>
        </p>
        <?php
        }
        ?>
        <p class="description"><?php _e( 'If Google Analytics installed creates an Event there', 'click-to-chat-for-whatsapp' ); ?> - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/google-analytics/"><?php _e( 'more info', 'click-to-chat-for-whatsapp' ); ?></a> </p>
        <br>


        <?php

        // Facebook Pixel
        if ( isset( $options['fb_pixel'] ) ) {
            ?>
            <p>
                <label>
                    <input name="<?php echo $dbrow ?>[fb_pixel]" type="checkbox" value="1" <?php checked( $options['fb_pixel'], 1 ); ?> id="fb_pixel" />
                    <span><?php _e( 'Facebook Pixel', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <?php
        } else {
        ?>
        <p>
            <label>
                <input name="<?php echo $dbrow ?>[fb_pixel]" type="checkbox" value="1" id="fb_pixel" />
                <span><?php _e( 'Facebook Pixel', 'click-to-chat-for-whatsapp' ); ?></span>
            </label>
        </p>
        <?php
        }
        ?>
        <p class="description"><?php _e( 'If Facebook Pixel installed creates an Event there', 'click-to-chat-for-whatsapp' ); ?> - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/facebook-pixel/"><?php _e( 'more info', 'click-to-chat-for-whatsapp' ); ?></a> </p>
        <br>


        </div>
        </li>
        </ul>
        <?php
    }

    function ht_ctc_animations_cb() {
        $options = get_option('ht_ctc_othersettings');
        $dbrow = 'ht_ctc_othersettings';

        $show_effect = ( isset( $options['show_effect']) ) ? esc_attr( $options['show_effect'] ) : 'no-show-effects';
        $an_delay = ( isset( $options['an_delay']) ) ? esc_attr( $options['an_delay'] ) : '';
        $an_itr = ( isset( $options['an_itr']) ) ? esc_attr( $options['an_itr'] ) : '';
        $show_effect_list = array(
            'no-show-effects',
            'From Center',
            'From Corner',
        );

        $an_type = ( isset( $options['an_type']) ) ? esc_attr( $options['an_type'] ) : '';
        
        $an_list = array(
            'no-animation',
            'bounce',
            'flash',
            'pulse',
            'heartBeat',
            'flip',
        );

        ?>
        <ul class="collapsible" data-collapsible="accordion" id="ht_ctc_animations">
        <li class="active">
        <div class="collapsible-header"><?php _e( 'Animations', 'click-to-chat-for-whatsapp' ); ?></div>
        <div class="collapsible-body">

        <p class="description"><a target="_blank" href="https://holithemes.com/plugins/click-to-chat/animations/">Animations</a></p>
        <br><br><br>


        <!-- animation on load -->
        <div class="row">
            <div class="col s6">
                <p><?php _e( 'Animations', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <select name="ht_ctc_othersettings[an_type]" class="select_an_type">
                <?php 
                
                foreach ( $an_list as $value ) {
                ?>
                <option value="<?php echo $value ?>" <?php echo $an_type == $value ? 'SELECTED' : ''; ?> ><?php echo $value ?></option>
                <?php
                }

                ?>
                </select>
                <label><?php _e( 'Animations', 'click-to-chat-for-whatsapp' ); ?></label>
            </div>
        </div>

        <!-- animation delay -->
        <div class="row an_delay">
            <div class="col s6">
                <p><?php _e( 'Animation Delay', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <input name="<?php echo $dbrow ?>[an_delay]" value="<?php echo $an_delay ?>" id="an_delay" type="number" min="0" class="" >
                <label for="an_delay"><?php _e( 'Animation Delay', 'click-to-chat-for-whatsapp' ); ?></label>
                <p class="description"><?php _e( 'E.g. Add 1 for 1 second delay', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
        </div>

        <!-- animation iteration -->
        <div class="row an_itr">
            <div class="col s6">
                <p><?php _e( 'Animation Iteration', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <input name="<?php echo $dbrow ?>[an_itr]" value="<?php echo $an_itr ?>" id="an_itr" type="number" min="1" class="" >
                <label for="an_itr"><?php _e( 'Animation Iteration', 'click-to-chat-for-whatsapp' ); ?></label>
                <p class="description"><?php _e( 'E.g. Add 2 to repeat animation 2 times', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
        </div>

        <hr style="width: 50%;">
        <br><br>

        <!-- Show effect -->
        <div class="row">
            <div class="col s6">
                <p><?php _e( 'Show Effects', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <select name="ht_ctc_othersettings[show_effect]" class="show_effect">
                <?php 
                
                foreach ( $show_effect_list as $value ) {
                ?>
                <option value="<?php echo $value ?>" <?php echo $show_effect == $value ? 'SELECTED' : ''; ?> ><?php echo $value ?></option>
                <?php
                }

                ?>
                </select>
                <label><?php _e( 'How to display', 'click-to-chat-for-whatsapp' ); ?></label>
                <p class="description" style="font-size: 0.9em">(<?php _e( 'Looks good for some styles or if no-animation', 'click-to-chat-for-whatsapp' ); ?>)</p>
            </div>
        </div>

        </div>
        </li>
        </ul>
        <?php
    }

    // Other settings
    //      detect device
    function ht_ctc_othersettings_cb() {

        $options = get_option('ht_ctc_othersettings');
        $dbrow = 'ht_ctc_othersettings';

        $li_active_gr_sh = ( isset( $options['enable_group'] ) || isset( $options['enable_share'] ) ) ? "class='active'" : '';
        ?>

        <ul class="collapsible" data-collapsible="accordion" id="ht_ctc_othersettings">
        <li class="active">
        <div class="collapsible-header"><?php _e( 'Other Settings', 'click-to-chat-for-whatsapp' ); ?></div>
        <div class="collapsible-body">

        <?php
        // cache issue while selecting styles
        if ( isset( $options['select_styles_issue'] ) ) {
            ?>
            <p id="styles_issue">
                <label>
                    <input name="<?php echo $dbrow ?>[select_styles_issue]" type="checkbox" value="1" <?php checked( $options['select_styles_issue'], 1 ); ?> id="select_styles_issue" />
                    <!-- <span>Style for device is not as expected(due to cache)</span> -->
                    <span><?php _e( 'Check this only, If styles for mobile, desktop not selected as expected(due to cache)', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p id="styles_issue">
                <label>
                    <input name="<?php echo $dbrow ?>[select_styles_issue]" type="checkbox" value="1" id="select_styles_issue" />
                    <span><?php _e( 'Check this only, If styles for mobile, desktop not selected as expected(due to cache)', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <?php
        }
        ?>
        <br>

        </div>
        </li>
        </ul>


        <br>

        <!-- enable group, share features -->
        <ul class="collapsible" data-collapsible="accordion" id="ht_ctc_enable_share_group">
        <li <?php echo $li_active_gr_sh; ?>>
        <div class="collapsible-header"><?php _e( 'Group, Share features', 'click-to-chat-for-whatsapp' ); ?></div>
        <div class="collapsible-body">
        
        <?php

        // enable group
        if ( isset( $options['enable_group'] ) ) {
        ?>
        <p>
            <label>
                <input name="ht_ctc_othersettings[enable_group]" type="checkbox" value="1" <?php checked( $options['enable_group'], 1 ); ?> id="enable_group" />
                <span><?php _e( 'Enable Group Features', 'click-to-chat-for-whatsapp' ); ?></span>
            </label>
            <p class="description">  - <a href="<?php echo admin_url( 'admin.php?page=click-to-chat-group-feature' ); ?>"><?php _e( 'Group Settings page', 'click-to-chat-for-whatsapp' ); ?></a> </p>
        </p>
        <?php
        } else {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_othersettings[enable_group]" type="checkbox" value="1" id="enable_group" />
                    <span><?php _e( 'Enable Group Features', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <p class="description">  - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/enable-group-feature/"><?php _e( 'more info', 'click-to-chat-for-whatsapp' ); ?></a> </p>
            <?php
        }
        ?>
        <br>
        <?php


        // enable share
        if ( isset( $options['enable_share'] ) ) {
        ?>
        <p>
            <label>
                <input name="ht_ctc_othersettings[enable_share]" type="checkbox" value="1" <?php checked( $options['enable_share'], 1 ); ?> id="enable_share" />
                <span><?php _e( 'Enable Share Features', 'click-to-chat-for-whatsapp' ); ?></span>
            </label>
            <p class="description">  - <a href="<?php echo admin_url( 'admin.php?page=click-to-chat-share-feature' ); ?>"><?php _e( 'Share Settings page', 'click-to-chat-for-whatsapp' ); ?></a> </p>
        </p>
        <?php
        } else {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_othersettings[enable_share]" type="checkbox" value="1" id="enable_share" />
                    <span><?php _e( 'Enable Share Features', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <p class="description">  - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/enable-share-feature/"><?php _e( 'more info', 'click-to-chat-for-whatsapp' ); ?></a> </p>
            <?php
        }
        ?>
        <br>
        
        <!-- chat -->
        <p class="description"><?php _e( "Chat settings are enabled by default. If like to hide chat on all pages select", 'click-to-chat-for-whatsapp' ); ?> <a target="_blank" href="<?php echo admin_url( 'admin.php?page=click-to-chat#showhide_settings' ); ?>"><?php _e( 'show on selected pages', 'click-to-chat-for-whatsapp' ); ?></a> - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/enable-chat"><?php _e( 'more info', 'click-to-chat-for-whatsapp' ); ?></a> </p>
        <br>


        </div>
        </li>
        </ul>

        <br>

        <!-- Troubleshoot, Debug, ..  -->
        <ul class="collapsible" data-collapsible="accordion" id="ht_ctc_debug">
        <li>
        <div class="collapsible-header"><?php _e( 'Debug, Troubleshoot, ..', 'click-to-chat-for-whatsapp' ); ?></div>
        <div class="collapsible-body">
        

        <?php

        // debug mode 
        if ( isset( $options['debug_mode'] ) ) {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_othersettings[debug_mode]" type="checkbox" value="1" <?php checked( $options['debug_mode'], 1 ); ?> id="debug_mode"   />
                    <span><?php _e( 'Debug mode', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_othersettings[debug_mode]" type="checkbox" value="1" id="debug_mode"   />
                    <span><?php _e( 'Debug mode', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <?php
        }

        ?>

        <br>
        <p class="description">
            <ul>
            Troubleshoot
                <ol>Clear Cache</ol>
                <ol>Check Display Settings</ol>
            </ul>
        </p>
        <!-- <p class="description">If still an issue: Plesae enable debug mode and Contact us</p> -->
        <p class="description">If still an issue: Please Contact us. Mail: <a href="mailto:ctc@holithemes.com">ctc@holithemes.com</a>, <a target="_blank" href="http://api.whatsapp.com/send?phone=919494429789&text=Hi%20HoliThemes,%20I%20have%20a%20question">WhatsApp Us</a></p>
        <br>

        <?php

        // delete options 
        if ( isset( $options['delete_options'] ) ) {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_othersettings[delete_options]" type="checkbox" value="1" <?php checked( $options['delete_options'], 1 ); ?> id="delete_options"   />
                    <span><?php _e( 'Delete this plugin settings when uninstalls', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_othersettings[delete_options]" type="checkbox" value="1" id="delete_options"   />
                    <span><?php _e( 'Delete this plugin settings when uninstalls', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <?php
        }

        ?>



        </div>
        </li>
        </ul>

        <?php
    }


    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function options_sanitize( $input ) {

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'not allowed to modify - please contact admin ' );
        }

        $new_input = array();

        foreach ($input as $key => $value) {

            if ( 'placeholder' == $key ) {
                $new_input[$key] = sanitize_textarea_field( $input[$key] );
            } elseif ( isset( $input[$key] ) ) {
                $new_input[$key] = sanitize_text_field( $input[$key] );
            }

        }

        return $new_input;
    }





}

$ht_ctc_admin_other_settings = new HT_CTC_Admin_Other_Settings();

add_action('admin_menu', array($ht_ctc_admin_other_settings, 'menu') );
add_action('admin_init', array($ht_ctc_admin_other_settings, 'settings') );

endif; // END class_exists check