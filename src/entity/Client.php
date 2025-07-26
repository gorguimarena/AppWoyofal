<?php
namespace Woyofal\Entity;
 
class Client {
    public function __construct(
        public string $nom,
        public string $prenom
    ) {}
}