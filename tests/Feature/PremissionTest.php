<?php

/**
 * index - displays all Permissions
 * 
 * store - stores a newly created Permission
 *         uses the StorePremissionRequest file
 * 
 * show - displays the selected Permission, via the ID
 * 
 * update - retrives the selected Permission, 
 *          receives the user input for the update to the Permission,
 *          saves/stores the update
 * 
 * destroy - removes the selected Permission, via the ID
 */


test('Displays all Permissions', function () {
    // Checks the API route
    $response = $this->getJson('/api/permissions');

    // Checks if the route has Auth or not


    // Checks the expected returned Json output
    $response->assertJsonStructure([
        
    ]);

    // Checks the expected status code
    $response->assertStatus(200);
});
