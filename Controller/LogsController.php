<?php
App::uses('HistoryAppController', 'History.Controller');
/**
 * Logs Controller
 *
 * @property Log $Log
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LogsController extends HistoryAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Log->recursive = 0;
		$this->set('logs', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Log->exists($id)) {
			throw new NotFoundException(__('Invalid log'));
		}
		$options = array('conditions' => array('Log.' . $this->Log->primaryKey => $id));
		$this->set('log', $this->Log->find('first', $options));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Log->id = $id;
		if (!$this->Log->exists()) {
			throw new NotFoundException(__('Invalid log'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Log->delete()) {
			$this->Session->setFlash(__('The log has been deleted.'));
		} else {
			$this->Session->setFlash(__('The log could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
