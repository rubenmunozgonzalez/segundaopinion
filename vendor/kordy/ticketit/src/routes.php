<?php

Route::group(['middleware' => \Kordy\Ticketit\Helpers\LaravelVersion::authMiddleware()], function () use ($main_route, $main_route_path, $admin_route, $admin_route_path) {

    //Route::group(['middleware' => '', function () use ($main_route) {
    //Ticket public route
    Route::get("$main_route_path/complete", 'Kordy\Ticketit\Controllers\TicketsController@indexComplete')
            ->name("$main_route-complete");
    Route::get("$main_route_path/data/{id?}", 'Kordy\Ticketit\Controllers\TicketsController@data')
            ->name("$main_route.data");
    Route::get("$main_route_path/payments/data/{id?}", 'Kordy\Ticketit\Controllers\PaymentsController@data')
            ->name("$main_route.data");

    $field_name = last(explode('/', $main_route_path));
    Route::resource($main_route_path, 'Kordy\Ticketit\Controllers\TicketsController', [
            'names' => [
                'index'   => $main_route.'.index',
                'store'   => $main_route.'.store',
                'create'  => $main_route.'.create',
                'update'  => $main_route.'.update',
                'show'    => $main_route.'.show',
                'destroy' => $main_route.'.destroy',
                'edit'    => $main_route.'.edit',
            ],
            'parameters' => [
                $field_name => 'ticket',
            ],
        ]);

        //Ticket Comments public route
        $field_name = last(explode('/', "$main_route_path-comment"));
    Route::resource("$main_route_path-comment", 'Kordy\Ticketit\Controllers\CommentsController', [
            'names' => [
                'index'   => "$main_route-comment.index",
                'store'   => "$main_route-comment.store",
                'create'  => "$main_route-comment.create",
                'update'  => "$main_route-comment.update",
                'show'    => "$main_route-comment.show",
                'destroy' => "$main_route-comment.destroy",
                'edit'    => "$main_route-comment.edit",
            ],
            'parameters' => [
                $field_name => 'ticket_comment',
            ],
        ]);

        //Ticket complete route for permitted user.
        Route::get("$main_route_path/{id}/complete", 'Kordy\Ticketit\Controllers\TicketsController@complete')
            ->name("$main_route.complete");

        //Ticket complete dowload for permitted user.
        Route::get("$main_route_path/{id}/export/complete", 'Kordy\Ticketit\Controllers\ExportController@exportForAgent')
            ->name("$main_route.export.complete");

        //Ticket reopen route for permitted user.
        Route::get("$main_route_path/{id}/reopen", 'Kordy\Ticketit\Controllers\TicketsController@reopen')
            ->name("$main_route.reopen");

        Route::get("$main_route_path/payments/download", 'Kordy\Ticketit\Controllers\ExportController@downloadPayments')
            ->name("$main_route.payments.download");

        Route::get("$main_route_path/{id}/download/{filename}", 'Kordy\Ticketit\Controllers\TicketsController@download')
            ->name("$main_route.download");
    //});

    Route::group(['middleware' => 'Kordy\Ticketit\Middleware\IsAgentMiddleware'], function () use ($main_route, $main_route_path) {

        //API return list of agents in particular category
        Route::get("$main_route_path/agents/list/{category_id?}/{ticket_id?}", [
            'as'   => $main_route.'agentselectlist',
            'uses' => 'Kordy\Ticketit\Controllers\TicketsController@agentSelectList',
        ]);
    });

    Route::group(['middleware' => 'Kordy\Ticketit\Middleware\IsAdminMiddleware'], function () use ($admin_route, $admin_route_path) {

        //Ticket statuses admin routes (ex. http://url/tickets-admin/status)
        Route::resource("$admin_route_path/status", 'Kordy\Ticketit\Controllers\StatusesController', [
            'names' => [
                'index'   => "$admin_route.status.index",
                'store'   => "$admin_route.status.store",
                'create'  => "$admin_route.status.create",
                'update'  => "$admin_route.status.update",
                'show'    => "$admin_route.status.show",
                'destroy' => "$admin_route.status.destroy",
                'edit'    => "$admin_route.status.edit",
            ],
        ]);

        //Ticket priorities admin routes (ex. http://url/tickets-admin/priority)
        Route::resource("$admin_route_path/priority", 'Kordy\Ticketit\Controllers\PrioritiesController', [
            'names' => [
                'index'   => "$admin_route.priority.index",
                'store'   => "$admin_route.priority.store",
                'create'  => "$admin_route.priority.create",
                'update'  => "$admin_route.priority.update",
                'show'    => "$admin_route.priority.show",
                'destroy' => "$admin_route.priority.destroy",
                'edit'    => "$admin_route.priority.edit",
            ],
        ]);

        //Agents management routes (ex. http://url/tickets-admin/agent)
        Route::resource("$admin_route_path/agent", 'Kordy\Ticketit\Controllers\AgentsController', [
            'names' => [
                'index'   => "$admin_route.agent.index",
                'store'   => "$admin_route.agent.store",
                'create'  => "$admin_route.agent.create",
                'update'  => "$admin_route.agent.update",
                'show'    => "$admin_route.agent.show",
                'destroy' => "$admin_route.agent.destroy",
                'edit'    => "$admin_route.agent.edit",
            ],
        ]);


        //Agents management routes (ex. http://url/tickets-admin/agent)
        Route::resource("$admin_route_path/user", 'Kordy\Ticketit\Controllers\UsersController', [
            'names' => [
                'index'   => "$admin_route.user.index",
                'store'   => "$admin_route.user.store",
                'create'  => "$admin_route.user.create",
                'update'  => "$admin_route.user.update",
                'edit'    => "$admin_route.user.edit",
                'destroy' => "$admin_route.user.destroy",
                'edit'    => "$admin_route.user.edit",
            ],
        ]);

        //Agents management routes (ex. http://url/tickets-admin/agent)
        Route::resource("$admin_route_path/category", 'Kordy\Ticketit\Controllers\CategoriesController', [
            'names' => [
                'index'   => "$admin_route.category.index",
                'store'   => "$admin_route.category.store",
                'create'  => "$admin_route.category.create",
                'update'  => "$admin_route.category.update",
                'show'    => "$admin_route.category.show",
                'destroy' => "$admin_route.category.destroy",
                'edit'    => "$admin_route.category.edit",
            ],
        ]);

        //Settings configuration routes (ex. http://url/tickets-admin/configuration)
        Route::resource("$admin_route_path/configuration", 'Kordy\Ticketit\Controllers\ConfigurationsController', [
            'names' => [
                'index'   => "$admin_route.configuration.index",
                'store'   => "$admin_route.configuration.store",
                'create'  => "$admin_route.configuration.create",
                'update'  => "$admin_route.configuration.update",
                'show'    => "$admin_route.configuration.show",
                'destroy' => "$admin_route.configuration.destroy",
                'edit'    => "$admin_route.configuration.edit",
            ],
        ]);

        //Administrators configuration routes (ex. http://url/tickets-admin/administrators)
        Route::resource("$admin_route_path/administrator", 'Kordy\Ticketit\Controllers\AdministratorsController', [
            'names' => [
                'index'   => "$admin_route.administrator.index",
                'store'   => "$admin_route.administrator.store",
                'create'  => "$admin_route.administrator.create",
                'update'  => "$admin_route.administrator.update",
                'show'    => "$admin_route.administrator.show",
                'destroy' => "$admin_route.administrator.destroy",
                'edit'    => "$admin_route.administrator.edit",
            ],
        ]);

        //Administrators configuration routes (ex. http://url/tickets-admin/administrators)
        Route::resource("$admin_route_path/payments", 'Kordy\Ticketit\Controllers\PaymentsController', [
            'names' => [
                'index'   => "$admin_route.payments.index",
                'store'   => "$admin_route.payments.store",
                'create'  => "$admin_route.payments.create",
                'update'  => "$admin_route.payments.update",
                'show'    => "$admin_route.payments.show",
                'destroy' => "$admin_route.payments.destroy",
                'edit'    => "$admin_route.payments.edit",
            ],
        ]);

        Route::get("$admin_route_path/{type_id?}", function($type_id = 'all') use ($admin_route_path) {
            $a_month_ago = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));

            $begin_day = date('d', $a_month_ago);
            $begin_month = date('m', $a_month_ago);
            $begin_year = date('Y', $a_month_ago);

            $end_day = date('d');
            $end_month = date('m');
            $end_year = date('Y');

            return redirect($admin_route_path.'/'.$type_id.'/0/0/0/'.$begin_day.'/'.$begin_month.'/'.$begin_year.'/'.$end_day.'/'.$end_month.'/'.$end_year);
        });

        //Ticket admin index route (ex. http://url/tickets-admin/)
        Route::get("$admin_route_path/{type_id?}/{agent_id?}/{category_id?}/{user_id?}/{begin_day?}/{begin_month?}/{begin_year?}/{end_day?}/{end_month?}/{end_year?}", [
                'as'   => $admin_route.'.dashboard.indicator',
                'uses' => 'Kordy\Ticketit\Controllers\DashboardController@index',
        ]);
        //Ticket admin index route (ex. http://url/tickets-admin/)
        Route::get("$admin_route_path/{type_id?}/{agent_id?}/{category_id?}/{user_id?}/{begin_day?}/{begin_month?}/{begin_year?}/{end_day?}/{end_month?}/{end_year?}/export", [
                'as'   => $admin_route.'.dashboard.export',
                'uses' => 'Kordy\Ticketit\Controllers\DashboardController@export',
        ]);        //Tickets demo data route (ex. http://url/tickets-admin/demo-seeds/)
        //Route::get("$admin_route/demo-seeds", 'Kordy\Ticketit\Controllers\InstallController@demoDataSeeder');
    });
});
