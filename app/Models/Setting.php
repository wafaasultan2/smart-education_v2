<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Settings
 *
 * @package App\Models
 * @property int $id
 * @property string $key
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'value'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the value of a setting by key.
     *
     * @param string $key
     * @param mixed $default
     * @return string|null
     */
    public static function getValue(string $key, $default = null): ?string
    {
        return self::where('key', $key)->value('value') ?? $default;
    }

    /**
     * set the value of a setting by key.
     *
     * @param string $key
     * @param string $value
     * @return bool
     */
    public static function setValue(string $key, string $value): bool
    {
        return self::updateOrCreate(['key' => $key], ['value' => $value])->wasRecentlyCreated;
    }

    /**
     * Get the value of a setting as a JSON object if it is a JSON string.
     *
     * @param string $key
     * @return mixed
     */
    public static function getJsonValue(string $key)
    {
        $value = self::getValue($key);
        $json = json_decode($value, true);
        return (json_last_error() === JSON_ERROR_NONE) ? $json : $value;
    }
}
