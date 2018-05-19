<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 19/05/18
 * Time: 17:07
 */

    class Fases {
        static function incluir() {
            $_SESSION['fases'][] = $_POST;

        }

        static function getAll() {
            return $_SESSION['fases'];
        }
    }