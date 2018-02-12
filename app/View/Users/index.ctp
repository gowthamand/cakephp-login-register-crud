<div class="posts index">

    <h2><?php echo __('Users'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('Name'); ?></th>
            <th><?php echo $this->Paginator->sort('Username'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['name']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['created']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>

    </table>

    <p>

        <?php

        echo $this->Paginator->counter(array(A

            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')

        ));

        ?>   </p>

    <div class="paging">

        <?php

        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));

        echo $this->Paginator->numbers(array('separator' => ''));

        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));

        ?>

    </div>

</div>

<div class="actions">

    <h3><?php echo __('Actions'); ?></h3>

    <ul>

        <li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?></li>

        <li><?php echo $this->Html->link(__('Logout'), array('controller' => 'Users', 'action' => 'logout')); ?></li>

    </ul>

</div>
