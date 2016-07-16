<?php
namespace App\Model\Table;

use App\Model\Entity\BookmarksTag;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BookmarksTags Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Bookmarks
 * @property \Cake\ORM\Association\BelongsTo $Tags
 */
class BookmarksTagsTable extends Table
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

        $this->table('bookmarks_tags');
        $this->displayField('bookmark_id');
        $this->primaryKey(['bookmark_id', 'tag_id']);

        $this->belongsTo('Bookmarks', [
            'foreignKey' => 'bookmark_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tags', [
            'foreignKey' => 'tag_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['bookmark_id'], 'Bookmarks'));
        $rules->add($rules->existsIn(['tag_id'], 'Tags'));
        return $rules;
    }
}
