<?php

namespace WGT\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use WGT\Models\Firm;
use WGT\Models\Profanity;
use WGT\Models\Profanity\ProfanityLog;

use Auth;

trait ProfanityFilter
{
    /**
     * @return void
     */
    public static function bootProfanityFilter()
    {
        self::observerCreated();
        self::observerSaved();
        self::observerUpdated();
    }

    /**
     * @return void
     */
    protected static function observerCreated()
    {
        static::created(function (Model $model) {
            self::checkReplaceProfanity($model, 'create');
        });
    }

    /**
     * @return void
     */
    protected static function observerSaved()
    {
        static::saved(function (Model $model) {
            self::checkReplaceProfanity($model, 'save');
        });
    }

    /**
     * @return void
     */
    protected static function observerUpdated()
    {
        static::updated(function (Model $model) {
            self::checkReplaceProfanity($model, 'update');
        });
    }

    /**
     * @param Modal $model
     * @param string $method
     * @return void
     */
    protected static function checkReplaceProfanity(Model $model, string $method): void
    {
        if (!isset($model->fillable) || empty($model->fillable)) {
            return;
        }

        if (isset($model->profanityFields) && !empty($model->profanityFields)) {
            $fillable = $model->profanityFields;
        } else {
            $fillable = isset($model->ignoreProfanity) && !empty($model->ignoreProfanity)
                ? array_diff($model->fillable, $model->ignoreProfanity)
                : $model->fillable;
        }

        $tableName = $model->getTable();
        $tableId = isset($model->id) ? $model->id : null;
        $userId = isset(Auth::user()->id) ? Auth::user()->id : null;
        $network = null;

        # Please, update the firmId variable as soon as the company's user implementation is ready
        $firmId = isset($model->firm_id) ? $model->firm_id : null;
        if (!empty($firmId)) {
            $firm = Firm::find($firmId);
            $network = $firm->type;
        }

        $filterIgnoreOffensiveWords = [
            ['user_ignored_id' => $userId, 'firm_ignored_id' => null, 'network_ignored_id' => null],
            ['user_ignored_id' => null, 'firm_ignored_id' => $firmId, 'network_ignored_id' => null],
            ['user_ignored_id' => null, 'firm_ignored_id' => null, 'network_ignored_id' => $network],
            ['user_ignored_id' => $userId, 'firm_ignored_id' => $firmId, 'network_ignored_id' => null],
            ['user_ignored_id' => $userId, 'firm_ignored_id' => null, 'network_ignored_id' => $network],
            ['user_ignored_id' => null, 'firm_ignored_id' => $firmId, 'network_ignored_id' => $network],
            ['user_ignored_id' => $userId, 'firm_ignored_id' => $firmId, 'network_ignored_id' => $network]
        ];

        $badwords = Profanity::getProfanitiesIgnored($filterIgnoreOffensiveWords)
            ->get()
            ->toArray();

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

    /**
     * @param string|null $fieldValue
     * @param string $badwords
     * @return array
     */
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

    /**
     * @param Modal $entity
     * @param string $field
     * @param string $fieldValue
     * @param int $id
     * @return void
     */
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

    /**
     * @param array $data
     * @return void
     */
    protected static function createLog(array $data): void
    {
        $profanityLog = new ProfanityLog($data);
        $profanityLog->class_name = static::class;
        $profanityLog->save();
    }
}
