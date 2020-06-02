<?php

namespace WGT\Traits;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Log;

use WGT\Models\Profanity;

trait ProfanityFilter
{
    public static function bootProfanityFilter()
    {
        self::observerCreated();
        self::observerSaved();
        self::observerUpdated();
    }

    protected static function observerCreated()
    {
        static::created(function (Model $model) {
            self::checkProfanity($model, 'create');
        });
    }

    protected static function observerSaved()
    {
        static::saved(function (Model $model) {
            self::checkProfanity($model, 'save');
        });
    }

    protected static function observerUpdated()
    {
        static::updated(function (Model $model) {
            self::checkProfanity($model, 'update');
        });
    }

    protected static function checkProfanity(Model $model, $method)
    {
        if (!isset($model->fillable) || empty($model->fillable)) {
            return true;
        }

        $fillable = isset($model->ignoreProfanity) && !empty($model->ignoreProfanity)
            ? array_diff($model->fillable, $model->ignoreProfanity)
            : $fillable;

        $tableName = $model->getTable();
        $tableId = isset($model->id) ? $model->id : null;

        $badwords = Profanity::pluck('word')->toArray();

        foreach($fillable as $field) {
            $filteredValue = self::filterProfanity($model->{$field}, $badwords);

            if (!empty($filteredValue)) {
                self::createLog([
                    'table_name' => $tableName,
                    'table_field' => $field,
                    'table_id' => $tableId,
                    'original_content' => $model->{$field},
                    'updated_content' => $filteredValue['field'],
                    'wordReplaced' => $filteredValue['badwords'],
                    'method' => $method
                ]);

                self::updateModelWithProfanity(
                    $model,
                    $field,
                    $filteredValue['field'],
                    $tableId
                );
            }
        }
    }

    protected static function filterProfanity($fieldValue, $badwords)
    {
        if (empty($fieldValue) || !is_string($fieldValue)) {
            return [];
        }

        $wordUsed = [];

        foreach($badwords as $word) {
            if (strpos($fieldValue, $word) !== false) {
                array_push($wordUsed, $word);
                $fieldValue = str_ireplace($word, '.', $fieldValue);
            }
        }

        return (!empty($wordUsed))
            ? ['field' => $fieldValue, 'badwords' => implode(',', $badwords)]
            : [];
    }

    protected static function updateModelWithProfanity(
        Model $entity,
        $field,
        $fieldValue,
        $id
    ) {
        $entity::unsetEventDispatcher();
        $model = $entity::find($id);
        $model->{$field} = $fieldValue;
        $model->save();
    }

    protected static function createLog($data)
    {
        $data['userId'] = isset(Auth::user()->id) ? Auth::user()->id : null;
        $data['className'] = static::class;

        Log::info('Data: '. json_encode($data));
            /*
            id
            user_id
            original_content
            updated_content
            replaced_words
            class_name
            table_name
            table_field
            table_id
            method
            created_at
            */
    }
}
