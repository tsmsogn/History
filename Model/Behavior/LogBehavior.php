<?php
class LogBehavior extends ModelBehavior {

	private $_original = array();

	public function setup(Model $Model, $settings = array()) {
	}

	public function beforeDelete(Model $Model, $cascade = true) {
		$data = $Model
			->find('first',
				array('conditions' => array($Model->alias . '.' . $Model->primaryKey => $Model->id), 'recursive' => -1));
		$this->_original[$Model->alias] = (!empty($data)) ? $data[$Model->alias] : array();
		return true;
	}

	public function afterDelete(Model $Model) {

		$User = ClassRegistry::init('User');
		$currentUser = null;
		if ($User->hasMethod('getCurrentUser')) {
			$currentUser = $User->getCurrentUser();
		}

		$data = $Model
			->find('first',
				array('conditions' => array($Model->alias . '.' . $Model->primaryKey => $Model->id), 'recursive' => -1));
		$derivative[$Model->alias] = (!empty($data)) ? $data[$Model->alias] : array();

		$log = array(
			'Log' => array(
				'action' => 'delete',
				'diff' => json_encode(
					array($Model->alias => Set::diff($this->_original[$Model->alias], $derivative[$Model->alias]))),
				'model' => $Model->alias,
				'model_id' => $Model->id,
				'user_id' => ($currentUser) ? $currentUser[$User->primaryKey] : '',
			)
		);

		$Log = ClassRegistry::init('History.Log');
		$Log->create();
		$Log->save($log);
	}

	public function beforeSave(Model $Model) {
		$data = $Model
			->find('first',
				array('conditions' => array($Model->alias . '.' . $Model->primaryKey => $Model->id), 'recursive' => -1));
		$this->_original[$Model->alias] = (!empty($data)) ? $data[$Model->alias] : array();
		return true;
	}

	public function afterSave(Model $Model, $created) {

		$User = ClassRegistry::init('User');
		$currentUser = null;
		if ($User->hasMethod('getCurrentUser')) {
			$currentUser = $User->getCurrentUser();
		}

		$data = $Model
			->find('first',
				array('conditions' => array($Model->alias . '.' . $Model->primaryKey => $Model->id), 'recursive' => -1));
		$derivative[$Model->alias] = (!empty($data)) ? $data[$Model->alias] : array();

		$log = array(
			'Log' => array(
				'action' => ($created) ? 'created' : 'modified',
				'diff' => json_encode(
					array($Model->alias => Set::diff($this->_original[$Model->alias], $derivative[$Model->alias]))),
				'model' => $Model->alias,
				'model_id' => $Model->id,
				'user_id' => ($currentUser) ? $currentUser[$User->primaryKey] : '',
			)
		);

		$Log = ClassRegistry::init('History.Log');
		$Log->create();
		$Log->save($log);
	}

}
