<?php

require_once 'form_base.php';

class fct_form_plantilla extends fct_form_base {

    function configurar() {
        $this->afegir_header('plantilla_activitats',
            $this->pagina->accio == 'afegir' ?
            fct_string('nova_plantilla') : fct_string('canvia_nom'));

        $this->afegir_text('nom', fct_string('nom'), 48, true);
        if ($this->pagina->accio == 'afegir') {
            $this->afegir_textarea('activitats', fct_string('activitats'), 20, 50);
        }

        $this->afegir_comprovacio('comprovar_nom');

        if ($this->pagina->accio == 'afegir'){
            $this->afegir_boto('afegir', fct_string('afegeix'));
        } else if ($this->pagina->accio == 'editar'){
            $this->afegir_boto('desar', fct_string('desa'));
        }

        $this->afegir_boto_cancellar();
    }

}

