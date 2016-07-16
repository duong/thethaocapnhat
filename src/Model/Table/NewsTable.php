<?php
namespace App\Model\Table;

use App\Model\Entity\News;
use Cake\ORM\Query;
use Cake\ORM\RulesCheckes;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
* 
*/
class NewsTable extends Table
{
	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->table('news');
		$this->displayField('title');
		$this->primarykey('id');
		$this->addBehavior('Timestamp');

		$this->belongsTo('Categories', [
			'foreignkey' => 'category_id', 
			'joinType' => 'INNER'
		]);

		$this->addBehavior('Josegonzalez/Upload.Upload', [
            'image' => [
                'fields' => [
                    // if these fields or their defaults exist
                    // the values will be set.
                    'dir' => 'photo_dir', // defaults to `dir`
                    'size' => 'photo_size', // defaults to `size`
                    'type' => 'photo_type', // defaults to `type`
                ],
            ],
        ]);
	}
	public function validationDefault(Validator $validator){
		$validator
			->integer('id')
			->allowEmpty('id', 'create');

		$validator
			->requirePresence('title');
		$validator
			->requirePresence('description');
		// $validator
		// 	->requirePresence('content');
		$validator
			->allowEmpty('image');
		$validator
			->requirePresence('author');
		return $validator;
	}
}