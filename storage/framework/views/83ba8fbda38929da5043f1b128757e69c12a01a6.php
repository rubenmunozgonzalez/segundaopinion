<div class="form-group">
    <?php echo CollectiveForm::label('name', trans('ticketit::admin.status-create-name') . trans('ticketit::admin.colon'), ['class' => 'col-lg-2 control-label']); ?>

    <div class="col-lg-10">
        <?php echo CollectiveForm::text('name', isset($status->name) ? $status->name : null, ['class' => 'form-control']); ?>

    </div>
</div>
<div class="form-group">
    <?php echo CollectiveForm::label('color', trans('ticketit::admin.status-create-color') . trans('ticketit::admin.colon'), ['class' => 'col-lg-2 control-label']); ?>

    <div class="col-lg-10">
        <?php echo CollectiveForm::custom('color', 'color', isset($status->color) ? $status->color : "#000000", ['class' => 'form-control']); ?>

    </div>
</div>
<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        <?php echo link_to_route($setting->grab('admin_route').'.status.index', trans('ticketit::admin.btn-back'), null, ['class' => 'btn btn-default']); ?>

        <?php if(isset($status)): ?>
            <?php echo CollectiveForm::submit(trans('ticketit::admin.btn-update'), ['class' => 'btn btn-primary']); ?>

        <?php else: ?>
            <?php echo CollectiveForm::submit(trans('ticketit::admin.btn-submit'), ['class' => 'btn btn-primary']); ?>

        <?php endif; ?>
    </div>
</div>
