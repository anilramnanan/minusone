<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package   theme_minusone
 * @copyright 2019 Open Campus Team
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings = new theme_minusone_admin_settingspage_tabs('themesettingminusone', get_string('configtitle', 'theme_minusone'));
    $page = new admin_settingpage('theme_minusone_general', get_string('generalsettings', 'theme_minusone'));


    // UWI 
    $name = 'theme_minusone/uwicampus';
    $title = get_string('uwicampus', 'theme_minusone');
    $description = get_string('uwicampus_desc', 'theme_minusone');

    $defaultcampus = 'OC';
    $campuses['XCM'] = 'Cross Campus / Shared Moodle';
    $campuses['CAV'] = 'Cave Hill Campus';
    $campuses['FIC'] = 'Five Islands Campus';
    $campuses['MON'] = 'Mona Campus';
    $campuses['OC'] = 'Open Campus';
    $campuses['STA'] = 'St. Augustine Campus';

    $setting = new admin_setting_configselect($name, $title, $description, $defaultcampus, $campuses);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_minusone/uwimoodleinstancename';
    $title = get_string('uwimoodleinstancename', 'theme_minusone');
    $description = get_string('uwimoodleinstancename_desc', 'theme_minusone');
    
    $setting = new admin_setting_configtext($name, $title, $description,  '', PARAM_TEXT);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_minusone/uwicampusfooter';
    $title = get_string('uwicampusfooter', 'theme_minusone');
    $description = get_string('uwicampusfooter_desc', 'theme_minusone');
    
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset.
    $name = 'theme_minusone/preset';
    $title = get_string('preset', 'theme_minusone');
    $description = get_string('preset_desc', 'theme_minusone');
    $default = 'default.scss';

    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_minusone', 'preset', 0, 'itemid, filepath, filename', false);


    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';
    $choices['opencampus.scss'] = 'opencampus.scss';

    $setting = new admin_setting_configthemepreset($name, $title, $description, $default, $choices, 'minusone');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_minusone/presetfiles';
    $title = get_string('presetfiles','theme_minusone');
    $description = get_string('presetfiles_desc', 'theme_minusone');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);

    // Background image setting.
    // $name = 'theme_minusone/backgroundimage';
    // $title = get_string('backgroundimage', 'theme_minusone');
    // $description = get_string('backgroundimage_desc', 'theme_minusone');
    // $setting = new admin_setting_configstoredfile($name, $title, $description, 'backgroundimage');
    // $setting->set_updatedcallback('theme_reset_all_caches');
    // $page->add($setting);

    // Variable $body-color.
    // We use an empty default value because the default colour should come from the preset.
    // $name = 'theme_minusone/brandcolor';
    // $title = get_string('brandcolor', 'theme_minusone');
    // $description = get_string('brandcolor_desc', 'theme_minusone');
    // $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    // $setting->set_updatedcallback('theme_reset_all_caches');
    // $page->add($setting);

    // Must add the page after definiting all the settings!
    $settings->add($page);

    // Advanced settings.
    $page = new admin_settingpage('theme_minusone_advanced', get_string('advancedsettings', 'theme_minusone'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_scsscode('theme_minusone/scsspre',
        get_string('rawscsspre', 'theme_minusone'), get_string('rawscsspre_desc', 'theme_minusone'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_scsscode('theme_minusone/scss', get_string('rawscss', 'theme_minusone'),
        get_string('rawscss_desc', 'theme_minusone'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
}
