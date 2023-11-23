<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoPessoa
 * 
 * @property int $id
 * @property string|null $tipo
 * 
 * @property Collection|Pessoa[] $pessoas
 *
 * @package App\Models
 */
class TipoPessoa extends Model
{
	protected $table = 'tipo_pessoa';
	public $timestamps = false;

	protected $fillable = [
		'tipo'
	];

	public function pessoas()
	{
		return $this->hasMany(Pessoa::class, 'tipo_pessoa');
	}
}
