<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {

    public function initialize(array $config) {
        $this->table('ck_users');
        // Schema is defined here so no SQL database is needed (users live in Redis).
        $this->schema([
            'id' => ['type' => 'integer'],
            'name' => ['type' => 'string'],
            'username' => ['type' => 'string'],
            'password' => ['type' => 'string'],
            'role' => ['type' => 'string'],
            'created' => ['type' => 'datetime'],
            'modified' => ['type' => 'datetime'],
            '_constraints' => ['primary' => ['type' => 'primary', 'columns' => ['id']]],
        ]);
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('name', 'A Name is required')
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('role', 'A role is required')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'author']],
                'message' => 'Please enter a valid role'
            ]);
    }

}