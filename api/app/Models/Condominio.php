<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Condominio
 * 
 * @property int $id
 * @property int|null $lote_numero
 * @property string|null $quadra
 * 
 * @property Collection|Lote[] $lotes
 *
 * @package App\Models
 */
class Condominio extends Model
{
	protected $table = 'condominio';
	public $timestamps = false;

	protected $casts = [
		'lote_numero' => 'int'
	];

	protected $fillable = [
		'lote_numero',
		'quadra'
	];

	public function lotes()
	{
		return $this->hasMany(Lote::class, 'id_lote');
	}
}
