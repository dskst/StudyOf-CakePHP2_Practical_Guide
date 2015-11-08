<?php
App::uses('AppModel', 'Model');
/**
 * Note Model
 *
 * @property Note $Note
 */
class Note extends AppModel
{
    public $belongsTo = array('Task');
}
