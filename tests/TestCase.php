<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    // Verificar que la respuesta tiene un código 200
pm.test("Status code is 200", function () {
    pm.response.to.have.status(200);
});

// Verificar que la respuesta contiene un JSON
pm.test("Response has JSON body", function () {
    pm.response.to.have.jsonBody();
});

// Verificar que la respuesta contiene un campo específico
pm.test("Response includes alumno data", function () {
    const response = pm.response.json();
    pm.expect(response).to.have.property('nombre');
});//
}
