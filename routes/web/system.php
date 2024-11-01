<?php

use App\Http\Controllers\Web\System\BackjobController;
use App\Http\Controllers\Web\System\CriteriaController;
use Illuminate\Support\Facades\Route;

Route::prefix("system")
    ->name("system.")
    ->group(function () {
        Route::resource("backjobs", BackjobController::class)->except(
            "show",
            "edit",
            "create"
        );
        // CRITERIA RELATED ROUTES
        Route::resource("criterias", CriteriaController::class)->except(
            "store",
            "show",
            "edit",
            "create"
        );
        Route::prefix("criterias")
            ->name("criterias.")
            ->group(function () {
                Route::post("create-cluster/{criteriaId}", [
                    CriteriaController::class,
                    "storeCluster",
                ])->name("store-cluster");

                Route::delete("delete-cluster/{criteriaId}/{clusterIndex}", [
                    CriteriaController::class,
                    "destroyCluster",
                ])->name("destory-cluster");

                Route::patch("update-clusters/{criteriaId}", [
                    CriteriaController::class,
                    "updateClustersOrder",
                ])->name("update-clusters");

                Route::patch("update-cluster-info/{criteriaId}", [
                    CriteriaController::class,
                    "updateClusterInfo",
                ])->name("update-cluster-info");
            });
        // Route::get("formulars", [SystemController::class, "formulars"]);
    });
