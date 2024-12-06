<?php
// Include the Animal class file
include_once 'animal.php';

class Game {
    // Private property to hold an array of Animal objects
    private $animals;

    // Constructor to initialize the $animals array with Animal objects
    public function __construct() {
        $this->animals = [
            new Animal('Loon', 'Loon.mp3', 'The loon is known for its eerie, haunting calls which can be heard echoing across northern lakes.', 'loon.jpg', 'Loons are large water birds found in North America.'),
            new Animal('Dove', 'Dove.mp3', 'Doves are symbols of peace and love in many cultures worldwide.', 'dove.jpg', 'Doves are small to medium-sized birds, often associated with calm and peaceful symbolism.'),
            new Animal('Bear', 'Bear.mp3', 'Bears are incredibly strong and can run at speeds up to 30 miles per hour!', 'bear.jpg', 'Bears are large mammals found in forests and other environments, known for their strength and intelligence.'),
            new Animal('Whale', 'Whale.mp3', 'Whales are the largest animals on Earth, with the blue whale growing up to 100 feet long.', 'whale.jpg', 'Whales are marine mammals that are known for their size and intelligence, living in oceans around the world.'),
            new Animal('Moose', 'Moose.mp3', 'Moose are the largest members of the deer family, with huge antlers that can span over six feet.', 'moose.jpg', 'Moose are large herbivores found in forests and cold regions, often spotted in Canada and Northern Europe.'),
            new Animal('Hyena', 'Hyena.mp3', 'Hyenas are known for their laugh-like calls, which they use to communicate with each other.', 'hyena.jpg', 'Hyenas are carnivores known for their scavenging habits, often found in Africa and parts of Asia.'),
            new Animal('Wolf', 'Wolf.mp3', 'Wolves live in packs and communicate through a variety of vocalizations, including howls.', 'wolf.jpg', 'Wolves are carnivorous mammals known for their social structures and wide distribution across the globe.'),
            new Animal('Jaguar', 'Jaguar.mp3', 'Jaguars are the largest cats in the Americas and are known for their powerful jaws.', 'jaguar.jpg', 'Jaguars are native to Central and South America, known for their agility and strength.'),
            new Animal('Owl', 'Owl.mp3', 'Owls are nocturnal hunters, with exceptional hearing and sight in low light.', 'owl.jpg', 'Owls are birds of prey, often associated with wisdom and found in forests, deserts, and even urban areas.'),
            new Animal('Fox', 'Fox.mp3', 'Foxes are highly adaptable animals and can live in a variety of habitats, including urban areas.', 'fox.jpg', 'Foxes are small carnivorous mammals known for their cunning nature and bushy tails.'),
            new Animal('Alligator', 'Alligator.mp3', 'Alligators can live up to 35-50 years in the wild and are known for their powerful jaws.', 'alligator.jpg', 'Alligators are large reptiles found in freshwater habitats, especially in the southeastern United States.'),
            new Animal('Eagle', 'Eagle.mp3', 'Eagles have extraordinary eyesight and can spot prey from over two miles away.', 'eagle.jpg', 'Eagles are large birds of prey, admired for their strength and sharp eyesight.'),
            new Animal('Elephant', 'Elephant.mp3', 'Elephants are known for their intelligence and emotional depth, with a memory that is said to last a lifetime.', 'elephant.jpg', 'Elephants are the largest land mammals, found in Asia and Africa, famous for their trunks and tusks.'),
            new Animal('Lion', 'Lion.mp3', 'Lions are the only cats that live in groups, known as prides.', 'lion.jpg', 'Lions are large carnivores native to Africa, often called the "king of the jungle" for their regal appearance.')
        ];
    }

    // Method to return a random animal object from the $animals array
    public function getRandomAnimal() {
        return $this->animals[array_rand($this->animals)];  // Selects a random index from the $animals array
    }

    // Method to check if the user's guess matches the animal name based on the sound
    public function checkGuess($userGuess, $sound) {
        // Loop through all animals to find a match with the sound
        foreach ($this->animals as $animal) {
            if (strtolower($animal->getSound()) === strtolower($sound)) {  // Case-insensitive comparison of sound
                // If sound matches, check if the guess matches the animal name
                return strtolower($userGuess) === strtolower($animal->getName());
            }
        }
        return false;  // Return false if no match is found
    }

    // Method to retrieve animal information based on the sound
    public function getAnimalInfo($sound) {
        foreach ($this->animals as $animal) {
            // Check if the sound matches and return the corresponding Animal object
            if ($animal->getSound() === $sound) {
                return $animal;
            }
        }
        return null;  // Return null if no matching sound is found
    }
}
?>
