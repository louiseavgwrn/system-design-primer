<?php
// Define the Animal class to represent different animal characteristics
class Animal {
    // Private properties for the animal's characteristics
    private $name;         // Name of the animal
    private $sound;        // Sound made by the animal
    private $fact;         // A fun or interesting fact about the animal
    private $image;        // URL or file path of the animal's image
    private $description;  // A brief description of the animal

    // Constructor to initialize the animal object with values
    public function __construct($name, $sound, $fact, $image, $description) {
        $this->name = $name;               // Set the animal's name
        $this->sound = $sound;             // Set the sound the animal makes
        $this->fact = $fact;               // Set the interesting fact about the animal
        $this->image = $image;             // Set the image URL/path of the animal
        $this->description = $description; // Set the description of the animal
    }

    // Getter method to retrieve the animal's name
    public function getName() {
        return $this->name;  // Return the name of the animal
    }

    // Getter method to retrieve the sound made by the animal
    public function getSound() {
        return $this->sound;  // Return the sound the animal makes
    }

    // Getter method to retrieve an interesting fact about the animal
    public function getFact() {
        return $this->fact;  // Return the fact about the animal
    }

    // Getter method to retrieve the animal's image
    public function getImage() {
        return $this->image;  // Return the image URL or path
    }

    // Getter method to retrieve the animal's description
    public function getDescription() {
        return $this->description;  // Return the description of the animal
    }
}
?>
