<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Veiculo
 * 
 * @property int $id
 * @property int|null $id_pessoa
 * @property string|null $placa
 * @property string|null $marca
 * @property string|null $modelo
 * @property string|null $ano
 * @property string|null $cor
 * 
 * @property Pessoa|null $pessoa
 * @property Collection|AutorizacaoAgenda[] $autorizacao_agendas
 * @property Collection|Movimentacao[] $movimentacaos
 *
 * @package App\Models
 */
class Veiculo extends Model
{
	protected $table = 'veiculo';
	public $timestamps = false;

	protected $casts = [
		'id_pessoa' => 'int'
	];

	protected $fillable = [
		'id_pessoa',
		'placa',
		'marca',
		'modelo',
		'ano',
		'cor'
	];

	public function pessoa()
	{
		return $this->belongsTo(Pessoa::class, 'id_pessoa');
	}

	public function autorizacao_agendas()
	{
		return $this->hasMany(AutorizacaoAgenda::class, 'id_veiculo');
	}

	public function movimentacaos()
	{
		return $this->hasMany(Movimentacao::class, 'id_veiculo');
	}
}
