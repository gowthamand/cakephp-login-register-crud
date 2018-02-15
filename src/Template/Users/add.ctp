<div class="container">
    <div class="users form">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <legend class="col-md-6"><?= __('Add User') ?></legend>
            <div class="form-group">
                <?= $this->Form->control('name', [
                    'class' => 'col-md-6'
                ]) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->control('username', [
                    'class' => 'col-md-6'
                ]) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->control('password', [
                    'class' => 'col-md-6'
                ]) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->control('role', [
                    'options' => ['admin' => 'Admin', 'author' => 'Author'],
                    'class' => 'col-md-6',
                ]) ?>
            </div>
        </fieldset>
        <div class="form-group col-md-6">
            <?= $this->Form->button(__('Submit')); ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
