<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Correio
 * 
 * @property int $id
 * @property int|null $id_portaria
 * @property int|null $id_pessoa
 * @property string|null $tipo_encomenda
 * @property string|null $observacoes
 * @property bool|null $active
 * 
 * @property Portarium|null $portarium
 * @property Pessoa|null $pessoa
 *
 * @package App\Models
 */
class Correio extends Model
{
	protected $table = 'correio';
	public $timestamps = false;

	protected $casts = [
		'id_portaria' => 'int',
		'id_pessoa' => 'int',
		'active' => 'bool'
	];

	protected $fillable = [
		'id_portaria',
		'id_pessoa',
		'tipo_encomenda',
		'observacoes',
		'active'
	];

	public function portarium()
	{
		return $this->belongsTo(Portarium::class, 'id_portaria');
	}

	public function pessoa()
	{
		return $this->belongsTo(Pessoa::class, 'id_pessoa');
	}
}
