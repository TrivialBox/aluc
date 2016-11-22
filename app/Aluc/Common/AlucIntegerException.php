<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 22/11/16
 * Time: 2:00
 */

namespace Aluc\Common;


class AlucIntegerException extends \Exception {
    public $short_message;

    public function __construct($short_message, $description) {
        parent::__construct($description);
        $this->short_message = $short_message;
    }

    public function __toString() {
        return "{$this->short_message}: {$this->message}";
    }

}