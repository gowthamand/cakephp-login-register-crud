<div class="container">
    <div class="users form">
        <div class="container">
                <div class="col-md-6">
                    <?= $this->Flash->render() ?>
                </div>
                <?= $this->Form->create() ?>
                <fieldset>
                    <div class="col-md-6">
                        <legend class=""><?= __('Please enter username and password') ?></legend>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('username', [
                            'class' => 'col-md-6 required'
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('password', [
                            'class' => 'col-md-6 required'
                        ]) ?>
                    </div>
                </fieldset>
                <div class="form-group col-md-6">
                    <?= $this->Form->button(__('Login')); ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
    </div>
</div>
