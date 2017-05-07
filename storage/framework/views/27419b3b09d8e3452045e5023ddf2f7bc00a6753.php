<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-pills">
            <li role="presentation" class="<?php echo $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\TicketsController@index')) ? "active" : ""; ?>">
                <a href="<?php echo e(action('\Kordy\Ticketit\Controllers\TicketsController@index')); ?>"><?php echo e(trans('ticketit::lang.nav-active-tickets')); ?>

                    <span class="badge">
                         <?php
                            if ($u->isAdmin()) {
                                echo Kordy\Ticketit\Models\Ticket::active()->count();
                            } elseif ($u->isAgent()) {
                                echo Kordy\Ticketit\Models\Ticket::active()->agentUserTickets($u->id)->count();
                            } else {
                                echo Kordy\Ticketit\Models\Ticket::userTickets($u->id)->active()->count();
                            }
                        ?>
                    </span>
                </a>
            </li>
            <li role="presentation" class="<?php echo $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\TicketsController@indexComplete')) ? "active" : ""; ?>">
                <a href="<?php echo e(action('\Kordy\Ticketit\Controllers\TicketsController@indexComplete')); ?>"><?php echo e(trans('ticketit::lang.nav-completed-tickets')); ?>

                    <span class="badge">
                        <?php
                            if ($u->isAdmin()) {
                                echo Kordy\Ticketit\Models\Ticket::complete()->count();
                            } elseif ($u->isAgent()) {
                                echo Kordy\Ticketit\Models\Ticket::complete()->agentUserTickets($u->id)->count();
                            } else {
                                echo Kordy\Ticketit\Models\Ticket::userTickets($u->id)->complete()->count();
                            }
                        ?>
                    </span>
                </a>
            </li>

            <?php if($u->isAdmin()): ?>
                <li role="presentation" class="<?php echo $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\DashboardController@index')) || Request::is($setting->grab('admin_route').'/indicator*') ? "active" : ""; ?>">
                    <a href="<?php echo e(action('\Kordy\Ticketit\Controllers\DashboardController@index')); ?>"><?php echo e(trans('ticketit::admin.nav-dashboard')); ?></a>
                </li>

                <li role="presentation" class="dropdown <?php echo $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\StatusesController@index').'*') ||
                    $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\PrioritiesController@index').'*') ||
                    $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\AgentsController@index').'*') ||
                    $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\UsersController@index').'*') ||
                    $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\CategoriesController@index').'*') ||
                    $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\ConfigurationsController@index').'*') ||
                    $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\PaymentsController@index').'*')
                    ? "active" : ""; ?>">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(trans('ticketit::admin.nav-settings')); ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li role="presentation" class="<?php echo $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\StatusesController@index').'*') ? "active" : ""; ?>">
                            <a href="<?php echo e(action('\Kordy\Ticketit\Controllers\StatusesController@index')); ?>"><?php echo e(trans('ticketit::admin.nav-statuses')); ?></a>
                        </li>
                        <li role="presentation"  class="<?php echo $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\PrioritiesController@index').'*') ? "active" : ""; ?>">
                            <a href="<?php echo e(action('\Kordy\Ticketit\Controllers\PrioritiesController@index')); ?>"><?php echo e(trans('ticketit::admin.nav-priorities')); ?></a>
                        </li>
                        <li role="presentation"  class="<?php echo $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\AgentsController@index').'*') ? "active" : ""; ?>">
                            <a href="<?php echo e(action('\Kordy\Ticketit\Controllers\AgentsController@index')); ?>"><?php echo e(trans('ticketit::admin.nav-agents')); ?></a>
                        </li>
                        <li role="presentation"  class="<?php echo $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\UsersController@index').'*') ? "active" : ""; ?>">
                            <a href="<?php echo e(action('\Kordy\Ticketit\Controllers\UsersController@index')); ?>"><?php echo e(trans('ticketit::admin.nav-users')); ?></a>
                        </li>
                        <li role="presentation"  class="<?php echo $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\CategoriesController@index').'*') ? "active" : ""; ?>">
                            <a href="<?php echo e(action('\Kordy\Ticketit\Controllers\CategoriesController@index')); ?>"><?php echo e(trans('ticketit::admin.nav-categories')); ?></a>
                        </li>
                        <li role="presentation"  class="<?php echo $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\ConfigurationsController@index').'*') ? "active" : ""; ?>">
                            <a href="<?php echo e(action('\Kordy\Ticketit\Controllers\ConfigurationsController@index')); ?>"><?php echo e(trans('ticketit::admin.nav-configuration')); ?></a>
                        </li>
                        <li role="presentation"  class="<?php echo $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\PaymentsController@index').'*') ? "active" : ""; ?>">
                            <a href="<?php echo e(action('\Kordy\Ticketit\Controllers\PaymentsController@index')); ?>"><?php echo e(trans('ticketit::admin.nav-payments')); ?></a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</div>
