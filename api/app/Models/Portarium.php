<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Portarium
 * 
 * @property int $id
 * @property string|null $portaria_nome
 * @property int|null $id_pessoa_funcionario
 * @property string|null $turno_trabalho
 * @property bool|null $active
 * 
 * @property Pessoa|null $pessoa
 * @property Collection|AutorizacaoAgenda[] $autorizacao_agendas
 * @property Collection|Correio[] $correios
 * @property Collection|Movimentacao[] $movimentacaos
 *
 * @package App\Models
 */
class Portarium extends Model
{
	protected $table = 'portaria';
	public $timestamps = false;

	protected $casts = [
		'id_pessoa_funcionario' => 'int',
		'active' => 'bool'
	];

	protected $fillable = [
		'portaria_nome',
		'id_pessoa_funcionario',
		'turno_trabalho',
		'active'
	];

	public function pessoa()
	{
		return $this->belongsTo(Pessoa::class, 'id_pessoa_funcionario');
	}

	public function autorizacao_agendas()
	{
		return $this->hasMany(AutorizacaoAgenda::class, 'id_portaria');
	}

	public function correios()
	{
		return $this->hasMany(Correio::class, 'id_portaria');
	}

	public function movimentacaos()
	{
		return $this->hasMany(Movimentacao::class, 'id_portaria');
	}
}
