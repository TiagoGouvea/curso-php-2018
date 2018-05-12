<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 12/05/18
 * Time: 15:47
 */

class fases
{
    private $title;
    private $description;
    private $order;
    private $status;
    private $id_trilha;

    public function __construct()
    {
        $this->status = true;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setOrder($order) {
        $this->order = $order;
    }

    public function getOrder() {
        return $this->order;
    }
}