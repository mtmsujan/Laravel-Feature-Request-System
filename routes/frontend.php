<?php

use App\Http\Controllers\Frontend\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FeatureController;

Route::resource('feedback', FeatureController::class, ['prefix'=> 'feature']);
Route::post('feature-status/update/{feedback}', [FeatureController::class, 'updateStatus'])->name('feature.update.status');
Route::post('vote/{type}/feature/{feedback}', [FeatureController::class, 'vote'])->name('feature.vote');
Route::post('comment', [CommentController::class, 'store'])->name('comment.store');

Route::get('user-login', [FeatureController::class, 'userLogin'])->name('user.login');
Route::post('user-login', [FeatureController::class, 'userLoginStore'])->name('user.login.store');

Route::get('user-verify', [FeatureController::class, 'verify'])->name('user.verify');
Route::post('user-verify', [FeatureController::class, 'verifyStore'])->name('user.verify.store');

Route::post('user-logout', [FeatureController::class, 'logout'])->name('user.logout');


#---------Editor---------#
Route::post('upload-editor-images', function(Request $request){
    $path = saveFile($request->image, 'editor-images');
    return response()->json([
        'link'=> asset('storage/'. $path)
    ]);
});
