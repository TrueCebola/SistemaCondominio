<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lote
 * 
 * @property int $id
 * @property string|null $estado
 * @property int|null $id_pessoa
 * @property int|null $id_lote
 * 
 * @property Condominio|null $condominio
 * @property Pessoa|null $pessoa
 * @property Collection|Movimentacao[] $movimentacaos
 *
 * @package App\Models
 */
class Lote extends Model
{
	protected $table = 'lote';
	public $timestamps = false;

	protected $casts = [
		'id_pessoa' => 'int',
		'id_lote' => 'int'
	];

	protected $fillable = [
		'estado',
		'id_pessoa',
		'id_lote'
	];

	public function condominio()
	{
		return $this->belongsTo(Condominio::class, 'id_lote');
	}

	public function pessoa()
	{
		return $this->belongsTo(Pessoa::class, 'id_pessoa');
	}

	public function movimentacaos()
	{
		return $this->hasMany(Movimentacao::class, 'id_local');
	}
}
