<?php

it('returns a successful response', function () {
    $response = $this->get('/entrenadores');

    $response->assertStatus(200);
});
