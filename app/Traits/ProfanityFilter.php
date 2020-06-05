<?php

namespace WGT\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use WGT\Models\Profanity;
use WGT\Models\Profanity\ProfanityLog;

use Auth;

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

    protected static function checkProfanity(Model $model, string $method)
    {
        if (!isset($model->fillable) || empty($model->fillable)) {
            return true;
        }

        $fillable = isset($model->ignoreProfanity) && !empty($model->ignoreProfanity)
            ? array_diff($model->fillable, $model->ignoreProfanity)
            : $model->fillable;

        $tableName = $model->getTable();
        $tableId = isset($model->id) ? $model->id : null;
        $userId = isset(Auth::user()->id) ? Auth::user()->id : null;

        # Please, update the firmId variable as soon as the company's user implementation is ready
        $firmId = isset($model->firm_id) ? $model->firm_id : null;

        $badwords = Profanity::getProfanitiesIgnored([
            'userId' => $userId,
            'firmId' => $firmId
            ])->toArray();

        $badwords = collect($badwords)->pluck('word')->all();

        foreach($fillable as $field) {
            $filteredValue = self::filterProfanity($model->{$field}, $badwords);

            if (!empty($filteredValue)) {
                self::createLog([
                    'user_id' => $userId,
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

    protected static function filterProfanity(
        ?string $fieldValue,
        array $badwords
    ): array
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
        string $field,
        string $fieldValue,
        int $id
    ): void
    {
        $entity::unsetEventDispatcher();
        $model = $entity::find($id);
        $model->{$field} = $fieldValue;
        $model->save();
    }

    protected static function createLog(array $data): void
    {
        $profanityLog = new ProfanityLog($data);
        $profanityLog->class_name = static::class;
        $profanityLog->save();
    }
}
