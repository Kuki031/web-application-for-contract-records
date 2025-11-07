<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\HostingController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect("/contracts");
});



Route::prefix("auth")->group(function () {
    Route::name("auth.")->group(function () {
        Route::get("login", [AuthController::class, "showLoginForm"])->name("showLoginForm");
        Route::post("login", [AuthController::class, "authenticate"])->name("authenticate");
        Route::post("logout", [AuthController::class, "logout"])->name("logout")->middleware("auth");
    });
});



Route::prefix("contracts")->group(function () {
    Route::get("/", [UserController::class, "showDashboard"])->name("dashboard")->middleware("auth");

    Route::middleware("auth")->group(function () {
        Route::resource("template", TemplateController::class);
        Route::resource("service", ServiceController::class);
        Route::resource("price", PriceController::class);
        Route::resource("client", ClientController::class);
        Route::resource("user", UserController::class);
        Route::resource("contract", ContractController::class);
        Route::resource("payment", PaymentController::class)->except(['show']);
        Route::prefix("contract")->group(function () {
            Route::name("contract.")->group(function () {
                Route::get('/download/{contract}', [ContractController::class, 'download'])->name('download');
                Route::get("/view-pdf/{contract}", [ContractController::class, 'viewPDF'])->name('viewPDF');
                Route::patch("/upload/{contract}", [ContractController::class, 'handlePDF'])->name("upload");
            });
        });


        Route::middleware(EnsureUserHasRole::class)->prefix("admin")->group(function () {
            Route::name('admin.')->group(function () {
                Route::get("user", [AdminController::class, "index"])->name("index");
                Route::get("user/create", [AdminController::class, "create"])->name("create");
                Route::get("user/{user}/edit", [AdminController::class, "edit"])->name("edit");
                Route::post("user", [AdminController::class, "store"])->name("store");
                Route::put("user/{user}", [AdminController::class, "update"])->name("update");
                Route::delete("user/{user}", [AdminController::class, "destroy"])->name("destroy");
            });

            Route::get('client/{client}/domains', [ClientController::class, 'getClientDomains'])->name('client.domains');
            Route::resource('log', LogsController::class)->only(['index', 'show']);
            Route::resource('hosting', HostingController::class);
            Route::resource('domain', DomainController::class);
            Route::resource('note', NoteController::class)->only(['store', 'destroy', 'update']);
        });
    });
});
