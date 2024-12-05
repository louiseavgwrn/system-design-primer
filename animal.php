<?php
class Animal {
    private $name;
    private $sound;
    private $fact;
    private $image;
    private $description;

    public function __construct($name, $sound, $fact, $image, $description) {
        $this->name = $name;
        $this->sound = $sound;
        $this->fact = $fact;
        $this->image = $image;
        $this->description = $description;
    }

    public function getName() {
        return $this->name;
    }

    public function getSound() {
        return $this->sound;
    }

    public function getFact() {
        return $this->fact;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }
}
?>
