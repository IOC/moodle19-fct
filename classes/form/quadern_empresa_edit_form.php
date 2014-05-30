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
 * FCT quadern empresa related management form.
 *
 * @package    mod
 * @subpackage fct
 * @copyright  2013 IOC
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/lib/formslib.php');

class fct_quadern_empresa_edit_form extends moodleform {

    public $class = 'fct_quadern_empresa';

    public function definition() {

        global $DB;

        $mform = $this->_form;
        $data = $this->_customdata['data'];

        $mform->addElement('header', 'headerempresa', get_string('empresa', 'mod_fct'));

        $mform->addElement('text', 'nom', get_string('nom', 'mod_fct'));
        $mform->setType('nom', PARAM_TEXT);
        $mform->addElement('text', 'adreca', get_string('adreca', 'mod_fct'));
        $mform->setType('adreca', PARAM_TEXT);
        $mform->addElement('text', 'poblacio', get_string('poblacio', 'mod_fct'));
        $mform->setType('poblacio', PARAM_TEXT);
        $mform->addElement('text', 'codi_postal', get_string('codi_postal', 'mod_fct'));
        $mform->setType('codi_postal', PARAM_TEXT);
        $mform->addElement('text', 'telefon', get_string('telefon', 'mod_fct'));
        $mform->setType('telefon',  PARAM_TEXT);
        $mform->addElement('text', 'fax', get_string('fax', 'mod_fct'));
        $mform->setType('fax',  PARAM_TEXT);
        $mform->addElement('text', 'email', get_string('email', 'mod_fct'));
        $mform->setType('email', PARAM_TEXT);
        $mform->addElement('text', 'nif', get_string('nif', 'mod_fct'));
        $mform->setType('nif', PARAM_TEXT);
        $mform->addElement('text', 'codi_agrupacio', get_string('codi_agrupacio', 'mod_fct'));
        $mform->setType('codi_agrupacio', PARAM_TEXT);
        $mform->addElement('text', 'sic', get_string('sic', 'mod_fct'));
        $mform->setType('sic', PARAM_TEXT);

        $mform->addElement('header', 'headerresponsableconveni', get_string('responsable_conveni', 'mod_fct'));

        $mform->addElement('text', 'nom_responsable', get_string('nom', 'mod_fct'));
        $mform->setType('nom_responsable', PARAM_TEXT);
        $mform->addElement('text', 'cognoms_responsable', get_string('cognoms', 'mod_fct'));
        $mform->setType('cognoms_responsable', PARAM_TEXT);
        $mform->addElement('text', 'dni_responsable', get_string('dni', 'mod_fct'));
        $mform->setType('dni_responsable', PARAM_TEXT);
        $mform->addElement('text', 'carrec_responsable', get_string('carrec', 'mod_fct'));
        $mform->setType('carrec_responsable', PARAM_TEXT);

        $mform->addElement('header', 'headertutorempresa', get_string('tutor_empresa', 'mod_fct'));

        $mform->addElement('text', 'nom_tutor', get_string('nom', 'mod_fct'));
        $mform->setType('nom_tutor', PARAM_TEXT);
        $mform->addElement('text', 'cognoms_tutor', get_string('cognoms', 'mod_fct'));
        $mform->setType('cognoms_tutor', PARAM_TEXT);
        $mform->addElement('text', 'dni_tutor', get_string('dni', 'mod_fct'));
        $mform->setType('dni_tutor', PARAM_TEXT);
        $mform->addElement('text', 'email_tutor', get_string('email', 'mod_fct'));
        $mform->setType('email_tutor', PARAM_TEXT);

        $mform->addElement('header', 'headerllocpractiques', get_string('lloc_practiques', 'mod_fct'));

        $mform->addElement('text', 'nom_lloc_practiques', get_string('nom', 'mod_fct'));
        $mform->setType('nom_lloc_practiques', PARAM_TEXT);
        $mform->addElement('text', 'adreca_lloc_practiques', get_string('adreca', 'mod_fct'));
        $mform->setType('adreca_lloc_practiques', PARAM_TEXT);
        $mform->addElement('text', 'poblacio_lloc_practiques', get_string('poblacio', 'mod_fct'));
        $mform->setType('poblacio_lloc_practiques', PARAM_TEXT);
        $mform->addElement('text', 'codi_postal_lloc_practiques', get_string('codi_postal', 'mod_fct'));
        $mform->setType('codi_postal_lloc_practiques', PARAM_TEXT);
        $mform->addElement('text', 'telefon_lloc_practiques', get_string('telefon', 'mod_fct'));
        $mform->setType('telefon_lloc_practiques', PARAM_TEXT);


        $mform->addElement('hidden', 'cmid');
        $mform->setType('cmid', PARAM_INT);
        $mform->addElement('hidden', 'page');
        $mform->setType('page', PARAM_TEXT);
        $mform->addElement('hidden', 'subpage');
        $mform->setType('subpage', PARAM_TEXT);
        $mform->addElement('hidden', 'quadern');
        $mform->setType('quadern', PARAM_TEXT);
        $mform->addElement('hidden', 'fct');
        $mform->setType('fct', PARAM_INT);
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'objecte');
        $mform->setType('objecte', PARAM_TEXT);
        $mform->setDefault('objecte', '');

        $this->add_action_buttons();
        $this->set_data($data);
    }

    public function validation($data, $files) {
        $errors = array();
        $class = $this->class;
        $errors = $class::validation($data);
        return $errors;
    }
}