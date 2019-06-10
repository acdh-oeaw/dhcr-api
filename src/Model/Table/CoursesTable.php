<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Courses Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\DeletionReasonsTable|\Cake\ORM\Association\BelongsTo $DeletionReasons
 * @property \App\Model\Table\CountriesTable|\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\InstitutionsTable|\Cake\ORM\Association\BelongsTo $Institutions
 * @property \App\Model\Table\CourseParentTypesTable|\Cake\ORM\Association\BelongsTo $CourseParentTypes
 * @property \App\Model\Table\CourseTypesTable|\Cake\ORM\Association\BelongsTo $CourseTypes
 * @property \App\Model\Table\LanguagesTable|\Cake\ORM\Association\BelongsTo $Languages
 * @property \App\Model\Table\CourseDurationUnitsTable|\Cake\ORM\Association\BelongsTo $CourseDurationUnits
 * @property \App\Model\Table\DisciplinesTable|\Cake\ORM\Association\BelongsToMany $Disciplines
 * @property \App\Model\Table\TadirahActivitiesTable|\Cake\ORM\Association\BelongsToMany $TadirahActivities
 * @property \App\Model\Table\TadirahObjectsTable|\Cake\ORM\Association\BelongsToMany $TadirahObjects
 * @property \App\Model\Table\TadirahTechniquesTable|\Cake\ORM\Association\BelongsToMany $TadirahTechniques
 *
 * @method \App\Model\Entity\Course get($primaryKey, $options = [])
 * @method \App\Model\Entity\Course newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Course[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Course|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Course saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Course patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Course[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Course findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CoursesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('courses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('DeletionReasons', [
            'foreignKey' => 'deletion_reason_id'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id'
        ]);
        $this->belongsTo('Institutions', [
            'foreignKey' => 'institution_id'
        ]);
        $this->belongsTo('CourseParentTypes', [
            'foreignKey' => 'course_parent_type_id'
        ]);
        $this->belongsTo('CourseTypes', [
            'foreignKey' => 'course_type_id'
        ]);
        $this->belongsTo('Languages', [
            'foreignKey' => 'language_id'
        ]);
        $this->belongsTo('CourseDurationUnits', [
            'foreignKey' => 'course_duration_unit_id'
        ]);
        $this->belongsToMany('Disciplines', [
            'foreignKey' => 'course_id',
            'targetForeignKey' => 'discipline_id',
            'joinTable' => 'courses_disciplines'
        ]);
        $this->belongsToMany('TadirahObjects', [
            'foreignKey' => 'course_id',
            'targetForeignKey' => 'tadirah_object_id',
            'joinTable' => 'courses_tadirah_objects'
        ]);
        $this->belongsToMany('TadirahTechniques', [
            'foreignKey' => 'course_id',
            'targetForeignKey' => 'tadirah_technique_id',
            'joinTable' => 'courses_tadirah_techniques'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->boolean('active')
            ->allowEmptyString('active', false);

        $validator
            ->boolean('deleted')
            ->allowEmptyString('deleted', false);

        $validator
            ->boolean('approved')
            ->allowEmptyString('approved', false);

        $validator
            ->scalar('approval_token')
            ->maxLength('approval_token', 255)
            ->allowEmptyString('approval_token');

        $validator
            ->boolean('mod_mailed')
            ->allowEmptyString('mod_mailed', false);

        $validator
            ->dateTime('last_reminder')
            ->allowEmptyDateTime('last_reminder');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('department')
            ->maxLength('department', 255)
            ->allowEmptyString('department');

        $validator
            ->scalar('access_requirements')
            ->allowEmptyString('access_requirements');

        $validator
            ->scalar('start_date')
            ->maxLength('start_date', 100)
            ->allowEmptyString('start_date');

        $validator
            ->integer('duration')
            ->allowEmptyString('duration');

        $validator
            ->boolean('recurring')
            ->allowEmptyString('recurring', false);

        $validator
            ->scalar('info_url')
            ->allowEmptyString('info_url');

        $validator
            ->scalar('guide_url')
            ->allowEmptyString('guide_url');

        $validator
            ->dateTime('skip_info_url')
            ->allowEmptyDateTime('skip_info_url');

        $validator
            ->dateTime('skip_guide_url')
            ->allowEmptyDateTime('skip_guide_url');

        $validator
            ->numeric('ects')
            ->allowEmptyString('ects');

        $validator
            ->scalar('contact_mail')
            ->maxLength('contact_mail', 255)
            ->allowEmptyString('contact_mail');

        $validator
            ->scalar('contact_name')
            ->maxLength('contact_name', 255)
            ->allowEmptyString('contact_name');

        $validator
            ->decimal('lon')
            ->allowEmptyString('lon');

        $validator
            ->decimal('lat')
            ->allowEmptyString('lat');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['deletion_reason_id'], 'DeletionReasons'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['institution_id'], 'Institutions'));
        $rules->add($rules->existsIn(['course_parent_type_id'], 'CourseParentTypes'));
        $rules->add($rules->existsIn(['course_type_id'], 'CourseTypes'));
        $rules->add($rules->existsIn(['language_id'], 'Languages'));
        $rules->add($rules->existsIn(['course_duration_unit_id'], 'CourseDurationUnits'));

        return $rules;
    }
}