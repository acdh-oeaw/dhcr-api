<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Courses Controller
 *
 * @property \App\Model\Table\CoursesTable $Courses
 *
 * @method \App\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoursesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    
    
    
    public function index()
    {
        $query = $this->Courses->find('all', array(
        	'contain' => [
				'Users',
				'DeletionReasons',
				'Countries',
				'Cities',
				'Institutions',
				'CourseParentTypes',
				'CourseTypes',
				'Languages',
				'CourseDurationUnits'
			],
			'conditions' => [
				'Courses.active' => true,
				'Courses.deleted' => false
			]
		));
	
		$courses = $query->toArray();
		
		$this->viewBuilder()->setClassName('Json');
		if($this->request->is('xml'))
			$this->viewBuilder()->setClassName('Xml');

        $this->set(compact('courses'));
        $this->set('_serialize', 'courses');
    }

    /**
     * View method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => ['Users', 'DeletionReasons', 'Countries', 'Cities', 'Institutions', 'CourseParentTypes', 'CourseTypes', 'Languages', 'CourseDurationUnits', 'Disciplines', 'TadirahActivities', 'TadirahObjects', 'TadirahTechniques']
        ]);

        $this->set('course', $course);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $course = $this->Courses->newEntity();
        if ($this->request->is('post')) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $users = $this->Courses->Users->find('list', ['limit' => 200]);
        $deletionReasons = $this->Courses->DeletionReasons->find('list', ['limit' => 200]);
        $countries = $this->Courses->Countries->find('list', ['limit' => 200]);
        $cities = $this->Courses->Cities->find('list', ['limit' => 200]);
        $institutions = $this->Courses->Institutions->find('list', ['limit' => 200]);
        $courseParentTypes = $this->Courses->CourseParentTypes->find('list', ['limit' => 200]);
        $courseTypes = $this->Courses->CourseTypes->find('list', ['limit' => 200]);
        $languages = $this->Courses->Languages->find('list', ['limit' => 200]);
        $courseDurationUnits = $this->Courses->CourseDurationUnits->find('list', ['limit' => 200]);
        $disciplines = $this->Courses->Disciplines->find('list', ['limit' => 200]);
        $tadirahActivities = $this->Courses->TadirahActivities->find('list', ['limit' => 200]);
        $tadirahObjects = $this->Courses->TadirahObjects->find('list', ['limit' => 200]);
        $tadirahTechniques = $this->Courses->TadirahTechniques->find('list', ['limit' => 200]);
        $this->set(compact('course', 'users', 'deletionReasons', 'countries', 'cities', 'institutions', 'courseParentTypes', 'courseTypes', 'languages', 'courseDurationUnits', 'disciplines', 'tadirahActivities', 'tadirahObjects', 'tadirahTechniques'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => ['Disciplines', 'TadirahActivities', 'TadirahObjects', 'TadirahTechniques']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $users = $this->Courses->Users->find('list', ['limit' => 200]);
        $deletionReasons = $this->Courses->DeletionReasons->find('list', ['limit' => 200]);
        $countries = $this->Courses->Countries->find('list', ['limit' => 200]);
        $cities = $this->Courses->Cities->find('list', ['limit' => 200]);
        $institutions = $this->Courses->Institutions->find('list', ['limit' => 200]);
        $courseParentTypes = $this->Courses->CourseParentTypes->find('list', ['limit' => 200]);
        $courseTypes = $this->Courses->CourseTypes->find('list', ['limit' => 200]);
        $languages = $this->Courses->Languages->find('list', ['limit' => 200]);
        $courseDurationUnits = $this->Courses->CourseDurationUnits->find('list', ['limit' => 200]);
        $disciplines = $this->Courses->Disciplines->find('list', ['limit' => 200]);
        $tadirahActivities = $this->Courses->TadirahActivities->find('list', ['limit' => 200]);
        $tadirahObjects = $this->Courses->TadirahObjects->find('list', ['limit' => 200]);
        $tadirahTechniques = $this->Courses->TadirahTechniques->find('list', ['limit' => 200]);
        $this->set(compact('course', 'users', 'deletionReasons', 'countries', 'cities', 'institutions', 'courseParentTypes', 'courseTypes', 'languages', 'courseDurationUnits', 'disciplines', 'tadirahActivities', 'tadirahObjects', 'tadirahTechniques'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $course = $this->Courses->get($id);
        if ($this->Courses->delete($course)) {
            $this->Flash->success(__('The course has been deleted.'));
        } else {
            $this->Flash->error(__('The course could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}