<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pessoa
 * 
 * @property int $id
 * @property string $nome
 * @property string|null $telefone
 * @property string|null $email
 * @property string|null $cpf_cnpj
 * @property string|null $rua
 * @property string|null $cidade
 * @property string|null $estado
 * @property string|null $cep
 * @property string|null $pais
 * @property int|null $tipo_pessoa
 * @property bool|null $active
 * 
 * @property Collection|AutorizacaoAgenda[] $autorizacao_agendas
 * @property Collection|Correio[] $correios
 * @property Collection|Lote[] $lotes
 * @property Collection|Movimentacao[] $movimentacaos
 * @property Collection|Portarium[] $portaria
 * @property Collection|Veiculo[] $veiculos
 *
 * @package App\Models
 */
class Pessoa extends Model
{
	protected $table = 'pessoa';
	public $timestamps = false;

	protected $casts = [
		'tipo_pessoa' => 'int',
		'active' => 'bool'
	];

	protected $fillable = [
		'nome',
		'telefone',
		'email',
		'cpf_cnpj',
		'rua',
		'cidade',
		'estado',
		'cep',
		'pais',
		'tipo_pessoa',
		'active'
	];

	public function tipo_pessoa()
	{
		return $this->belongsTo(TipoPessoa::class, 'tipo_pessoa');
	}

	public function autorizacao_agendas()
	{
		return $this->hasMany(AutorizacaoAgenda::class, 'id_pessoa_entrada');
	}

	public function correios()
	{
		return $this->hasMany(Correio::class, 'id_pessoa');
	}

	public function lotes()
	{
		return $this->hasMany(Lote::class, 'id_pessoa');
	}

	public function movimentacaos()
	{
		return $this->hasMany(Movimentacao::class, 'id_pessoa');
	}

	public function portaria()
	{
		return $this->hasMany(Portarium::class, 'id_pessoa_funcionario');
	}

	public function veiculos()
	{
		return $this->hasMany(Veiculo::class, 'id_pessoa');
	}
}
