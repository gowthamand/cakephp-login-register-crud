<div class="posts index">
    <h2><?php echo __('Users'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?php echo 'id'; ?></th>
            <th><?php echo 'Name'; ?></th>
            <th><?php echo 'Username'; ?></th>
            <th><?php echo 'created'; ?></th>
            <th><?php echo 'modified'; ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id; ?>&nbsp;</td>
                <td><?= $user->name; ?>&nbsp;</td>
                <td><?= $user->username; ?>&nbsp;</td>
                <td><?= $user->created->format('y-M-d H:m:s'); ?>&nbsp;</td>
                <td><?= $user->modified->format('y-M-d H:m:s'); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $user->id)); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user->id)); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user->id), array(), __('Are you sure you want to delete # %s?', $user->id)); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?></li>

        <li><?php echo $this->Html->link(__('Logout'), array('controller' => 'Users', 'action' => 'logout')); ?></li>
    </ul>

</div>
</div>
