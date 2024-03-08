<?php

//testar o envio de email pelo controller EmailController
it('send welcome email', function () {
    $this->get('/send-welcome-email')
        ->assertStatus(200);
})->group('email');
