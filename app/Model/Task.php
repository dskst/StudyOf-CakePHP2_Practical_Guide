<?php
App::uses('AppModel', 'Model');
/**
 * Task Model
 *
 * @property Task $Task
 */
class Task extends AppModel
{

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 60),
                'required' => true,
                'allowEmpty' => false,
                'message' => 'タスクを入力してください'
            ),
        ),
        'body' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'requiered' => true,
                'allowEmpty' => false,
                'message' => '詳細を入力してください'
            ),
        ),
    );
}
