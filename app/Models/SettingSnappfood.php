<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SettingSnappfood
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $icon
 * @property string|null $twitter
 * @property string|null $instagram
 * @property string|null $youtube
 * @property string|null $telegram
 * @property string|null $aparat
 * @property string|null $linkin
 * @property string|null $owner
 * @property string|null $officeNumber
 * @property string|null $symbols
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood query()
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereAparat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereLinkin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereOfficeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereSymbols($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereTelegram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingSnappfood whereYoutube($value)
 * @mixin \Eloquent
 */
class SettingSnappfood extends Model
{
    use HasFactory;

    protected $table = "settingsnappfoods";
}
