<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Forms select fieldtype
 *
 * @package     Forms select fieldtype
 * @category    Fieldtypes
 * @author      Erwin Romkes
 * @link        https://www.stoneandstorm.com
 * @license     https://opensource.org/licenses/MIT
 */

include(PATH_THIRD.'/forms_select/config.php');

class Forms_select_ft extends EE_Fieldtype {

    var $info = array(
        'name'      => 'Forms select',
        'version'   => FORMS_SELECT_VERSION
    );

    /**
     * Enable Grid support
     *
     * @access  public
     * @param   string
     * @return  bool
     */
    public function accepts_content_type($name)
    {
        return ($name == 'channel' || $name == 'grid');
    }

    /**
     * Render the publish field.
     *
     * @access  public
     * @param   array
     * @return  string
     */
    public function display_field($data)
    {
        ee()->lang->loadfile('forms_select');

        $forms = $this->get_forms();

        if(empty($forms))
        {
            return '<div class="alert inline warn"><p>'.lang('fs_no_forms').'</p></div>';
        }
        else
        {
            return form_dropdown($this->field_name, $forms, $data);
        }
    }

    /**
     * Replace the field tag on the frontend.
     * Shameless copy/paste from the Forms linked EE2 fieldtype by DevDemon
     *
     * @access  public
     * @param   array
     * @param   array
     * @param   array
     * @return  string
     */
    public function replace_tag($data, $params = array(), $tagdata = array())
    {
        ee()->load->add_package_path(PATH_THIRD . 'forms/');
        if (class_exists('Forms') == FALSE) include PATH_THIRD.'forms/mod.forms.php';
        $F = new Forms();

        // Lets cache the entire entry row
        ee()->session->cache['forms']['ee_entry_row'] = $this->row;

        $params['form_id'] = $data;
        return $F->form($params, $tagdata);
    }

    /**
     * Update the fieldtype
     *
     * @param string $version The version being updated to
     * @return boolean TRUE if successful, FALSE otherwise
     */
    public function update($version)
    {
        return TRUE;
    }

    /**
     * Get all the Forms from database
     *
     * @access  private
     * @return  array
     */
    private function get_forms()
    {
        $forms_array = array();

        $forms_array[0] = lang('fs_select_form');

        ee()->db->select('form_title, form_id');
        ee()->db->where('site_id', ee()->config->item('site_id'));
        $query = ee()->db->get('forms');

        foreach ($query->result() as $row)
        {
            $forms_array[ $row->form_id ] = ee('Security/XSS')->clean($row->form_title);
        }

        return $forms_array;
    }

}

/* End of file ft.forms_select.php */
/* Location: ./system/user/addons/forms_select/ft.forms_select.php */