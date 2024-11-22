<?php
  // Example dynamic data for biodiversity and conservation
  $endangeredSpecies = 5000;  // Example number of endangered species
  $activeConservationEfforts = 1200;  // Example number of active conservation projects
  $humanImpactLevel = "Critical";  // Example level of human impact on the environment
  $sustainableAgricultureStats = "25% of global food production is organic"; // Placeholder data
  $wildlifeConservationPrograms = 200;  // Example number of active wildlife programs
  $communityInitiatives = 75;  // Example number of community initiatives worldwide
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Living - Biodiversity, Ecosystems, and Conservation</title>

</head>
<body>
  <header>
    <h1>Living in Harmony with Nature</h1>
    <p>Explore the importance of biodiversity, sustainable practices, and conservation efforts.</p>
  </header>

  <section>
    <!-- Biodiversity Section -->
    <div class="content">
      <h2>Biodiversity: Protecting Our Planet's Living Network</h2>
      <p>Biodiversity includes all living organisms—plants, animals, fungi, and microorganisms—each playing a crucial role in maintaining ecosystem balance. From pollinators to decomposers, every organism contributes to the health of our planet.</p>
      <p>Currently, there are <span class="stat"><?php echo $endangeredSpecies; ?></span> endangered species. Global conservation efforts are underway, with <span class="stat"><?php echo $activeConservationEfforts; ?></span> active projects dedicated to protecting these species.</p>
    </div>

    <!-- Human-Nature Connection Section -->
    <div class="content">
      <h2>Human-Nature Connection: The Impact of Our Actions</h2>
      <p>Our connection to nature is deeply rooted in our well-being. However, human activities such as deforestation, pollution, and climate change have a significant impact on ecosystems. The balance between human progress and environmental preservation is delicate, and sustainable practices are essential for a thriving planet.</p>
      <p>Currently, human impact on nature is at a <span class="highlight"><?php echo $humanImpactLevel; ?></span> level. But small actions—such as reducing waste, planting trees, or supporting eco-friendly products—can make a difference.</p>
    </div>

    <!-- Sustainable Agriculture Section -->
    <div class="content">
      <h2>Sustainable Agriculture: Growing the Future</h2>
      <p>Sustainable farming practices, including organic farming and permaculture, are key to reducing environmental harm while ensuring food security. These practices conserve water, promote soil health, and reduce reliance on chemical fertilizers and pesticides.</p>
      <p>Did you know? <span class="stat"><?php echo $sustainableAgricultureStats; ?></span> is dedicated to organic farming worldwide, supporting healthier ecosystems and communities.</p>
    </div>

    <!-- Wildlife Conservation Section -->
    <div class="content">
      <h2>Wildlife Conservation: Protecting Our Wildlife</h2>
      <p>Conserving wildlife and protecting natural habitats is critical to maintaining biodiversity. Efforts to prevent species extinction and preserve habitats are crucial for the survival of many species.</p>
      <p>There are currently <span class="stat"><?php echo $wildlifeConservationPrograms; ?></span> active wildlife conservation programs worldwide, each working to protect endangered species and their habitats.</p>
    </div>

    <!-- Community Initiatives Section -->
    <div class="content">
      <h2>Community Initiatives: Local Actions for Global Change</h2>
      <p>Communities around the world are taking action to preserve their natural environments. Initiatives such as urban tree planting, green spaces, and local environmental projects are vital for creating sustainable cities and improving quality of life.</p>
      <p>Over <span class="stat"><?php echo $communityInitiatives; ?></span> community-driven initiatives are active worldwide, empowering people to take part in preserving the environment and making a lasting impact.</p>
    </div>
  </section>
</body>
</html>
