<?php
/**
 * TasksContoller Class
 *
 * タスク管理を行う
 *
 * @auther daisuke.sato
 * @version 1.0
 */
class TasksController extends AppController
{
    public $scaffold;

    public $components = array('Flash');

    /**
     * タスク一覧表示
     *
     * @return void
     */
    public function index()
    {
        // データをモデルから取得してビューに渡す
        $options = array(
            'conditions' => array(
                'Task.status' => 0
            )
        );
        $tasks_data = $this->Task->find('all', $options);
        $this->set('tasks_data', $tasks_data);

        // app/View/Tasks/indes.ctp を表示
        $this->render('index');
    }

    public function create()
    {
        // POSTされた場合だけ処理を行う
        if ($this->request->is('post')) {
            $data = array(
                'name' => $this->request->data['name']
            );

            // データ登録
            if ($this->Task->save($data)) {
                $msg = sprintf('タスク %s を登録しました。', $this->Task->id);
                $this->Flash->success(__($msg));
            } else {
                $this->Flash->error(__('タスクの登録に失敗しました。'));
            }

            return $this->redirect(array('action' => 'index'));
        }

        $this->render('create');
    }

    /**
     * タスク完了処理
     *
     * @param  intval   $id Task.id
     * @return void
     */
    public function done($id = null)
    {
        $this->Task->id = $id;
        if (!$this->Task->exists()) {
            throw new NotFoundException(__('タスクが存在しません'));
        }

        // URLの末尾からタスクのIDを取得してデータを更新
        if ($this->Task->saveField('status', 1)) {
            $msg  = sprintf('タスク %s を完了しました。', $id);
            $this->Flash->success(__($msg));
        } else {
            $this->Flash->error(__('タスクの更新に失敗しました。'));
        }

        return $this->redirect(array('action' => 'index'));
        // $this->flash($msg, 'Task/index');
    }
}
