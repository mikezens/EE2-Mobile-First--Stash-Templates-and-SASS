<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Memberlist Class
 *
 * @package     ExpressionEngine
 * @category    Plugin
 * @author      Kenton Glass
 * @copyright   Copyright (c) 2013, Kenton Glass
 * @link        http://kenton.me
 */

$plugin_info = array(
    'pi_name' => 'SetVersion',
    'pi_version' => '1.0',
    'pi_author' => 'Kenton Glass',
    'pi_author_url' => 'http://kenton.me',
    'pi_description' => 'Appends modified timestamp to file name',
    'pi_usage' => SetVersion::usage()
);

class SetVersion {

    // --------------------------------------------------------------------

    /**
     * SetVersion
     *
     * This function returns a file name with an appended modified timestamp
     *
     * @access  public
     * @return  string
     */
    public $return_data = '';
    public function __construct(){
        $this->EE =& get_instance();
        $file       = $this->EE->TMPL->fetch_param('path');
        $path       = pathinfo($file);
        $version    = filemtime($_SERVER['DOCUMENT_ROOT'].$file);
        $cache_file = $path['filename'].'.'.$path['extension'].'?t='.$version;
        $this->return_data = $path['dirname'].'/'.$cache_file;
    }
    
    // --------------------------------------------------------------------

    /**
     * Usage
     *
     * This function describes how the plugin is used
     *
     * @access  public
     * @return  string
     */
    function usage(){
        ob_start(); 
?>
The SetVersion plugin takes a file and appends the last modified timestamp to it.

Example:

{exp:setversion path='/assets/css/style.css'} returns '/assets/css/style.1234567890.css'

<?php
        $buffer = ob_get_contents();
        ob_end_clean(); 
        return $buffer;
    }
}
/* End of file pi.setversion.php */
/* Location: ./system/expressionengine/third_party/setversion/pi.setversion.php */