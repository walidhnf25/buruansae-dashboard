<?php 
    $data = [
    'name'      => 'dukungan_program_lain',
    'id'        => $id_sayur,
    'value'     => $this->request->getVar('dukungan_program_lain'),
];

// echo form_input($data);
    echo form_textarea($data);
?>