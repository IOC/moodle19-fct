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
 * Usuari FCT class
 *
 * @package    mod
 * @subpackage fct
 * @copyright  2014 Institut Obert de Catalunya
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class fct_usuari {
    public $id;
    public $fctid;
    public $nom;
    public $cognoms;
    public $email;
    public $es_administrador;
    public $es_alumne;
    public $es_tutor_centre;
    public $es_tutor_empresa;

    public function __construct($fctid, $userid) {

        global $DB;

        $record = $DB->get_record('user', array('id' => $userid));
        $this->id = $record->id;
        $this->fct = $fctid;
        $this->nom = $record->firstname;
        $this->cognoms = $record->lastname;
        $this->email = $record->email;

        if ($cm = get_coursemodule_from_instance('fct', $fctid)) {
            $context = get_context_instance(CONTEXT_MODULE, $cm->id);

            $this->es_administrador = (has_capability("mod/fct:admin", $context, $userid, false)
                or has_capability("moodle/site:config", $context, $userid));
            $this->es_alumne = has_capability(
                "mod/fct:alumne", $context, $userid, false);
            $this->es_tutor_centre = has_capability(
                "mod/fct:tutor_centre", $context, $userid, false);
            $this->es_tutor_empresa = has_capability(
                "mod/fct:tutor_empresa", $context, $userid, false);
        }
    }

}