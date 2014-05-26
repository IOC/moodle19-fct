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
 * Renderers for outputting fct convenis.
 *
 * @package    mod
 * @subpackage fct
 * @copyright  2014 Institut Obert de Catalunya
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class mod_fct_quadern_convenis_renderer extends plugin_renderer_base {

    public function view($quadern) {

        $output = '';

        $output .= $this->convenis_table($quadern);

        $cm = get_coursemodule_from_instance('fct', $quadern->fct);
        $link = new moodle_url('./edit.php', array('cmid' => $cm->id, 'quadern' => $quadern->id, 'page' => 'quadern_dades', 'subpage' => 'quadern_conveni'));

        $output .= html_writer::start_div('datagroup');
        $output .= html_writer::tag('span', get_string('prorrogues', 'fct').':', array('class' => 'datatitle'));
        $output .= html_writer::tag('span', $quadern->prorrogues, array('class' => 'datacontent'));
        $output .= html_writer::end_div();

        $output .= html_writer::start_div('datagroup');
        $output .= html_writer::tag('span', get_string('hores_practiques', 'fct').':', array('class' => 'datatitle'));
        $output .= html_writer::tag('span', $quadern->hores_practiques, array('class' => 'datacontent'));
        $output .= html_writer::end_div();

        $horesrealitzades = $quadern->hores_realitzades_quadern($quadern->id);

        $output .= html_writer::start_div('datagroup');
        $output .= html_writer::tag('span', get_string('hores_realitzades', 'fct').':', array('class' => 'datatitle'));
        $output .= html_writer::tag('span', $horesrealitzades, array('class' => 'datacontent'));
        $output .= html_writer::end_div();

        $horespendents = $horesrealitzades - $quadern->hores_practiques;

        $output .= html_writer::start_div('datagroup');
        $output .= html_writer::tag('span', get_string('hores_pendents', 'fct').':', array('class' => 'datatitle'));
        $output .= html_writer::tag('span', $horespendents, array('class' => 'datacontent'));
        $output .= html_writer::end_div();

        $output .= html_writer::link($link, get_string('edit'));

        echo $output;

    }

    public function convenis_table($quadern) {

        $output = '';

        $data = array();

        if ($convenis = $quadern->get_convenis()) {
            foreach ($convenis as $conveni) {
                $data[] = $this->make_table_line($conveni);
            }
        }

        $table = new html_table();
        $table->head = array(get_string('conveni', 'mod_fct'), get_string('data_inici', 'mod_fct'), get_string('data_final', 'mod_fct'));
        $table->data = $data;
        $table->id = 'cicles';
        $table->attributes['class'] = 'admintable generaltable';

        $output .= html_writer::table($table);

        return $output;

    }

    public function make_table_line($conveni) {
        $line = array();

        $line[] = $conveni->codi;
        $line[] = userdate($conveni->data_inici, get_string('strftimedate'));
        $line[] = userdate($conveni->data_final, get_string('strftimedate'));

        return $line;

    }

}
