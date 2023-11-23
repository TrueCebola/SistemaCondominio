<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacaoAgenda
 * 
 * @property int $id
 * @property int|null $id_pessoa_autoriza
 * @property int|null $id_pessoa_entrada
 * @property string|null $observacao
 * @property string|null $hora_data
 * @property string|null $tipo_autorizacao_agenda
 * @property int|null $id_veiculo
 * @property int|null $id_portaria
 * 
 * @property Pessoa|null $pessoa
 * @property Portarium|null $portarium
 * @property Veiculo|null $veiculo
 * @property Collection|Movimentacao[] $movimentacaos
 *
 * @package App\Models
 */
class AutorizacaoAgenda extends Model
{
	protected $table = 'autorizacao_agenda';
	public $timestamps = false;

	protected $casts = [
		'id_pessoa_autoriza' => 'int',
		'id_pessoa_entrada' => 'int',
		'id_veiculo' => 'int',
		'id_portaria' => 'int'
	];

	protected $fillable = [
		'id_pessoa_autoriza',
		'id_pessoa_entrada',
		'observacao',
		'hora_data',
		'tipo_autorizacao_agenda',
		'id_veiculo',
		'id_portaria'
	];

	public function pessoa()
	{
		return $this->belongsTo(Pessoa::class, 'id_pessoa_entrada');
	}

	public function portarium()
	{
		return $this->belongsTo(Portarium::class, 'id_portaria');
	}

	public function veiculo()
	{
		return $this->belongsTo(Veiculo::class, 'id_veiculo');
	}

	public function movimentacaos()
	{
		return $this->hasMany(Movimentacao::class, 'id_autorizacao_agenda');
	}
}
