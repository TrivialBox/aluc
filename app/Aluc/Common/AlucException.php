<?php
namespace Aluc\Common;


class AlucException extends \Exception {
    public $short_message;

    public function __construct($short_message, $description) {
        parent::__construct($description);
        $this->short_message = $short_message;
    }

    public function __toString() {
        return "{$this->short_message}: {$this->message}";
    }
}
