<?php

use App\Http\Controllers\ActivityLevelController;
use App\Http\Controllers\AmrController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BloodPressureLogController;
use App\Http\Controllers\BmiLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DialingCodeController;
use App\Http\Controllers\DietaryReferenceValueController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FoodGroupController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MealLogItemController;
use App\Http\Controllers\MealTypeController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeOriginController;
use App\Http\Controllers\RecipeReviewController;
use App\Http\Controllers\SavedRecipeController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\RecommendedCalorieIntakeHistoryItemController;
use Illuminate\Support\Facades\Storage;

Route::post('/check-register-email', [AuthController::class, 'checkRegisterEmail']);
Route::get('/check-status-email', [AuthController::class, 'checkStatusEmail']);
Route::resource('/dialing-code', DialingCodeController::class)->only([
    'index',
    'show'
]);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/verify-otp', [AuthController::class, 'verifyOTP']);
    Route::post('/authenticating', [AuthController::class, 'authenticating']);
    Route::get('/checking-status-otp', [AuthController::class, 'checkingStatusOTP']);


    // Route::middleware('otp_verified')->group(function () {


    Route::resource('/saved-recipe', SavedRecipeController::class)->only([
        'index',
        'show',
    ]);


    Route::resource('/food-group', FoodGroupController::class)->only([
        'index',
    ]);
    Route::resource('/recipe-origin', RecipeOriginController::class)->only([
        'index',
    ]);

    Route::resource('/user', UserController::class)->only([
        'show',
    ]);

    Route::resource('/amrs', AmrController::class)->only(['index']);
    Route::resource('/activity-level', ActivityLevelController::class)->only([
        'index'
    ]);

    Route::get('/users/get-all-user/{userTypeId}/{company}', [UserController::class, 'showAll']);
    Route::patch('/user/update-personal-information/{slug}', [UserController::class, 'updatePersonalInformation']);
    Route::patch('/user/update-measurement/{slug}', [UserController::class, 'updateMeasurement']);
    Route::patch('/user/update-data/{slug}', [UserController::class, 'updateDataForEnergyComputation']);
    Route::patch('/user/update-calorie-intake/{slug}', [UserController::class, 'updateCalorieIntake']);
    Route::patch('/user/update-first-login/{slug}', [UserController::class, 'updateFirstLogin']);
    Route::patch('/user/update-basic-information/{slug}', [UserController::class, 'updateBasicInformation']);
    Route::patch('/user/update-password/{slug}', [UserController::class, 'updatePassword']);
    Route::patch('/user/update-contact-information/{slug}', [UserController::class, 'updateContactInformation']);


    Route::resource('/bmi-log', BmiLogController::class)->only([
        'store',
        'show'
    ]);

    Route::resource('/blood-pressure', BloodPressureLogController::class)->only([
        'store',
        'show'
    ]);

    Route::get('/recipe/all-recipe', [RecipeController::class, 'AllRecipe']);
    Route::get('/recipe/top', [RecipeController::class, 'topRecipe']);

    Route::resource('/recipe', RecipeController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',
    ]);


    Route::patch('/recipe/activate/{slug}', [RecipeController::class, 'ActivateRecipe']);

    Route::get('/recipe/food-group/{foodGroupId}', [RecipeController::class, 'showRecipeByFoodGroup']);

    Route::resource('/meal-log-item', MealLogItemController::class)->only([
        'store'
    ]);

    Route::get('/meal-log-item/{userId}/{createdAt}', [MealLogItemController::class, 'show']);
    Route::delete('/meal-log-item/delete', [MealLogItemController::class, 'deleteMealLogItem']);

    Route::resource('/dietary-reference-value', DietaryReferenceValueController::class)->only([
        'index'
    ]);



    Route::resource('/meal', MealController::class)->only([
        'index'
    ]);
    Route::resource('/calorie-logs', RecommendedCalorieIntakeHistoryItemController::class)->only(['index', 'show', 'store']);

    Route::get('/meal-type/all-meal-type', [MealTypeController::class, 'AllMealType']);

    Route::resource('/meal-type', MealTypeController::class)->only([
        'index',
        'store',
        'show',
        'update',
        'destroy'
    ]);

    Route::patch('/meal-type/activate/{slug}', [MealTypeController::class, 'ActivateMealType']);


    Route::resource('/season', SeasonController::class)->only([
        'index'
    ]);

    Route::resource('/saved-recipe', SavedRecipeController::class)->only([
        'store'
    ]);

    Route::resource('/unit', UnitController::class)->only([
        'index'
    ]);

    Route::get('/saved-recipe/show/{recipeId}/{userId}', [SavedRecipeController::class, 'showSavedRecipe']);
    Route::delete('/saved-recipe/destroy/{recipeId}', [SavedRecipeController::class, 'unFavoriteRecipe']);


    Route::resource('/recipe-review', RecipeReviewController::class)->only(['store', 'show']);

    Route::get('/dashboard/bmi-data/{weightClass}/{userTypeId}/{companyId}', [DashboardController::class, 'showBmiAnalytics']);
    Route::get('/dashboard/top-ten-recipe', [DashboardController::class, 'showTopTenRatedRecipe']);


    Route::get('/dashboard/bmi-data/{weightClass}/{userTypeId}/{companyId}', [DashboardController::class, 'showBmiAnalytics']);
    Route::get('/dashboard/top-ten-recipe', [DashboardController::class, 'showTopTenRatedRecipe']);



    Route::post('/upload-image', [ImageUploadController::class, 'upload']);

    Route::get('/storage/{filename}', function ($filename) {
        $path = storage_path('app/public/' . $filename);

        if (!Storage::exists('public/' . $filename)) {
            abort(404);
        }

        return response()->file($path);
    })->where('filename', '.*');
    // });
});


// do not put these routes inside sanctum middleware
Route::get('/user/check-contact-number/{contactNumber}/{dialingCode}', [UserController::class, 'checkContactNumber']);
Route::get('/email/send-verification-code/{verificationCode}/{email}/{mobileNumber}', [EmailController::class, 'sendVerificationCode']);
Route::resource('/nationality', NationalityController::class)->only([
    'index',
]);
Route::resource('/category', CategoryController::class)->only([
    'index',
]);
Route::resource('/rank', RankController::class)->only([
    'index',
]);
Route::resource('/company', CompanyController::class)->only([
    'index',
]);
Route::resource('/user', UserController::class)->only([
    'store',
]);
