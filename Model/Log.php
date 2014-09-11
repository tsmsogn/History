<?php
App::uses('HistoryAppModel', 'History.Model');

/**
 * Log Model
 *
 * @property User $User
 */
class Log extends HistoryAppModel {


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function beforeDelete($cascade = true) {
        if ($this->Behaviors->loaded('Log')) {
            $this->Behaviors->unload('Log');
        }
        return true;
    }

    public function beforeSave($options = array()) {
        if ($this->Behaviors->loaded('Log')) {
            $this->Behaviors->unload('Log');
        }
        return true;
    }

}
