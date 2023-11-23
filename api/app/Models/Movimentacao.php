<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Movimentacao
 * 
 * @property int $id
 * @property int|null $id_portaria
 * @property int|null $id_pessoa
 * @property string|null $tipo_movimentacao
 * @property string|null $observacoes
 * @property int|null $id_veiculo
 * @property int|null $id_autorizacao_agenda
 * @property int|null $id_local
 * 
 * @property AutorizacaoAgenda|null $autorizacao_agenda
 * @property Portarium|null $portarium
 * @property Lote|null $lote
 * @property Pessoa|null $pessoa
 * @property Veiculo|null $veiculo
 *
 * @package App\Models
 */
class Movimentacao extends Model
{
	protected $table = 'movimentacao';
	public $timestamps = false;

	protected $casts = [
		'id_portaria' => 'int',
		'id_pessoa' => 'int',
		'id_veiculo' => 'int',
		'id_autorizacao_agenda' => 'int',
		'id_local' => 'int'
	];

	protected $fillable = [
		'id_portaria',
		'id_pessoa',
		'tipo_movimentacao',
		'observacoes',
		'id_veiculo',
		'id_autorizacao_agenda',
		'id_local'
	];

		public function portarium()
	{
		return $this->belongsTo(Portarium::class, 'id_portaria');
	}

	public function lote()
	{
		return $this->belongsTo(Lote::class, 'id_local');
	}

	public function pessoa()
	{
		return $this->belongsTo(Pessoa::class, 'id_pessoa');
	}

	public function veiculo()
	{
		return $this->belongsTo(Veiculo::class, 'id_veiculo');
	}
}
