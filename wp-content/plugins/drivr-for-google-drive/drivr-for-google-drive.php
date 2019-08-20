<?php
/*
Plugin Name: Drivr - Google Drive Picker Plugin
Plugin URI: http://awsm.in/drivr-documentation/
Description: Drivr helps you to access files from your Google Drive Account quickly and seamlessly.
Version: 1.1.1
Author: Awsm Innovations
Author URI: http://awsm.in
License: GPL V3
Text Domain: drivr-for-google-drive
Domain Path: /language
*/

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

/**
 * Drivr Picker Main Class.
 *
 * @link
 * @since      1.0.0
 *
 * @package    drivr_main
 */
class Awsm_drivr
{
    private static $instance = null;
    private $plugin_path;
    private $plugin_url;
    private $base_file;
    private $plugin_file;
    private $plugin_version;
    private $settings_slug;
    private $api_url;
    private $settings;
    private $text_domain = 'drivr-for-google-drive';

    /**
     * Creates or returns an instance of this class.
     * @since    1.0.0
     */
    public static function get_instance()
    {
        // If an instance hasn't been created and set to $instance create an instance and set it to $instance.
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    /**
     * Initializes the plugin by setting localization, hooks, filters, and administrative functions.
     * @since    1.0.0
     */
    private function __construct()
    {
        $this->plugin_path    = plugin_dir_path(__FILE__);
        $this->plugin_url     = plugin_dir_url(__FILE__);
        $this->base_file      = plugin_basename(__FILE__);
        $this->plugin_base    = dirname($this->base_file);
        $this->plugin_file    = __FILE__;
        $this->settings_slug  = 'drivr-settings';
        $this->plugin_version = '1.1.1';

        $this->settings = array(
            'drivr_service_order' => 'drive,upload,recent,video,spreadsheets,pdfs,presentations,docs,photos,youtube',
            'drivr_service_list'  => array('drive'=>1,'upload'=>1,'recent'=>1,'video'=>0,'spreadsheets'=>0,'pdfs'=>0,'presentations'=>0,'docs'=>0,'photos'=>0,'youtube'=>0),
            'drivr_apikey'        => '',
            'drivr_clientid'      => '',
        );

        $this->options = array('drivr_service_list' => array(
            'drive'         => __('Google Drive', $this->text_domain),
            'upload'        => __('Upload to Google Drive', $this->text_domain),
            'recent'        => __('Recent Files', $this->text_domain),
            'video'         => __('Videos', $this->text_domain),
            'spreadsheets'  => __('Spreadsheets', $this->text_domain),
            'pdfs'          => __('PDFs', $this->text_domain),
            'presentations' => __('Presentations', $this->text_domain),
            'docs'          => __('Docs', $this->text_domain),
            'photos'        => __('Photos', $this->text_domain),
            'youtube'       => __('YouTube Search', $this->text_domain),
        ),
        );
        $this->run_plugin();
        $this->adminfunctions();
    }

    /**
     * Initiate admin functions.
     * @since 1.0
     */
    public function adminfunctions()
    {
        if (is_admin()) {
            add_action('admin_footer', array($this, 'drivr_popup'));
            add_filter('plugin_action_links_' . $this->base_file, array($this, 'settingslink'), 10, 2);
            add_action('media_buttons', array($this, 'drivrbutton'), 15);
            add_action('wp_enqueue_media', array($this, 'drivr_media'));
            add_action('admin_menu', array($this, 'admin_menu'));
            add_action('admin_init', array($this, 'register_settings'));
            add_filter('admin_post_thumbnail_html', array($this, 'featured_link'));
            add_action('wp_ajax_drivr_featured_image', array($this, 'featured_image'));
            add_action('wp_ajax_drivr_file_upload', array($this, 'file_upload'));
        }
    }
    /**
     * Plugin function
     */
    public function run_plugin()
    {
        //default options
        register_activation_hook($this->plugin_file, array($this, 'reset_default'));
        add_shortcode('drivr', array($this, 'drivr_shortcode'));
    }
    /**
     * Drivr Shortcode handling function
     * @since  1.0
     */
    public function drivr_shortcode($atts)
    {
        $embed      =   '';
        $durl       =   '';

        $drivr      =   shortcode_atts(array('id' => '','type'=> 'document'), $atts);
        $type       =   $drivr['type'];
        $file_id    =   $drivr['id'];
        $link       =   $type;
        if( !in_array($atts['type'], array('form','presentation')) ){
           $link   =   'document';
        } 

        $embedlink['document']      =   'https://docs.google.com/file/d/%s/preview';
        $embedlink['presentation']  =   'https://docs.google.com/a/cgwerks.net/presentation/d/%s/preview';
        $embedlink['form']          =   'https://docs.google.com/forms/d/%s/viewform?embedded=true&usp=drive_web';
        $embedlink['download']      =   sprintf('https://drive.google.com/uc?export=download&id=%s', $file_id);

        $durl = "<a href=\"". $embedlink['download'] ."\">". __("Download", "dsr") ."</a>";

        $embedsrc = $embedlink[$link];

        if (!$file_id) {
            $embed = sprintf('<div class="ead-preview"><p>%s</p></div>', __('No Url Found', $this->text_domain));
            return $embed;
        }
        $iframesrc    = sprintf($embedsrc, $file_id);
        $iframe_style = 'style="width:100%; height:100%; border: none; position: absolute;left:0;top:0;"';
        $doc_style    = sprintf('style="position:relative;padding-top:%1$s%%;"', $this->get_embed_size($type));
        $iframe       = '<iframe src="' . $iframesrc . '" ' . $iframe_style . '></iframe>';
        $embed        = '<div class="ead-preview"><div class="ead-document" ' . $doc_style . '>' . $iframe . '</div>' . $durl . '</div>';

        return $embed;

    }
    /**
     * Get embed padding value for document type
     * @param  String Document type
     * @return Int paddding value
     */
    public function get_embed_size($filetype)
    {
        $size = 90;
        switch ($filetype) {
            case 'audio':
                $size = 20;
                break;
            case 'video':
                $size = 56.25;
                break;
            case 'presentation':
                $size = 80;
                break;
            default:
                $size = 90;
                break;
        }
        return $size;
    }
    /**
     * Enquees media button style and script
     */
    public function drivr_media()
    {
        wp_enqueue_script('media_button', plugins_url('js/drivr.js', $this->plugin_file), array('jquery'), $this->plugin_version, true);
        wp_enqueue_style('media_button', plugins_url('css/drivr.css', $this->plugin_file), false, $this->plugin_version, 'all');
        wp_localize_script('media_button', 'drivrjs', $this->getoptions());
    }
    /**
     * Drivr media button
     */
    public function drivrbutton($args = array())
    {
        if (!current_user_can('edit_posts')) {
            return;
        }
        if(!get_option( 'drivr_apikey' ) && !get_option( 'drivr_clientid' )){
            $buttonid  = 'add-drivr-no-api';
        }else{
            $buttonid  = 'add-drivr';
        }
        $target = is_string($args) ? $args : 'content';
        $args = wp_parse_args($args, array(
            'target'    => $target,
            'text'      => __('Add From Drive', $this->text_domain),
            'class'     => 'awsm-drivr button',
            'icon'      => plugins_url('images/drivr-icon.png', __FILE__),
            'echo'      => true,
            'id'        => $buttonid,
            'shortcode' => false,
        ));
        if ($args['icon']) {
            $args['icon'] = '<img src="' . $args['icon'] . '" /> ';
        }
        $button = '<a href="javascript:void(0);" id="' . $args['id'] . '" class="' . $args['class'] . '" title="' . $args['text'] . '" data-target="' . $args['target'] . '" >' . $args['icon'] . $args['text'] . '</a>';
        if ($args['echo']) {
            echo $button;
        }
        return $button;
    }
    /**
     * Drivr files embed setting popup
     * @since 1.0
     */
    public function drivr_popup()
    {
        if (wp_script_is('media_button')) {
            include $this->plugin_path . 'inc/popup.php';
        }
    }
    /**
     * Admin Easy access settings link
     * @since 1.0
     */
    public function settingslink($links)
    {
        $settings_link = '<a href="options-general.php?page=' . $this->settings_slug . '">' . __('Settings', $this->text_domain) . '</a>';
        array_unshift($links, $settings_link);
        return $links;
    }
    /**
     * Admin menu setup
     * @since 1.0
     */
    public function admin_menu()
    {
        $drivrsetting = add_options_page('Drivr', 'Drivr', 'manage_options', $this->settings_slug, array($this, 'settings_page'));
        add_action('admin_print_styles-' . $drivrsetting, array($this, 'setting_styles'));
        add_action('admin_print_scripts-' . $drivrsetting, array($this, 'setting_scripts'));
    }

    /**
     * Drivr settings enqueue style
     * @since 1.0
     */
    public function setting_styles()
    {
        wp_enqueue_style('drivr-setting', plugins_url('css/settings.css', $this->plugin_file), false, $this->plugin_version, 'all');
    }
    /**
     * Drivr settings enqueue scripts
     * @since 1.0
     */
    public function setting_scripts()
    {
        wp_enqueue_script('drivr-settings', plugins_url('js/settings.js', $this->plugin_file), array('jquery', 'jquery-ui-sortable'), $this->plugin_version);
    }
    /**
     * Drivr settings page
     * @since  1.0
     */
    public function settings_page()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        include $this->plugin_path . 'inc/settings.php';
    }
    /**
     * Drivr settings api register
     * @since  1.0
     */
    public function register_settings()
    {
        register_setting('drivr-settings-group', 'drivr_service_order');
        register_setting('drivr-settings-group', 'drivr_service_list', array($this, 'sanitize_checklist'));
        register_setting('drivr-cloud-group', 'drivr_clientid');
        register_setting('drivr-cloud-group', 'drivr_apikey');
    }
    /**
     * sanitize checklist for service list
     */
    public function sanitize_checklist($options)
    {

        if (!is_array($options) || empty($options) || (false === $options)) {
            return array();
        }

        $service_order = $this->options['drivr_service_list'];
        $valid_names   = array_keys($service_order);
        $clean_options = array();

        foreach ($valid_names as $option_name) {
            if (isset($options[$option_name]) && (1 == $options[$option_name])) {
                $clean_options[$option_name] = 1;
            } else {
                $clean_options[$option_name] = 0;
            }

            continue;
        }
        unset($options);
        return $clean_options;
    }
    /**
     * Get Active Menu Class
     *
     * @since   1.0
     * @return  string Class name
     */
    public function getactive_menu($tab, $needle)
    {
        if ($tab == $needle) {
            echo 'active';
        }
    }
    /**
     * To initialize with default options
     * @since  1.0
     */
    public function reset_default()
    {
        $defaults = $this->settings;
        if (!get_option('drivr-settings')) {
            update_option('drivr-settings', $defaults);
        }
        return;
    }
    /**
     * Dropdown Builder
     *
     * @since   1.0
     * @return  String select html
     */
    public function selectbuilder($name, $options, $selected = "", $class = "")
    {
        if (is_array($options)):
            $select_html = "<select name=\"$name\" id=\"$name\" class=\"$class\">";
            foreach ($options as $key => $option) {
                $select_html .= "<option value=\"$key\"";
                if (!empty($helptext)) {
                    $select_html .= " title=\"$helptext\"";
                }
                if ($key == $selected) {
                    $select_html .= ' selected="selected"';
                }
                $select_html .= ">$option</option>\n";
            }
            $select_html .= '</select>';
            echo $select_html;
        else:
        endif;
    }
    /**
     * Radio Builder
     * @param  String Dropdown name
     * @param  Array  Dropdown options array
     * @param  String Default selected value
     * @param  String Dropdown class name
     * @return String Dropdown html
     * @since   1.0
     */
    public function radiobuilder($name, $options, $selected = "")
    {
        if (is_array($options)):
            foreach ($options as $key => $option) {
                $checked = "";
                if ($key == $selected) {
                    $checked = ' checked';
                }
                echo '<li><label for="drivr-file-' . $key . '"><input type="radio" name="' . $name . '" id="drivr-file-' . $key . '" value="' . $key . '" ' . $checked . '>' . $option . '</label></li>';
            } else :
        endif;
    }
    /**
     * Get option values
     *
     * @since   1.0
     * @return  Array Default Options
     */
    public function getoptions()
    {
        $defaults = $this->settings;
        foreach ($defaults as $key => $option) {
            $options[$key] = get_option($key, $option);
        }
        $options['ajaxurl']     = admin_url('admin-ajax.php');
        $options['multiplefile']= __("Multiple files",$this->text_domain);
        $options['drivr_nonce'] = wp_create_nonce("drivr-nonce");
        return $options;
    }
    /**
     * Add featured image from  google driv link
     */
    public function featured_link($content)
    {
        if(!get_option( 'drivr_apikey' ) && !get_option( 'drivr_clientid' )){
            return $content;
        } 
        $content .= '<p><a href="#" id="drivr-featured">' . __('Add From Google Drive', $this->text_domain) . '</a>';
        $content .= '<img src="' . plugins_url('drivr-for-google-drive/images/loading-bubbles.svg') . '" style="display:none;" class="drivr-loader" alt="Loading icon"/></p><p id="drivr-holder"></p>';
        $content .= '<script>
			setInterval(function() {
				if (jQuery(\'#remove-post-thumbnail\').is(\':visible\') || jQuery(\'#drivr-featured\').hasClass(\'drivr-loading\')) {
					jQuery(\'#drivr-featured\').hide();
				}else {
					jQuery(\'#drivr-featured\').show();
				}
			}, 200);
			</script>';
        return $content;
    }
    /**
     * Ajax handle for featured image.
     */
    public function featured_image()
    {
        $json['status'] = false;
        if(!current_user_can('upload_files')){
            $json['message'] = __("You do not have sufficient permissions to upload files");
            die(json_encode($json));
        }
        if (!check_ajax_referer('drivr-nonce', 'drivr_nonce', false)) {
            $json['message'] = __("Verification failed");
            die(json_encode($json));
        }
        $json        = array();
        $drivrdoc    = $_REQUEST['drivrdoc'];
        $oauthToken  = $_REQUEST['oauthToken'];
        $post_id     = intval($_REQUEST['postid']);
        $fileurl     = sprintf('https://www.googleapis.com/drive/v2/files/%s?alt=media', $drivrdoc['id']);
        $filename    = $drivrdoc['name'];
        $attachement = $this->uploadremotefile($fileurl, $filename, $post_id, $oauthToken);
        if ($attachement['status']) {
            $json['status'] = true;
            set_post_thumbnail($post_id, $attachement['file']);
            $json['html'] = $this->wp_post_thumbnail_html($attachement['file'], $post_id);
        } else {
            $json['status']  = false;
            $json['message'] = $attachement['message'];
        }
        die(json_encode($json));
    }
    /**
     * Downloads remote files to local.
     */
    public function download_url($url, $token = false, $timeout = 300)
    {
        if (!$url) {
            return new WP_Error('http_no_url', __('Invalid URL Provided.'));
        }
        $tmpfname = wp_tempnam($url);
        if (!$tmpfname) {
            return new WP_Error('http_no_file', __('Could not create Temporary file.'));
        }
        $options = array('timeout' => $timeout, 'stream' => true, 'filename' => $tmpfname);
        if ($token) {
            $options['headers'] = array("Authorization" => "Bearer " . $token);
        }
        $response = wp_safe_remote_get($url, $options);
        if (is_wp_error($response)) {
            unlink($tmpfname);
            return $response;
        }
        if (200 != wp_remote_retrieve_response_code($response)) {
            unlink($tmpfname);
            return new WP_Error('http_404', trim(wp_remote_retrieve_response_message($response)));
        }
        $content_md5 = wp_remote_retrieve_header($response, 'content-md5');
        if ($content_md5) {
            $md5_check = verify_file_md5($tmpfname, $content_md5);
            if (is_wp_error($md5_check)) {
                unlink($tmpfname);
                return $md5_check;
            }
        }
        return $tmpfname;
    }
    /**
     * Featured image return html
     * @param  String $thumbnail_id attachement id
     * @param  [type] $post Post id
     * @return Sting featured image section html
     */
    public function wp_post_thumbnail_html($thumbnail_id = null, $post = null)
    {
        global $content_width, $_wp_additional_image_sizes;

        $post = get_post($post);

        $upload_iframe_src  = esc_url(get_upload_iframe_src('image', $post->ID));
        $set_thumbnail_link = '<p class="hide-if-no-js"><a title="' . esc_attr__('Set featured image') . '" href="%s" id="set-post-thumbnail" class="thickbox">%s</a></p>';
        $content            = sprintf($set_thumbnail_link, $upload_iframe_src, esc_html__('Set featured image'));

        if ($thumbnail_id && get_post($thumbnail_id)) {
            $old_content_width = $content_width;
            $content_width     = 266;
            if (!isset($_wp_additional_image_sizes['post-thumbnail'])) {
                $thumbnail_html = wp_get_attachment_image($thumbnail_id, array($content_width, $content_width));
            } else {
                $thumbnail_html = wp_get_attachment_image($thumbnail_id, 'post-thumbnail');
            }

            if (!empty($thumbnail_html)) {
                $ajax_nonce = wp_create_nonce('set_post_thumbnail-' . $post->ID);
                $content    = sprintf($set_thumbnail_link, $upload_iframe_src, $thumbnail_html);
                $content .= '<p class="hide-if-no-js"><a href="#" id="remove-post-thumbnail" onclick="WPRemoveThumbnail(\'' . $ajax_nonce . '\');return false;">' . esc_html__('Remove featured image') . '</a></p>';
            }
            $content_width = $old_content_width;
        }
        return apply_filters('admin_post_thumbnail_html', $content, $post->ID);
    }
    /**
     * Upload file to media library
     * @param  String  $url    remote url
     * @param  String  $name    Filename
     * @param  Int  $post_id post id
     * @param  boolean $token   oAuthtoken
     * @return array attachment
     */
    public function uploadremotefile($url, $name, $post_id, $token = false)
    {
        $ret           = array();
        $ret['status'] = false;
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        if (!empty($url)) {
            $file_array         = array();
            $file_array['name'] = $name;
            if ($token) {
                $temp = $this->download_url($url, $token);
            } else {
                $temp = download_url($url);
            }

            if (is_wp_error($temp)) {
                $ret['message'] = $temp->get_error_message();
                return $ret;
            }
            $file_array['tmp_name'] = $temp;
            $file                   = media_handle_sideload($file_array, $post_id, $name);
            if (is_wp_error($file)) {
                @unlink($file_array['tmp_name']);
                $ret['message'] = $file->get_error_message();
                return $ret;
            }
            $ret['status'] = true;
            $ret['file']   = $file;
        } else {
            $ret['message'] = __("Invalid URL", 'drivr');
        }
        return $ret;
    }
}
Awsm_drivr::get_instance();