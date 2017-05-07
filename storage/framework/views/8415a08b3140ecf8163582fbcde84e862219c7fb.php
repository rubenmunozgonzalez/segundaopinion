<?php $__env->startSection('page'); ?>
    <?php echo e(trans('ticketit::admin.index-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if($tickets_count): ?>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-lg-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="/consultas-admin/all" onclick="refresh()">
                                <div class="col-xs-3" style="font-size: 5em;">
                                    <i class="glyphicon glyphicon-th"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <h1><?php echo e($tickets_count); ?></h1>
                                  <div><?php echo e(trans('ticketit::admin.index-total-tickets')); ?></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="/consultas-admin/opened" onclick="refresh()">
                                <div class="col-xs-3" style="font-size: 5em;">
                                    <i class="glyphicon glyphicon-wrench"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h1><?php echo e($open_tickets_count); ?></h1>
                                    <div><?php echo e(trans('ticketit::admin.index-open-tickets')); ?></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="/consultas-admin/closed" onclick="refresh()">
                                <div class="col-xs-3" style="font-size: 5em;">
                                    <i class="glyphicon glyphicon-thumbs-up"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h1><?php echo e($closed_tickets_count); ?></h1>
                                    <span><?php echo e(trans('ticketit::admin.index-closed-tickets')); ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo e(trans('ticketit::admin.index-performance-indicator')); ?>

                        <div class="pull-right">
                            <div class="btn-group">
                              Desde: <input type="text" id="begin_date" name="begin_date" value="<?php echo Request::segment(6).'/'.Request::segment(7).'/'.Request::segment(8); ?>" class="picker input-sm">
                              Hasta: <input type="text" id="end_date" name="end_date" value="<?php echo Request::segment(9).'/'.Request::segment(10).'/'.Request::segment(11); ?>" class="picker input-sm">
                              <a href="#" onclick="exportData()"><i class="fa fa-download"></i></a>
                            </div>
                       </div>
                    </div>
                    <div class="panel-body">
                        <div id="curve_chart" style="width: 100%; height: 350px"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo e(trans('ticketit::admin.index-tickets-share-per-category')); ?>

                            </div>
                            <div class="panel-body">
                                <div id="catpiechart" style="width: auto; height: 350;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo e(trans('ticketit::admin.index-tickets-share-per-agent')); ?>

                            </div>
                            <div class="panel-body">
                                <div id="agentspiechart" style="width: auto; height: 350;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php /*<h4><i class="glyphicon glyphicon-info-sign"></i> Tickets Activities</h4>*/ ?>
                <?php /*<hr />*/ ?>
                <ul class="nav nav-tabs nav-justified">
                    <li class="<?php echo e($active_tab == "cat" ? "active" : ""); ?>">
                        <a data-toggle="pill" href="#information-panel-categories">
                            <i class="glyphicon glyphicon-folder-close"></i>
                            <small><?php echo e(trans('ticketit::admin.index-categories')); ?></small>
                        </a>
                    </li>
                    <li class="<?php echo e($active_tab == "agents" ? "active"  : ""); ?>">
                        <a data-toggle="pill" href="#information-panel-agents">
                            <i class="glyphicon glyphicon-user"></i>
                            <small><?php echo e(trans('ticketit::admin.index-agents')); ?></small>
                        </a>
                    </li>
                    <li class="<?php echo e($active_tab == "users" ? "active" : ""); ?>">
                        <a data-toggle="pill" href="#information-panel-users">
                            <i class="glyphicon glyphicon-user"></i>
                            <small><?php echo e(trans('ticketit::admin.index-users')); ?></small>
                        </a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div id="information-panel-categories" class="list-group tab-pane fade <?php echo e($active_tab == "cat" ? "in active" : ""); ?>">
                        <a href="#" class="list-group-item disabled">
                            <span><?php echo e(trans('ticketit::admin.index-category')); ?>

                                <span class="badge"><?php echo e(trans('ticketit::admin.index-total')); ?></span>
                            </span>
                            <span class="pull-right text-muted small">
                                <em>
                                    <?php echo e(trans('ticketit::admin.index-open')); ?> /
                                     <?php echo e(trans('ticketit::admin.index-closed')); ?>

                                </em>
                            </span>
                        </a>
                        <?php foreach($categories as $category): ?>
                            <a href="#" onclick="selectCategory(<?php echo e($category->id); ?>)" class="list-group-item">
                        <span style="color: <?php echo e($category->color); ?>">
                            <?php echo e($category->name); ?> <span class="badge"><?php echo e($category->tickets()->count()); ?></span>
                        </span>
                        <span class="pull-right text-muted small">
                            <em>
                                <?php echo e($category->tickets()->whereNull('completed_at')->count()); ?> /
                                 <?php echo e($category->tickets()->whereNotNull('completed_at')->count()); ?>

                            </em>
                        </span>
                            </a>
                        <?php endforeach; ?>
                        <?php echo $categories->render(); ?>

                    </div>
                    <div id="information-panel-agents" class="list-group tab-pane fade <?php echo e($active_tab == "agents" ? "in active" : ""); ?>">
                        <a href="#" class="list-group-item disabled">
                            <span><?php echo e(trans('ticketit::admin.index-agent')); ?>

                                <span class="badge"><?php echo e(trans('ticketit::admin.index-total')); ?></span>
                            </span>
                            <span class="pull-right text-muted small">
                                <em>
                                    <?php echo e(trans('ticketit::admin.index-open')); ?> /
                                    <?php echo e(trans('ticketit::admin.index-closed')); ?>

                                </em>
                            </span>
                        </a>
                        <?php foreach($agents as $agent): ?>
                            <a onclick="selectAgent(<?php echo e($agent->id); ?>)" href="#" class="list-group-item">
                                <span>
                                    <?php echo e($agent->name); ?>

                                    <span class="badge">
                                         <?php echo e($agent->agentTickets(false)->count()  +
                                         $agent->agentTickets(true)->count()); ?>

                                    </span>
                                </span>
                                <span class="pull-right text-muted small">
                                    <em>
                                        <?php echo e($agent->agentTickets(false)->count()); ?> /
                                         <?php echo e($agent->agentTickets(true)->count()); ?>

                                    </em>
                                </span>
                            </a>
                        <?php endforeach; ?>
                        <?php echo $agents->render(); ?>

                    </div>
                    <div id="information-panel-users" class="list-group tab-pane fade <?php echo e($active_tab == "users" ? "in active" : ""); ?>">
                        <a href="#" class="list-group-item disabled">
                            <span><?php echo e(trans('ticketit::admin.index-user')); ?>

                                <span class="badge"><?php echo e(trans('ticketit::admin.index-total')); ?></span>
                            </span>
                            <span class="pull-right text-muted small">
                                <em>
                                    <?php echo e(trans('ticketit::admin.index-open')); ?> /
                                    <?php echo e(trans('ticketit::admin.index-closed')); ?>

                                </em>
                            </span>
                        </a>
                        <?php foreach($users as $user): ?>
                            <a href="#" onclick="selectUser(<?php echo e($user->id); ?>)" class="list-group-item">
                                <span>
                                    <?php echo e($user->name); ?>

                                    <span class="badge">
                                        <?php echo e($user->userTickets(false)->count()  +
                                         $user->userTickets(true)->count()); ?>

                                    </span>
                                </span>
                                <span class="pull-right text-muted small">
                                    <em>
                                        <?php echo e($user->userTickets(false)->count()); ?> /
                                        <?php echo e($user->userTickets(true)->count()); ?>

                                    </em>
                                </span>
                            </a>
                        <?php endforeach; ?>
                        <?php echo $users->render(); ?>

                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="well text-center">
            <?php echo e(trans('ticketit::admin.index-empty-records')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <?php if($tickets_count): ?>
    <?php /*<?php echo $__env->make('ticketit::shared.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
    <script type="text/javascript"
            src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

    <script type="text/javascript">
        google.setOnLoadCallback(drawChart);

        // performance line chart
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["<?php echo e(trans('ticketit::admin.index-month')); ?>", "<?php echo implode('", "', $monthly_performance['categories']); ?>"],
                <?php foreach($monthly_performance['interval'] as $month => $records): ?>
                    ["<?php echo e($month); ?>", <?php echo implode(',', $records); ?>],
                <?php endforeach; ?>
            ]);

            var options = {
                title: '<?php echo addslashes(trans('ticketit::admin.index-performance-chart')); ?>',
                curveType: 'function',
                legend: {position: 'right'},
                vAxis: {
                    viewWindowMode:'explicit',
                    format: '#',
                    viewWindow:{
                        min:0
                    }
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);

            // Categories Pie Chart
            var cat_data = google.visualization.arrayToDataTable([
              ['<?php echo e(trans('ticketit::admin.index-category')); ?>', '<?php echo addslashes(trans('ticketit::admin.index-tickets')); ?>'],
              <?php foreach($categories_share as $cat_name => $cat_tickets): ?>
                    ['<?php echo addslashes($cat_name); ?>', <?php echo e($cat_tickets); ?>],
              <?php endforeach; ?>
            ]);

            var cat_options = {
              title: '<?php echo addslashes(trans('ticketit::admin.index-categories-chart')); ?>',
              legend: {position: 'bottom'}
            };

            var cat_chart = new google.visualization.PieChart(document.getElementById('catpiechart'));

            cat_chart.draw(cat_data, cat_options);

            // Agents Pie Chart
            var agent_data = google.visualization.arrayToDataTable([
              ['<?php echo e(trans('ticketit::admin.index-agent')); ?>', '<?php echo addslashes(trans('ticketit::admin.index-tickets')); ?>'],
              <?php foreach($agents_share as $agent_name => $agent_tickets): ?>
                    ['<?php echo addslashes($agent_name); ?>', <?php echo e($agent_tickets); ?>],
              <?php endforeach; ?>
            ]);

            var agent_options = {
              title: '<?php echo addslashes(trans('ticketit::admin.index-agents-chart')); ?>',
              legend: {position: 'bottom'}
            };

            var agent_chart = new google.visualization.PieChart(document.getElementById('agentspiechart'));

            agent_chart.draw(agent_data, agent_options);

        }
    </script>
    <script src="<?php echo e(asset('public/assets/frontend/js/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/frontend/js/bootstrap-datepicker.es.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/frontend/css/datepicker3.css')); ?>" type="text/css"></style>
    <script>
        function selectCategory(id) {
            var str = $('#begin_date').val();
            var res = str.split("/");
            var str = $('#end_date').val();
            var res2 = str.split("/");
            document.location = '../../../../../../../../0/' + id + '/0/' + res[0] + '/' + res[1] + '/' + res[2] + '/' + res2[0] + '/' + res2[1] + '/' + res2[2];
        }

        function selectAgent(id) {
            var str = $('#begin_date').val();
            var res = str.split("/");
            var str = $('#end_date').val();
            var res2 = str.split("/");
            document.location = '../../../../../../../../' + id + '/0/0/' + res[0] + '/' + res[1] + '/' + res[2] + '/' + res2[0] + '/' + res2[1] + '/' + res2[2];
        }

        function selectUser(id) {
            var str = $('#begin_date').val();
            var res = str.split("/");
            var str = $('#end_date').val();
            var res2 = str.split("/");
            document.location = '../../../../../../../../0/0/' + id + '/' + res[0] + '/' + res[1] + '/' + res[2] + '/' + res2[0] + '/' + res2[1] + '/' + res2[2];
        }

        function exportData() {
            var str = $('#begin_date').val();
            var res = str.split("/");
            var str = $('#end_date').val();
            var res2 = str.split("/");
            document.location = '../../../../../' + res[0] + '/' + res[1] + '/' + res[2] + '/' + res2[0] + '/' + res2[1] + '/' + res2[2] + '/export';
        }

        $(document).ready( function() {
          $('.picker').datepicker({language: 'es', format: 'dd/mm/yyyy'});
          $('#begin_date').change(function(){
            var str = $('#begin_date').val();
            var res = str.split("/");
            var str = $('#end_date').val();
            var res2 = str.split("/");
            document.location = '../../../../../' + res[0] + '/' + res[1] + '/' + res[2] + '/' + res2[0] + '/' + res2[1] + '/' + res2[2];
          });
          $('#end_date').change(function(){
            var str = $('#begin_date').val();
            var res = str.split("/");
            var str = $('#end_date').val();
            var res2 = str.split("/");
            document.location = '../../../../../' + res[0] + '/' + res[1] + '/' + res[2] + '/' + res2[0] + '/' + res2[1] + '/' + res2[2];
          });
        });
    </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>