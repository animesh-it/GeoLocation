<?php
$this->load->view('header');
$this->load->view('sidebar');
$this->load->view($page);
$this->load->view('footer');
(isset($script) && $script != '')?$this->load->view($script):'';
?>