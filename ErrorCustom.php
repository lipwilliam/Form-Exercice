<?php

declare(strict_types=1);

class ErrorCustom {
    private array $errors; //cf ligne 22-23 de index.php

    public function __construct() {
        $this->errors = [];
    }

    public function add(string $error): void {
        array_push($this->errors, $error); //array_push fonction php (https://www.php.net/manual/fr/function.array-push.php)
    } //on push dans le tableau $this->errrors, les valeurs $error

    public function getAll(): array {
        return $this->errors;
    }

    public function reset(): void {
        $this->errors = []; //on vide le array $this->errors 
    }

    public function dump(string $title, array $data) {
        echo $title;
        echo '<br>';
        echo '<pre>'; //<pre> permet d'avoir une certaine mise en page, utilisé uniquement dans le but de faciliter la lecture du var_dump ou print_r
        print_r($data); //équivalent de var_dump
        echo '</pre>';
    }
}
