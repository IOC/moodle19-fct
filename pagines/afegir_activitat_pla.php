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

fct_require('pagines/base_pla_activitats.php',
            'pagines/form_activitat.php');

class fct_pagina_afegir_activitat_pla extends fct_pagina_base_pla_activitats {

    function comprovar_descripcio($valors) {
       if (fct_db::activitat_pla_duplicada($this->quadern->id,
                                           addslashes($valors->descripcio))) {
            return array('descripcio' => fct_string('activitat_duplicada'));
        }
        return true;
    }

    function configurar() {
        parent::configurar(required_param('quadern', PARAM_INT));
        $this->comprovar_permis($this->permis_editar);
        $this->configurar_accio(array('afegir', 'cancellar'), 'afegir');
        $this->url = fct_url::afegir_activitat_pla($this->quadern->id);
        $this->subpestanya = 'afegir_activitat_pla';
    }

    function processar_afegir() {
        $form = new fct_form_activitat($this);
        if ($form->validar()) {
            $id = fct_db::afegir_activitat_pla($this->quadern->id,
                                               $form->valor('descripcio'));
            if ($id) {
                $this->registrar('add activitat_pla',
                                 fct_url::pla_activitats($this->quadern->id),
                                 $form->valor('descripcio'));
            } else {
                $this->error('afegir_activitat_pla');
            }
            redirect(fct_url::pla_activitats($this->quadern->id));
        }
        $this->mostrar_capcalera();
        $form->mostrar();
        $this->mostrar_peu();
    }

    function processar_cancellar() {
        redirect(fct_url::pla_activitats($this->quadern->id));
    }

}
