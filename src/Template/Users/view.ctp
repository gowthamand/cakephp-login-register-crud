<div class="users view">
    <h2><?= __('User') ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= h($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $user->created ? $user->created->format('Y-m-d H:i:s') : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $user->modified ? $user->modified->format('Y-m-d H:i:s') : '' ?></td>
        </tr>
    </table>
</div>
<div class="actions">
    <h3><?= __('Actions') ?></h3>
    <ul>
        <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</div>
