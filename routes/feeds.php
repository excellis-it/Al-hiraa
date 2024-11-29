<?php

// routes/feeds.php

use App\Http\Controllers\Api\FeedController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/{encryptedId}', [FeedController::class, 'singleFeed']); // Single feed details
});
