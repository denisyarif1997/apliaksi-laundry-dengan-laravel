<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\ItemModel;
use App\Models\MesinCuciModel;
use App\Models\CustomerModel;
use App\Models\ServicesModel;
use App\Models\TransactionModel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        View::composer('components.sidebar', function ($view) {
            $view->with('userCount', User::count());
            $view->with('RoleCount', Role::count());
            $view->with('PermissionCount', Permission::count());
            $view->with('ItemCount', ItemModel::count());
            $view->with('MesinCount', MesinCuciModel::count());
            $view->with('CustomerCount', CustomerModel::count());
            $view->with('ServicesCount', ServicesModel::count());
            $view->with('TransactionCount', TransactionModel::count());
            
            // Backup Count (check if directory exists first to avoid error)
            $backupCount = 0;
            if (Storage::exists('backups')) {
                $backupCount = count(Storage::files('backups'));
            }
            $view->with('BackupCount', $backupCount);

            // Report Count (Use transaction count for today as a placeholder or 0)
            $view->with('ReportCount', 0); 
        });
    }
}
