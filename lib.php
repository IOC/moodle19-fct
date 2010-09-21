<?php
/* Quadern virtual d'FCT

   Copyright © 2008,2009,2010  Institut Obert de Catalunya

   This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

function fct_require() {
    global $CFG;
    foreach (func_get_args() as $fitxer) {
        require_once($CFG->dirroot . '/mod/fct/' . $fitxer);
    }
}

function fct_string($identifier, $a=null) {
    if (is_array($a)) {
        $a = (object) $a;
    }
    return get_string($identifier, 'fct', $a);
}

fct_require('db.php');

function fct_add_instance($fct) {
    return fct_db::afegir_fct($fct);
}

function fct_update_instance($fct) {
    return fct_db::actualitzar_fct($fct);
}

function fct_delete_instance($id) {
    return fct_db::suprimir_fct($id);
}
