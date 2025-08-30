<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facets\Log;

Route::get('/test-upload', function() {
    return view('test-upload');
});

Route::post('/test-upload', function(\Illuminate\Http\Request $request) {
    $path = $request->file('file')->store('test-uploads', 'public');
    return ['path' => $path];
});
