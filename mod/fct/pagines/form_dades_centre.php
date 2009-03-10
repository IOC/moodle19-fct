<?php
/* Quadern virtual d'FCT

   Copyright © 2008,2009  Institut Obert de Catalunya

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

fct_require('pagines/form_base.php');

class fct_form_dades_centre extends fct_form_base {

    function configurar() {
        $this->afegir_header( 'dades_centre', fct_string('dades_centre'));

        $this->afegir_text('nom', fct_string('nom'), 32);
        $this->afegir_text('adreca', fct_string('adreca'), 32);
        $this->afegir_text('codi_postal', fct_string('codi_postal'), 8);
        $this->afegir_text('poblacio', fct_string('poblacio'), 32);
        $this->afegir_text('telefon', fct_string('telefon'), 32);
        $this->afegir_text('fax', fct_string('fax'), 32);
        $this->afegir_text('email', fct_string('email'), 32);

        if (!$this->pagina->accio) {
            $this->congelar();
        } else if ($this->pagina->accio == 'veure') {
            $this->afegir_boto_enllac('editar', fct_string('edita'));
            $this->congelar();
        } else {
            $this->afegir_boto('desar', fct_string('desa'));
            $this->afegir_boto_cancellar();
        }
    }


}
