<?php

namespace DevNoKage;

use DevNoKage\Abstract\AbstractEntity;

class Response extends AbstractEntity
{


    public function __construct(
        protected string $message,
        protected ?array $data,
        protected int $code,
        protected Statut $status = Statut::ERROR,

    ) {}


    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'status' => $this->status,
            'code' => $this->code,
            'message' => $this->message,
        ];
    }
    public static function toObject(array $data): static
    {
        return new static('', null, 404);
    }
}
