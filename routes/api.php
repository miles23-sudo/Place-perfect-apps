<?php

use App\Http\Controllers\Api\PaymongoWebhookController;

// -------------------------------------------------------
// Paymongo Webhook and Order Success Routes
// -------------------------------------------------------

// [TESTING] : Implementation of webhook still in progress
Route::post('/webhook/paymongo', [PaymongoWebhookController::class, 'handle'])->name('paymongo.webhook');
Route::get('/webhook/paymongo/create', [PaymongoWebhookController::class, 'createWebhook'])->name('paymongo.webhook.create');
Route::get('/webhook/paymongo/enable/{id}', [PaymongoWebhookController::class, 'enableWebhook'])->name('paymongo.webhook.enable');
