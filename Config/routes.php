<?php
Router::connect('/admin/history', array('plugin' => 'History', 'admin' => true, 'controller' => 'logs', 'action' => 'index'));
Router::connect('/admin/history/:controller', array('plugin' => 'History', 'admin' => true, 'action' => 'index'));
Router::connect('/admin/history/:controller/:action/*', array('plugin' => 'History', 'admin' => true));
