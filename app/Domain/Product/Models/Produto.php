<?php

namespace Domain\Product\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    public const ID_EXTERNO = 'id_externo';
    public const FORNECEDOR_ID = 'fornecedor_id';
    public const NOME = 'nome';
    public const DESCRICAO = 'descricao';
    public const CATEGORIA = 'categoria';
    public const TEM_DESCONTO = 'temDesconto';
    public const DESCONTO = 'desconto';
    public const PRECO = 'preco';
    public const IMAGENS = 'imagens';
    public const MATERIAL = 'material';
    public const DEPARTAMENTO = 'departamento';
    public const ADJETIVO = 'adjetivo';

    protected $fillable = [
        self::ID_EXTERNO,
        self::FORNECEDOR_ID,
        self::NOME,
        self::DESCRICAO,
        self::CATEGORIA,
        self::TEM_DESCONTO,
        self::DESCONTO,
        self::PRECO,
        self::IMAGENS,
        self::MATERIAL,
        self::DEPARTAMENTO,
        self::ADJETIVO,
    ];


}
