<?php

/**
 * Swrice Custom Footer Manager
 * 
 * @package Swrice Footer
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

class Swrice_Footer_Manager {
    
    private $option_name = 'swrice_footer_settings';
    
    public function __construct() {
        // Admin menu
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        
        // Frontend hooks
        add_action('wp_footer', array($this, 'render_footer'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        
        // Admin scripts
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }
    
    /**
     * Add admin menu page
     */
    public function add_admin_menu() {
        add_options_page(
            'Swrice Footer Settings',
            'Swrice Footer',
            'manage_options',
            'swrice-footer',
            array($this, 'render_admin_page')
        );
    }
    
    /**
     * Register settings
     */
    public function register_settings() {
        register_setting('swrice_footer_group', $this->option_name, array($this, 'sanitize_settings'));
    }
    
    /**
     * Enqueue admin scripts
     */
    public function enqueue_admin_scripts($hook) {
        if ($hook !== 'settings_page_swrice-footer') {
            return;
        }
        
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        
        // Select2 for better multi-select
        wp_enqueue_style('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
        wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'));
    }
    
    /**
     * Sanitize settings
     */
    public function sanitize_settings($input) {
        $sanitized = array();
        
        $sanitized['enabled'] = isset($input['enabled']) ? 1 : 0;
        $sanitized['logo_url'] = esc_url_raw($input['logo_url']);
        $sanitized['site_title'] = sanitize_text_field($input['site_title']);
        $sanitized['tagline'] = sanitize_text_field($input['tagline']);
        $sanitized['bg_color'] = sanitize_hex_color($input['bg_color']);
        $sanitized['text_color'] = sanitize_hex_color($input['text_color']);
        $sanitized['accent_color'] = sanitize_hex_color($input['accent_color']);
        
        // Column 1
        $sanitized['col1_heading'] = sanitize_text_field($input['col1_heading']);
        $sanitized['col1_pages'] = isset($input['col1_pages']) && is_array($input['col1_pages']) 
            ? array_map('absint', $input['col1_pages']) 
            : array();
        
        // Column 2
        $sanitized['col2_heading'] = sanitize_text_field($input['col2_heading']);
        $sanitized['col2_pages'] = isset($input['col2_pages']) && is_array($input['col2_pages']) 
            ? array_map('absint', $input['col2_pages']) 
            : array();
        
        // Column 3
        $sanitized['col3_heading'] = sanitize_text_field($input['col3_heading']);
        $sanitized['col3_pages'] = isset($input['col3_pages']) && is_array($input['col3_pages']) 
            ? array_map('absint', $input['col3_pages']) 
            : array();
        
        // Newsletter
        $sanitized['newsletter_heading'] = sanitize_text_field($input['newsletter_heading']);
        $sanitized['newsletter_text'] = sanitize_textarea_field($input['newsletter_text']);
        $sanitized['newsletter_placeholder'] = sanitize_text_field($input['newsletter_placeholder']);
        
        // Social Media
        $sanitized['facebook_url'] = esc_url_raw($input['facebook_url']);
        $sanitized['twitter_url'] = esc_url_raw($input['twitter_url']);
        $sanitized['linkedin_url'] = esc_url_raw($input['linkedin_url']);
        $sanitized['youtube_url'] = esc_url_raw($input['youtube_url']);
        
        // Copyright
        $sanitized['copyright_text'] = sanitize_text_field($input['copyright_text']);
        $sanitized['privacy_url'] = esc_url_raw($input['privacy_url']);
        $sanitized['terms_url'] = esc_url_raw($input['terms_url']);
        
        return $sanitized;
    }
    
    /**
     * Get default settings
     */
    private function get_defaults() {
        return array(
            'enabled' => 0,
            'logo_url' => '',
            'site_title' => get_bloginfo('name'),
            'tagline' => 'Premium WordPress & LearnDash Solutions',
            'bg_color' => '#1e3a8a',
            'text_color' => '#ffffff',
            'accent_color' => '#3b82f6',
            'col1_heading' => 'Products',
            'col1_pages' => array(),
            'col2_heading' => 'Support',
            'col2_pages' => array(),
            'col3_heading' => 'Company',
            'col3_pages' => array(),
            'newsletter_heading' => 'Stay Updated',
            'newsletter_text' => 'Get the latest updates and exclusive offers.',
            'newsletter_placeholder' => 'Enter your email',
            'facebook_url' => '',
            'twitter_url' => '',
            'linkedin_url' => '',
            'youtube_url' => '',
            'copyright_text' => '© ' . date('Y') . ' ' . get_bloginfo('name') . '. All rights reserved.',
            'privacy_url' => '',
            'terms_url' => '',
        );
    }
    
    /**
     * Get settings
     */
    private function get_settings() {
        $defaults = $this->get_defaults();
        $settings = get_option($this->option_name, $defaults);
        return wp_parse_args($settings, $defaults);
    }
    
    /**
     * Get all pages for dropdown
     */
    private function get_all_pages() {
        $pages = get_pages(array(
            'sort_column' => 'post_title',
            'sort_order' => 'ASC',
            'post_status' => 'publish'
        ));
        
        return $pages;
    }
    
    /**
     * Render page multi-select field
     */
    private function render_page_selector($field_name, $selected_pages) {
        $pages = $this->get_all_pages();
        ?>
        <select name="<?php echo esc_attr($field_name); ?>[]" class="swrice-page-selector" multiple="multiple" style="width: 100%; max-width: 500px;">
            <?php foreach ($pages as $page): ?>
                <option value="<?php echo esc_attr($page->ID); ?>" <?php echo in_array($page->ID, $selected_pages) ? 'selected' : ''; ?>>
                    <?php echo esc_html($page->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description">Multiple pages select kar sakte hain. Drag karke order change kar sakte hain.</p>
        <?php
    }
    
    /**
     * Render admin page
     */
    public function render_admin_page() {
        $settings = $this->get_settings();
        ?>
        <div class="wrap">
            <h1>🎨 Swrice Custom Footer Settings</h1>
            
            <form method="post" action="options.php">
                <?php settings_fields('swrice_footer_group'); ?>
                
                <div class="swrice-footer-admin">
                    
                    <!-- Enable/Disable -->
                    <div class="swrice-card">
                        <h2>⚙️ General Settings</h2>
                        <table class="form-table">
                            <tr>
                                <th scope="row">Enable Footer</th>
                                <td>
                                    <label class="swrice-toggle">
                                        <input type="checkbox" name="<?php echo $this->option_name; ?>[enabled]" value="1" <?php checked($settings['enabled'], 1); ?>>
                                        <span class="swrice-toggle-slider"></span>
                                        <strong style="margin-left: 10px;">Enable custom footer on your website</strong>
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Branding -->
                    <div class="swrice-card">
                        <h2>🏷️ Branding</h2>
                        <table class="form-table">
                            <tr>
                                <th scope="row">Logo URL</th>
                                <td>
                                    <input type="text" name="<?php echo $this->option_name; ?>[logo_url]" value="<?php echo esc_attr($settings['logo_url']); ?>" class="regular-text" placeholder="https://example.com/logo.png">
                                    <button type="button" class="button button-secondary swrice-upload-logo" style="margin-left: 10px;">📁 Upload Logo</button>
                                    <p class="description">Logo upload karein ya URL paste karein</p>
                                    <?php if (!empty($settings['logo_url'])): ?>
                                        <div style="margin-top: 10px;">
                                            <img src="<?php echo esc_url($settings['logo_url']); ?>" style="max-width: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Site Title</th>
                                <td>
                                    <input type="text" name="<?php echo $this->option_name; ?>[site_title]" value="<?php echo esc_attr($settings['site_title']); ?>" class="regular-text">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Tagline</th>
                                <td>
                                    <input type="text" name="<?php echo $this->option_name; ?>[tagline]" value="<?php echo esc_attr($settings['tagline']); ?>" class="regular-text">
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Colors -->
                    <div class="swrice-card">
                        <h2>🎨 Colors</h2>
                        <table class="form-table">
                            <tr>
                                <th scope="row">Background Color</th>
                                <td>
                                    <input type="text" name="<?php echo $this->option_name; ?>[bg_color]" value="<?php echo esc_attr($settings['bg_color']); ?>" class="color-picker">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Text Color</th>
                                <td>
                                    <input type="text" name="<?php echo $this->option_name; ?>[text_color]" value="<?php echo esc_attr($settings['text_color']); ?>" class="color-picker">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Accent Color</th>
                                <td>
                                    <input type="text" name="<?php echo $this->option_name; ?>[accent_color]" value="<?php echo esc_attr($settings['accent_color']); ?>" class="color-picker">
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Column 1 -->
                    <div class="swrice-card">
                        <h2>📑 Column 1</h2>
                        <table class="form-table">
                            <tr>
                                <th scope="row">Heading</th>
                                <td>
                                    <input type="text" name="<?php echo $this->option_name; ?>[col1_heading]" value="<?php echo esc_attr($settings['col1_heading']); ?>" class="regular-text" placeholder="Products">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Select Pages</th>
                                <td>
                                    <?php $this->render_page_selector($this->option_name . '[col1_pages]', $settings['col1_pages']); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Column 2 -->
                    <div class="swrice-card">
                        <h2>📑 Column 2</h2>
                        <table class="form-table">
                            <tr>
                                <th scope="row">Heading</th>
                                <td>
                                    <input type="text" name="<?php echo $this->option_name; ?>[col2_heading]" value="<?php echo esc_attr($settings['col2_heading']); ?>" class="regular-text" placeholder="Support">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Select Pages</th>
                                <td>
                                    <?php $this->render_page_selector($this->option_name . '[col2_pages]', $settings['col2_pages']); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Column 3 -->
                    <div class="swrice-card">
                        <h2>📑 Column 3</h2>
                        <table class="form-table">
                            <tr>
                                <th scope="row">Heading</th>
                                <td>
                                    <input type="text" name="<?php echo $this->option_name; ?>[col3_heading]" value="<?php echo esc_attr($settings['col3_heading']); ?>" class="regular-text" placeholder="Company">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Select Pages</th>
                                <td>
                                    <?php $this->render_page_selector($this->option_name . '[col3_pages]', $settings['col3_pages']); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Newsletter -->
                    <div class="swrice-card">
                        <h2>📧 Newsletter Section</h2>
                        <table class="form-table">
                            <tr>
                                <th scope="row">Heading</th>
                                <td>
                                    <input type="text" name="<?php echo $this->option_name; ?>[newsletter_heading]" value="<?php echo esc_attr($settings['newsletter_heading']); ?>" class="regular-text">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Description Text</th>
                                <td>
                                    <textarea name="<?php echo $this->option_name; ?>[newsletter_text]" rows="3" class="large-text"><?php echo esc_textarea($settings['newsletter_text']); ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Email Placeholder</th>
                                <td>
                                    <input type="text" name="<?php echo $this->option_name; ?>[newsletter_placeholder]" value="<?php echo esc_attr($settings['newsletter_placeholder']); ?>" class="regular-text">
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="swrice-card">
                        <h2>🌐 Social Media</h2>
                        <table class="form-table">
                            <tr>
                                <th scope="row"><span class="dashicons dashicons-facebook" style="color: #1877f2;"></span> Facebook URL</th>
                                <td>
                                    <input type="url" name="<?php echo $this->option_name; ?>[facebook_url]" value="<?php echo esc_attr($settings['facebook_url']); ?>" class="regular-text" placeholder="https://facebook.com/yourpage">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><span class="dashicons dashicons-twitter" style="color: #1da1f2;"></span> Twitter URL</th>
                                <td>
                                    <input type="url" name="<?php echo $this->option_name; ?>[twitter_url]" value="<?php echo esc_attr($settings['twitter_url']); ?>" class="regular-text" placeholder="https://twitter.com/yourprofile">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><span class="dashicons dashicons-linkedin" style="color: #0a66c2;"></span> LinkedIn URL</th>
                                <td>
                                    <input type="url" name="<?php echo $this->option_name; ?>[linkedin_url]" value="<?php echo esc_attr($settings['linkedin_url']); ?>" class="regular-text" placeholder="https://linkedin.com/company/yourcompany">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><span class="dashicons dashicons-video-alt3" style="color: #ff0000;"></span> YouTube URL</th>
                                <td>
                                    <input type="url" name="<?php echo $this->option_name; ?>[youtube_url]" value="<?php echo esc_attr($settings['youtube_url']); ?>" class="regular-text" placeholder="https://youtube.com/c/yourchannel">
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Copyright & Legal -->
                    <div class="swrice-card">
                        <h2>⚖️ Copyright & Legal</h2>
                        <table class="form-table">
                            <tr>
                                <th scope="row">Copyright Text</th>
                                <td>
                                    <input type="text" name="<?php echo $this->option_name; ?>[copyright_text]" value="<?php echo esc_attr($settings['copyright_text']); ?>" class="large-text">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Privacy Policy URL</th>
                                <td>
                                    <input type="url" name="<?php echo $this->option_name; ?>[privacy_url]" value="<?php echo esc_attr($settings['privacy_url']); ?>" class="regular-text">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Terms of Service URL</th>
                                <td>
                                    <input type="url" name="<?php echo $this->option_name; ?>[terms_url]" value="<?php echo esc_attr($settings['terms_url']); ?>" class="regular-text">
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <?php submit_button('💾 Save Settings', 'primary large'); ?>
                    
                </div>
            </form>
        </div>
        
        <style>
            .swrice-footer-admin {
                max-width: 1200px;
            }
            .swrice-card {
                background: #fff;
                border: 1px solid #ccd0d4;
                box-shadow: 0 1px 1px rgba(0,0,0,.04);
                padding: 20px;
                margin-bottom: 20px;
                border-radius: 4px;
            }
            .swrice-card h2 {
                margin-top: 0;
                padding-bottom: 10px;
                border-bottom: 2px solid #3b82f6;
            }
            .color-picker {
                max-width: 100px;
            }
            
            /* Toggle Switch */
            .swrice-toggle {
                position: relative;
                display: inline-flex;
                align-items: center;
            }
            .swrice-toggle input {
                opacity: 0;
                width: 0;
                height: 0;
            }
            .swrice-toggle-slider {
                position: relative;
                display: inline-block;
                width: 50px;
                height: 26px;
                background-color: #ccc;
                border-radius: 26px;
                transition: .4s;
                cursor: pointer;
            }
            .swrice-toggle-slider:before {
                position: absolute;
                content: "";
                height: 20px;
                width: 20px;
                left: 3px;
                bottom: 3px;
                background-color: white;
                border-radius: 50%;
                transition: .4s;
            }
            .swrice-toggle input:checked + .swrice-toggle-slider {
                background-color: #3b82f6;
            }
            .swrice-toggle input:checked + .swrice-toggle-slider:before {
                transform: translateX(24px);
            }
            
            /* Select2 Custom Styling */
            .select2-container--default .select2-selection--multiple {
                border: 1px solid #8c8f94;
                border-radius: 4px;
                min-height: 40px;
            }
            .select2-container--default.select2-container--focus .select2-selection--multiple {
                border-color: #2271b1;
                box-shadow: 0 0 0 1px #2271b1;
            }
        </style>
        
        <script>
            jQuery(document).ready(function($) {
                // Initialize color pickers
                $('.color-picker').wpColorPicker();
                
                // Initialize Select2 for page selectors
                $('.swrice-page-selector').select2({
                    placeholder: 'Select pages...',
                    allowClear: true,
                    width: '100%'
                });
                
                // Media uploader for logo
                $('.swrice-upload-logo').on('click', function(e) {
                    e.preventDefault();
                    
                    var button = $(this);
                    var input = button.closest('td').find('input[type="text"]');
                    var preview = button.closest('td').find('img');
                    
                    var mediaUploader = wp.media({
                        title: 'Select Logo',
                        button: {
                            text: 'Use this image'
                        },
                        multiple: false
                    });
                    
                    mediaUploader.on('select', function() {
                        var attachment = mediaUploader.state().get('selection').first().toJSON();
                        input.val(attachment.url);
                        
                        if (preview.length) {
                            preview.attr('src', attachment.url);
                        } else {
                            input.after('<div style="margin-top: 10px;"><img src="' + attachment.url + '" style="max-width: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;"></div>');
                        }
                    });
                    
                    mediaUploader.open();
                });
            });
        </script>
        <?php
    }
    
    /**
     * Enqueue frontend styles
     */
    public function enqueue_styles() {
        $settings = $this->get_settings();
        
        if (!$settings['enabled']) {
            return;
        }
        
        wp_add_inline_style('wp-block-library', $this->get_custom_css($settings));
    }
    
    /**
     * Get custom CSS
     */
    private function get_custom_css($settings) {
        $css = "
        .swrice-custom-footer {
            background: linear-gradient(135deg, {$settings['bg_color']} 0%, " . $this->adjust_brightness($settings['bg_color'], -20) . " 100%);
            color: {$settings['text_color']};
            padding: 60px 20px 20px;
            margin-top: 80px;
            padding-right: 50px;
            padding-left: 50px;
        }
        .swrice-footer-container {
        
        }
        .swrice-footer-top {
            gap: 40px;
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .swrice-footer-brand {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .swrice-footer-logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .swrice-footer-logo img {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
        }
        .swrice-footer-logo-text {
            font-size: 24px;
            font-weight: bold;
            color: {$settings['text_color']};
        }
        .swrice-footer-tagline {
            color: " . $this->adjust_brightness($settings['text_color'], -30) . ";
            font-size: 14px;
        }
        .swrice-footer-column h3 {
            color: {$settings['text_color']};
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
            font-family: inherit;
        }
        .swrice-footer-column h3:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: {$settings['accent_color']};
        }
        .swrice-footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .swrice-footer-column ul li {
            margin-bottom: 12px;
        }
        .swrice-footer-column ul li a {
            color: " . $this->adjust_brightness($settings['text_color'], -20) . ";
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        .swrice-footer-column ul li a:hover {
            color: {$settings['accent_color']};
        }
        .swrice-newsletter-form {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }
        .swrice-newsletter-input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid " . $this->adjust_brightness($settings['bg_color'], 20) . ";
            background: rgba(255,255,255,0.1);
            color: {$settings['text_color']};
            border-radius: 4px;
            font-size: 14px;
        }
        .swrice-newsletter-input::placeholder {
            color: " . $this->adjust_brightness($settings['text_color'], -40) . ";
        }
        .swrice-newsletter-btn {
            padding: 12px 25px;
            background: {$settings['accent_color']};
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: opacity 0.3s ease;
        }
        .swrice-newsletter-btn:hover {
            opacity: 0.9;
        }
        .swrice-footer-social {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        .swrice-social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: {$settings['accent_color']};
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s ease;
        }
        .swrice-social-icon:hover {
            background: {$settings['accent_color']};
            color: #fff;
            transform: translateY(-3px);
        }
        .swrice-footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .swrice-footer-copyright {
            color: " . $this->adjust_brightness($settings['text_color'], -30) . ";
            font-size: 14px;
        }
        .swrice-footer-legal {
            display: flex;
            gap: 20px;
        }
        .swrice-footer-legal a {
            color: " . $this->adjust_brightness($settings['text_color'], -30) . ";
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        .swrice-footer-legal a:hover {
            color: {$settings['accent_color']};
        }
        @media (max-width: 1024px) {
            .swrice-footer-top {
                grid-template-columns: 1fr 1fr;
            }
        }
        @media (max-width: 640px) {
            .swrice-footer-top {
                grid-template-columns: 1fr;
            }
            .swrice-footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }
        ";
        
        return $css;
    }
    
    /**
     * Adjust color brightness
     */
    private function adjust_brightness($hex, $percent) {
        $hex = str_replace('#', '', $hex);
        
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        
        $r = max(0, min(255, $r + ($r * $percent / 100)));
        $g = max(0, min(255, $g + ($g * $percent / 100)));
        $b = max(0, min(255, $b + ($b * $percent / 100)));
        
        return '#' . sprintf("%02x%02x%02x", $r, $g, $b);
    }
    
    /**
     * Get pages by IDs
     */
    private function get_pages_by_ids($page_ids) {
        if (empty($page_ids) || !is_array($page_ids)) {
            return array();
        }
        
        $pages = array();
        foreach ($page_ids as $page_id) {
            $page = get_post($page_id);
            if ($page && $page->post_status === 'publish') {
                $pages[] = $page;
            }
        }
        
        return $pages;
    }
    
    /**
     * Render footer
     */
    public function render_footer() {
        $settings = $this->get_settings();
        
        if (!$settings['enabled']) {
            return;
        }
        
        $col1_pages = $this->get_pages_by_ids($settings['col1_pages']);
        $col2_pages = $this->get_pages_by_ids($settings['col2_pages']);
        $col3_pages = $this->get_pages_by_ids($settings['col3_pages']);
        
        ?>
        <footer class="swrice-custom-footer">
            <div class="swrice-footer-container">
                
                <div class="swrice-footer-top">
                    
                    <!-- Brand Section -->
                    <div class="swrice-footer-brand">
                        <div class="swrice-footer-logo">
                            <?php if (!empty($settings['logo_url'])): ?>
                                <img src="<?php echo esc_url($settings['logo_url']); ?>" alt="<?php echo esc_attr($settings['site_title']); ?>">
                            <?php endif; ?>
                            <span class="swrice-footer-logo-text"><?php echo esc_html($settings['site_title']); ?></span>
                        </div>
                        <?php if (!empty($settings['tagline'])): ?>
                            <p class="swrice-footer-tagline"><?php echo esc_html($settings['tagline']); ?></p>
                        <?php endif; ?>
                        
                        <!-- Social Media -->
                        <div class="swrice-footer-social">
                            <?php if (!empty($settings['facebook_url'])): ?>
                                <a href="<?php echo esc_url($settings['facebook_url']); ?>" class="swrice-social-icon" target="_blank" rel="noopener" aria-label="Facebook">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (!empty($settings['twitter_url'])): ?>
                                <a href="<?php echo esc_url($settings['twitter_url']); ?>" class="swrice-social-icon" target="_blank" rel="noopener" aria-label="Twitter">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (!empty($settings['linkedin_url'])): ?>
                                <a href="<?php echo esc_url($settings['linkedin_url']); ?>" class="swrice-social-icon" target="_blank" rel="noopener" aria-label="LinkedIn">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (!empty($settings['youtube_url'])): ?>
                                <a href="<?php echo esc_url($settings['youtube_url']); ?>" class="swrice-social-icon" target="_blank" rel="noopener" aria-label="YouTube">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Column 1 -->
                    <?php if (!empty($settings['col1_heading']) || !empty($col1_pages)): ?>
                    <div class="swrice-footer-column">
                        <h3><?php echo esc_html($settings['col1_heading']); ?></h3>
                        <?php if (!empty($col1_pages)): ?>
                        <ul>
                            <?php foreach ($col1_pages as $page): ?>
                                <li><a href="<?php echo esc_url(get_permalink($page->ID)); ?>"><?php echo esc_html($page->post_title); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Column 2 -->
                    <?php if (!empty($settings['col2_heading']) || !empty($col2_pages)): ?>
                    <div class="swrice-footer-column">
                        <h3><?php echo esc_html($settings['col2_heading']); ?></h3>
                        <?php if (!empty($col2_pages)): ?>
                        <ul>
                            <?php foreach ($col2_pages as $page): ?>
                                <li><a href="<?php echo esc_url(get_permalink($page->ID)); ?>"><?php echo esc_html($page->post_title); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Column 3 -->
                    <?php if (!empty($settings['col3_heading']) || !empty($col3_pages)): ?>
                    <div class="swrice-footer-column">
                        <h3><?php echo esc_html($settings['col3_heading']); ?></h3>
                        <?php if (!empty($col3_pages)): ?>
                        <ul>
                            <?php foreach ($col3_pages as $page): ?>
                                <li><a href="<?php echo esc_url(get_permalink($page->ID)); ?>"><?php echo esc_html($page->post_title); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Newsletter -->
                    <?php if (!empty($settings['newsletter_heading'])): ?>
                    <div class="swrice-footer-column">
                        <h3><?php echo esc_html($settings['newsletter_heading']); ?></h3>
                        <?php if (!empty($settings['newsletter_text'])): ?>
                        <p style="color: rgba(255,255,255,0.7); font-size: 14px; margin-bottom: 15px;">
                            <?php echo esc_html($settings['newsletter_text']); ?>
                        </p>
                        <?php endif; ?>
                        <form class="swrice-newsletter-form" onsubmit="return false;">
                            <input type="email" class="swrice-newsletter-input" placeholder="<?php echo esc_attr($settings['newsletter_placeholder']); ?>" required>
                            <button type="submit" class="swrice-newsletter-btn">Subscribe</button>
                        </form>
                    </div>
                    <?php endif; ?>
                    
                </div>
                
                <!-- Bottom Bar -->
                <div class="swrice-footer-bottom">
                    <div class="swrice-footer-copyright">
                        <?php echo esc_html($settings['copyright_text']); ?>
                    </div>
                    
                    <div class="swrice-footer-legal">
                        <?php if (!empty($settings['privacy_url'])): ?>
                            <a href="<?php echo esc_url($settings['privacy_url']); ?>">Privacy Policy</a>
                        <?php endif; ?>
                        
                        <?php if (!empty($settings['terms_url'])): ?>
                            <a href="<?php echo esc_url($settings['terms_url']); ?>">Terms of Service</a>
                        <?php endif; ?>
                    </div>
                </div>
                
            </div>
        </footer>
        <?php
    }
}

// Initialize the footer manager
new Swrice_Footer_Manager();