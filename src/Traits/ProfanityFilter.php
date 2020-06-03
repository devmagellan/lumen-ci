<?php

namespace WGT\Traits;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Log;

use WGT\Models\Profanity;
use WGT\Models\Profanity\ProfanityLog;

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
            : $model->fillable;

        $tableName = $model->getTable();
        $tableId = isset($model->id) ? $model->id : null;
        $firmId = isset($model->firm_id) ? $model->firm_id : null;

        $badwords = Profanity::pluck('word')->toArray();

        foreach($fillable as $field) {
            $filteredValue = self::filterProfanity($model->{$field}, $badwords);

            if (!empty($filteredValue)) {
                self::createLog([
                    'firm_id' => $firmId,
                    'table_name' => $tableName,
                    'table_field' => $field,
                    'table_id' => $tableId,
                    'original_content' => $model->{$field},
                    'updated_content' => $filteredValue['field'],
                    'replaced_words' => $filteredValue['badWordsUsed'],
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
            ? ['field' => $fieldValue, 'badWordsUsed' => implode(',', $wordUsed)]
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
        $profanityLog = new ProfanityLog($data);
        $profanityLog->user_id = isset(Auth::user()->id) ? Auth::user()->id : null;
        $profanityLog->class_name = static::class;
        $profanityLog->save();
    }
}
