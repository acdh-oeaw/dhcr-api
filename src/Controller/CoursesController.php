<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use http\Exception\BadHeaderException;

/**
 * Courses Controller
 *
 * @property \App\Model\Table\CoursesTable $Courses
 *
 * @method \App\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoursesController extends AppController
{
    public $modelClass = 'DhcrCore.Courses';

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->Courses->evaluateQuery($this->request->getQuery());
		$courses = $this->Courses->getResults();

		$this->set('courses', $courses);
    }


    public function count() {
		$this->Courses->evaluateQuery($this->request->getQuery());
		$this->set('course_count', $this->Courses->countResults());
	}

    /**
     * View method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $course = $this->Courses->get($id, [
			'contain' => $this->Courses->containments,
			'conditions' => [
				'Courses.active' => true
			]
		]);
        if(empty($course)) {
			throw new RecordNotFoundException();
		}
        $this->set('course', $course);
    }


}
