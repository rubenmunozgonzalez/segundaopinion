<?php $__env->startSection('page'); ?>
    <?php echo e(trans('ticketit::admin.config-edit-subtitle')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
     <div class="panel panel-default">
      <div class="panel-heading">
        <h3><?php echo e(trans('ticketit::admin.config-edit-title')); ?>

          <div class="panel-nav pull-right" style="margin-top: -7px;">          
              <?php echo link_to_route(
                  $setting->grab('admin_route').'.configuration.index',
                  trans('ticketit::admin.btn-back'), null,
                  ['class' => 'btn btn-default']); ?>

              <?php /*
              <?php echo link_to_route(
                  $setting->grab('admin_route').'.configuration.create',
                  trans('ticketit::admin.btn-create-new-config'), null,
                  ['class' => 'btn btn-primary']); ?>

              */ ?>
          </div>
        </h3>  
      </div>     
      <div class="panel-body">
        <div class="form-horizontal">
<?php echo CollectiveForm::model($configuration, ['route' => [$setting->grab('admin_route').'.configuration.update', $configuration->id], 'method' => 'patch']); ?>

             <div class="well">
                 <b><?php echo e(trans('ticketit::admin.config-edit-tools')); ?></b><br>
                 <a href="https://www.functions-online.com/unserialize.html" target="_blank">
                     <?php echo e(trans('ticketit::admin.config-edit-unserialize')); ?>

                 </a>
                 <br>
                 <a href="https://www.functions-online.com/serialize.html" target="_blank">
                     <?php echo e(trans('ticketit::admin.config-edit-serialize')); ?>

                 </a>
             </div>

            <?php if(trans("ticketit::settings." . $configuration->slug) != ("ticketit::settings." . $configuration->slug) && trans("ticketit::settings." . $configuration->slug)): ?>
                <div class="panel panel-info">
                    <div class="panel-body"><?php echo trans("ticketit::settings." . $configuration->slug); ?></div>
                </div>
            <?php endif; ?>

              <!-- ID Field -->
              <div class="form-group">
                  <?php echo CollectiveForm::label('id', trans('ticketit::admin.config-edit-id') . trans('ticketit::admin.colon'), ['class' => 'col-sm-2 control-label']); ?>

                  <div class="col-sm-9">
                      <?php echo CollectiveForm::text('id', null, ['class' => 'form-control', 'disabled']); ?>

                  </div>
              </div>                

              <!-- Slug Field -->
              <div class="form-group">
                  <?php echo CollectiveForm::label('slug', trans('ticketit::admin.config-edit-slug') . trans('ticketit::admin.colon'), ['class' => 'col-sm-2 control-label']); ?>

                  <div class="col-sm-9">
                      <?php echo CollectiveForm::text('slug', null, ['class' => 'form-control', 'disabled']); ?>

                  </div>
              </div>

              <div class="form-group">
                  <?php echo CollectiveForm::label('default', trans('ticketit::admin.config-edit-default') . trans('ticketit::admin.colon'), ['class' => 'col-sm-2 control-label']); ?>

                  <div class="col-sm-9">
                      <?php if(!$default_serialized): ?>
                          <?php echo CollectiveForm::text('default', null, ['class' => 'form-control', 'disabled']); ?>

                      <?php else: ?>
                          <pre><?php echo e(var_export(unserialize($configuration->default), true)); ?></pre>
                      <?php endif; ?>
                  </div>
              </div>


              <!-- Value Field -->
              <div class="form-group">
                  <?php echo CollectiveForm::label('value', trans('ticketit::admin.config-edit-value') . trans('ticketit::admin.colon'), ['class' => 'col-sm-2 control-label']); ?>

                  <div class="col-sm-9">
                      <?php if(!$should_serialize): ?>
                            <?php echo CollectiveForm::text('value', null, ['class' => 'form-control']); ?>

                      <?php else: ?>
                          <?php echo CollectiveForm::textarea('value', var_export(unserialize($configuration->value), true), ['class' => 'form-control']); ?>

                      <?php endif; ?>
                  </div>
              </div>

            <!-- Serialize Field -->
            <div class="form-group">
                <?php echo CollectiveForm::label('serialize', trans('ticketit::admin.config-edit-should-serialize') . trans('ticketit::admin.colon'), ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-9">
                    <?php echo CollectiveForm::checkbox('serialize', 1, $should_serialize, ['class' => 'form-control', 'onchange' =>  'changeSerialize(this)',]); ?>

                    <span class="help-block" style="color: red;"><?php echo app('translator')->get('ticketit::admin.config-edit-eval-warning'); ?> <code>eval('$value = serialize(' . $value . ');')</code></span>
                </div>
            </div>

            <!-- Password Field -->
            <div id="serialize-password" class="form-group">
                <?php echo CollectiveForm::label('password', trans('ticketit::admin.config-edit-reenter-password') . trans('ticketit::admin.colon'), ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-9">
                    <?php echo CollectiveForm::password('password', ['class' => 'form-control']); ?>

                </div>
            </div>

              <!-- Lang Field -->
              <div class="form-group">
                  <?php echo CollectiveForm::label('lang', trans('ticketit::admin.config-edit-language') . trans('ticketit::admin.colon'), ['class' => 'col-sm-2 control-label']); ?>

                  <div class="col-sm-9">
                      <?php echo CollectiveForm::text('lang', null, ['class' => 'form-control']); ?>

                  </div>
              </div>

              <!-- Submit Field -->
              <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-2">
                    <?php echo CollectiveForm::submit(trans('ticketit::admin.btn-submit'), ['class' => 'btn btn-primary']); ?>

                  </div>
              </div>

          <?php echo CollectiveForm::close(); ?>

        </div>
      </div>
    </div>

    <script>
        function changeSerialize(e){
            document.querySelector("#serialize-password").style.display = e.checked ? 'block' : 'none';
            document.querySelector(".help-block").style.display = e.checked ? 'block' : 'none';
        }

        changeSerialize(document.querySelector("input[name='serialize']"));


    </script>


    <?php if($should_serialize): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/<?php echo e(Kordy\Ticketit\Helpers\Cdn::CodeMirror); ?>/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/<?php echo e(Kordy\Ticketit\Helpers\Cdn::CodeMirror); ?>/mode/clike/clike.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/<?php echo e(Kordy\Ticketit\Helpers\Cdn::CodeMirror); ?>/mode/php/php.min.js"></script>


    <script>

        loadCSS(<?php echo '"'.asset('https://cdnjs.cloudflare.com/ajax/libs/codemirror/' . Kordy\Ticketit\Helpers\Cdn::CodeMirror . '/codemirror.min.css').'"'; ?>);
        loadCSS(<?php echo '"'.asset('https://cdnjs.cloudflare.com/ajax/libs/codemirror/' . Kordy\Ticketit\Helpers\Cdn::CodeMirror . '/theme/monokai.min.css').'"'; ?>);

        window.addEventListener('load', function(){
            CodeMirror.fromTextArea( document.querySelector("textarea[name='value']"), {
                lineNumbers: true,
                mode: 'text/x-php',
                theme: 'monokai',
                indentUnit: 2,
                lineWrapping: true
            });
        });

    </script>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>