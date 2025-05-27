<?php

if (!function_exists('clinica_actual')) {
    /**
     * Devuelve la clínica actual del usuario autenticado.
     *
     * @return int|null
     */
    function clinica_actual()
    {
        return auth()->check() ? auth()->user()->clinica_id : null;
    }
}
