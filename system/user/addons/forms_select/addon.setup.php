<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Forms select fieldtype
 *
 * @package     Forms select fieldtype
 * @category    Fieldtypes
 * @author      Erwin Romkes
 * @link        https://www.stoneandstorm.com
 * @license     https://creativecommons.org/licenses/by-sa/4.0/
 */

include(PATH_THIRD.'/forms_select/config.php');

return array(
    'author'        => 'Erwin Romkes',
    'author_url'    => 'https://www.stoneandstorm.com',
    'name'          => 'Forms select',
    'description'   => 'Displays the available Forms as an dropdown.',
    'version'       => FORMS_SELECT_VERSION,
    'namespace'     => 'StoneAndStorm\FormsSelect',
    'fieldtypes'    => array(
        'forms_select' => array(
            'name' => 'Forms Select',
            'compatibility' => 'list'
        )
    )
);