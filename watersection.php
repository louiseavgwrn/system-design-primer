<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Usage & Savings Calculator</title>
    <link rel="stylesheet" href="Style/water_section.css">
</head>
<body>

<body>

<main>
    <div class="section-container">

        <button onclick="window.location.href='useracc.php'">Home</button>
        <button onclick="window.location.href='landsection.php'">Land Section</button>
        <button onclick="window.location.href='airsection.php'">Air Section</button>
        <button onclick="window.location.href='lifesection.php'">Living Section</button>

    </div>
</main>

<header>
        <h1>💧 Water Usage & Savings Calculator 💧</h1>
        <p>Track your water consumption and discover ways to conserve water for a better tomorrow.</p>
    </header>

<div class="container">
    <div class="section-box">
        <h2>Why Water Matters</h2>
        <p>Water is one of the most precious resources on Earth. Here’s why we need to protect it:</p>
        <ul>
            <li>Only 1% of Earth's water is available for human use.</li>
            <li>By 2025, half of the world’s population will face water shortages.</li>
            <li>Water scarcity already affects 1.1 billion people globally.</li>
        </ul>
</div>

<div class="section-box">
        <h2>🌱 Smart Water-Saving Tips</h2>
        <p>Small actions can lead to significant water savings. Here are some tips:</p>
        <ul>
            <li>Turn off the tap while brushing your teeth – save up to 8 liters per minute!</li>
            <li>Switch to low-flow water fixtures to conserve water without compromising comfort.</li>
            <li>Use a bucket to wash your car instead of a hose to save up to 500 liters per wash.</li>
            <li>Check for leaks and repair them promptly to avoid wasting hundreds of liters a month.</li>
        </ul>
</div>

<div class="section-box">
        <h2>⚠️ Global Water Challenges</h2>
        <p>Water scarcity is a pressing global issue. Here are some of the key challenges:</p>
        <ul>
            <li><strong>Pollution:</strong> Contamination of water bodies by industrial waste and chemicals.</li>
            <li><strong>Climate Change:</strong> Extreme weather events such as droughts and floods impact water availability.</li>
            <li><strong>Overuse:</strong> Unsustainable agricultural and industrial practices that deplete water resources.</li>
        </ul>
</div>

    <div class="section-box">
        <h2>🌊 Fun Water Facts</h2>
        <div class="fact-box">
            <p>Did you know? It takes 2,700 liters of water to produce just one cotton shirt!</p>
        </div>
        <ul>
            <li>Water regulates Earth's climate and supports all life.</li>
            <li>Only 0.007% of Earth's water is available for human use.</li>
        </ul>
    </div>
</div>
    
<?php
// Start the session to access session variables (e.g., result messages after processing)
session_start();

// Check if there are any water results stored in the session and display them
if (isset($_SESSION['water_results'])) {
    echo $_SESSION['water_results']; // Display the water results message
    unset($_SESSION['water_results']); // Clear the session data for water results after displaying
}
?>

<!-- Form Box: Contains the form for selecting a water usage calculator -->
<div class="form-box">    
    <form action="waterprocess.php" method="POST">
        <label for="calculator_type">Select Calculator:</label>
        <select name="calculator_type" id="calculator_type" required onchange="showCalculatorForm()">
            <option value="">--Select--</option>
            <option value="personal_usage">Personal Water Usage</option>
            <option value="household_usage">Household Water Usage</option>
            <option value="water_consumption_per_person">Water Consumption per Person</option>
            <option value="annual_water_consumption">Annual Water Consumption</option>
            <option value="water_savings_appliances">Water Savings from Water-Efficient Appliances</option>
            <option value="industrial_usage">Industrial Water Usage</option>
            <option value="water_usage_per_unit">Water Usage per Unit of Production (for Industries)</option>
            <option value="agricultural_usage">Agricultural Water Usage</option>
            <option value="evapotranspiration">Evapotranspiration (ET) for Agriculture</option>
            <option value="water_efficiency">Water Efficiency</option>
            <option value="rainwater_harvesting">Rainwater Harvesting Potential</option>
        </select>
        <!-- Container where the specific form for the selected calculator will be shown -->
        <div id="form_container"></div>
    </form>
</div>

<script>
    // Function to dynamically load the correct form based on the selected calculator type
    function showCalculatorForm() {
        const formContainer = document.getElementById("form_container"); // Get the container to display the form
        const calculatorType = document.getElementById("calculator_type").value; // Get the selected calculator type
        formContainer.innerHTML = ""; // Clear the previous form content

        // If no calculator type is selected, exit the function
        if (calculatorType === "") return;

        let formHtml = ''; // Variable to store the HTML form for the selected calculator

        // Based on the selected calculator type, generate the corresponding form
        switch(calculatorType) {
            case "personal_usage":
                // HTML for Personal Water Usage calculator
                formHtml = `
                    <h3>Personal Water Usage</h3>
                    <p><strong>Your Name:</strong> (Enter your name for personalized calculations)</p>
                    <label for="user_name">Your Name:</label>
                    <input type="text" id="user_name" name="user_name" placeholder="Enter your name" required>

                    <p><strong>Daily Water Usage:</strong> (Enter your total water usage per day in your preferred unit)</p>
                    <label for="daily_usage">Enter your daily water usage:</label>
                    <input type="number" id="daily_usage" name="daily_usage" step="any" placeholder="e.g., 100" required>

                    <p><strong>Unit of Measurement:</strong> (Select whether you measure your water usage in liters or gallons)</p>
                    <label for="usage_type">Unit of Measurement:</label>
                    <select id="usage_type" name="usage_type" required>
                        <option value="" disabled selected>Select a unit</option>
                        <option value="liters">Liters</option>
                        <option value="gallons">Gallons</option>
                    </select>

                    <p><strong>Water Savings Target:</strong> (Enter the percentage of water you want to save each day)</p>
                    <label for="reduction_percentage">Target Reduction Percentage (%):</label>
                    <input type="number" id="reduction_percentage" name="reduction_percentage" step="any" min="0" max="100" value="20" required>

                    <button type="submit">Calculate Water Savings</button>
                `;
                break;

            case "household_usage":
                formHtml = `
                    <h3>Household Water Usage</h3>
                    <p><strong>Household Name:</strong> (Enter the name of your household for personalized results)</p>
                    <label for="household_name">Household Name:</label>
                    <input type="text" id="household_name" name="household_name" placeholder="e.g., Smith Household" required>

                    <p><strong>Daily Water Usage:</strong> (Enter your total household water usage per day)</p>
                    <label for="household_daily_usage">Enter daily household water usage:</label>
                    <input type="number" id="household_daily_usage" name="household_daily_usage" step="any" placeholder="e.g., 150" required>

                    <p><strong>Unit of Measurement:</strong> (Select the unit you use for measuring household water)</p>
                    <label for="household_usage_type">Unit of Measurement:</label>
                    <select id="household_usage_type" name="household_usage_type" required>
                        <option value="" disabled selected>Select a unit</option>
                        <option value="liters">Liters</option>
                        <option value="gallons">Gallons</option>
                        <option value="quarts">Quarts</option>
                        <option value="pints">Pints</option>
                    </select>

                    <p><strong>Water Savings Target:</strong> (Enter the percentage of water you want to save each day)</p>
                    <label for="reduction_percentage">Target Reduction Percentage (%):</label>
                    <input type="number" id="reduction_percentage" name="reduction_percentage" step="any" min="0" max="100" value="25" required>

                    <button type="submit">Calculate Water Savings</button>
                `;
                break;

        case "water_consumption_per_person":
    formHtml = `
       <h3>Water Consumption per Person</h3>

<p><strong>Total Water Usage:</strong> (Enter the total water used for the household or group for a given period, e.g., daily or monthly)</p>
<label for="total_water_usage">Total Water Usage:</label>
<input type="number" id="total_water_usage" name="total_water_usage" step="any" placeholder="e.g., 1000" required>

<p><strong>Unit of Measurement:</strong> (Choose the unit used for water measurement)</p>
<label for="unit">Unit of Measurement:</label>
<select id="unit" name="unit" required>
    <option value="" disabled selected>Select a unit</option>
    <option value="liters">Liters</option>
    <option value="gallons">Gallons</option>
</select>

<p><strong>Number of People:</strong> (Enter the total number of people sharing the water usage)</p>
<label for="number_of_people">Number of People:</label>
<input type="number" id="number_of_people" name="number_of_people" placeholder="e.g., 4" required min="1">

<button type="submit">Calculate Water Consumption per Person</button>

    `;
    break;

case "annual_water_consumption":
    formHtml = `
       <h3>Annual Water Consumption</h3>

<p><strong>Daily Water Usage:</strong> (Enter the amount of water consumed daily, e.g., for a household or an individual)</p>
<label for="daily_water_usage">Daily Water Usage:</label>
<input type="number" id="daily_water_usage" name="daily_water_usage" step="any" placeholder="e.g., 100" required>

<p><strong>Unit of Measurement:</strong> (Choose the unit used for measuring water usage)</p>
<label for="unit">Unit of Measurement:</label>
<select id="unit" name="unit" required>
    <option value="" disabled selected>Select a unit</option>
    <option value="liters">Liters</option>
    <option value="gallons">Gallons</option>
</select>

<button type="submit">Calculate Annual Water Consumption</button>

    `;
    break;

case "water_savings_appliances":
    formHtml = `
       <h3>Water Savings from Water-Efficient Appliances</h3>

<p><strong>Old Water Usage:</strong> (Enter the water usage of your appliance before upgrading to a more efficient one)</p>
<label for="old_water_usage">Old Water Usage:</label>
<input type="number" id="old_water_usage" name="old_water_usage" step="any" placeholder="e.g., 100" required>

<p><strong>New Water Usage:</strong> (Enter the water usage of your appliance after upgrading)</p>
<label for="new_water_usage">New Water Usage:</label>
<input type="number" id="new_water_usage" name="new_water_usage" step="any" placeholder="e.g., 50" required>

<p><strong>Unit of Measurement:</strong> (Select the unit you use to measure water)</p>
<label for="unit">Unit of Measurement:</label>
<select id="unit" name="unit" required>
    <option value="" disabled selected>Select a unit</option>
    <option value="liters">Liters</option>
    <option value="gallons">Gallons</option>
</select>

<p><strong>Usage Frequency:</strong> (How often does the appliance use water? Enter the frequency in times per day, week, or month)</p>
<label for="usage_frequency">Usage Frequency:</label>
<input type="number" id="usage_frequency" name="usage_frequency" required placeholder="e.g., 5 times per day">

<button type="submit">Calculate Water Savings</button>

    `;
    break;

case "industrial_usage":
    formHtml = `
         <h3>Industrial Water Usage</h3>
        <label for="company_name">Company Name:</label>
        <input type="text" id="company_name" name="company_name" placeholder="Enter company name" required>
        
        <label for="industrial_usage">Enter daily industrial water usage:</label>
        <input type="number" id="industrial_usage" name="industrial_usage" step="any" placeholder="e.g., 1500" required>
        
        <label for="industrial_usage_type">Unit of Measurement:</label>
        <select id="industrial_usage_type" name="industrial_usage_type" required>
            <option value="cubic_meters">Cubic Meters</option>
            <option value="gallons">Gallons</option>
            <option value="acre_feet">Acre-feet</option>
        </select>
        
        <input type="submit" value="Calculate Industrial Savings">
    `;
    break;

case "water_usage_per_unit":
    formHtml = `
 <h3>Water Usage per Unit of Production</h3>
        <p>Calculate the amount of water used for each unit of your production process.</p>

        <label for="total_water_usage_industry">Total Water Usage:</label>
        <input type="number" id="total_water_usage_industry" name="total_water_usage_industry" step="any" placeholder="Enter total water used in your industry" required>
        
        <label for="unit">Unit of Measurement:</label>
        <select id="unit" name="unit" required>
            <option value="liters">Liters</option>
            <option value="gallons">Gallons</option>
        </select>
        
        <label for="units_produced">Units Produced:</label>
        <input type="number" id="units_produced" name="units_produced" placeholder="Enter total units produced" required>
        
        <input type="submit" value="Calculate Water Usage per Unit">
    `;
    break;

case "agricultural_usage":
    formHtml = `
       <h3>Agricultural Water Usage</h3>
        <p><strong>Farm Name:</strong> (Enter the name of your farm for personalized calculations)</p>
        
        <label for="farm_name">Farm Name:</label>
        <input type="text" id="farm_name" name="farm_name" placeholder="Enter farm name" required>

        <p><strong>Daily Agricultural Water Usage:</strong> (Enter the total amount of water your farm uses per day in one of the available units)</p>
        
        <label for="agricultural_usage">Enter daily agricultural water usage:</label>
        <input type="number" id="agricultural_usage" name="agricultural_usage" step="any" placeholder="e.g. 1000" required>

        <p><strong>Unit of Measurement:</strong> (Choose the unit in which your daily usage is measured)</p>
        
        <label for="agricultural_usage_type">Unit of Measurement:</label>
        <select id="agricultural_usage_type" name="agricultural_usage_type" required>
            <option value="acre_feet">Acre-feet</option>
            <option value="cubic_meters">Cubic Meters</option>
            <option value="gallons">Gallons</option>
        </select>

        <p><strong>Target Reduction Percentage:</strong> (Enter the percentage of water usage you plan to reduce)</p>
        
        <label for="reduction_percentage">Reduction Percentage (%):</label>
        <input type="number" id="reduction_percentage" name="reduction_percentage" step="any" min="0" max="100" placeholder="e.g. 20" required>

        <input type="submit" value="Calculate Agricultural Water Savings">

    `;
    break;

case "evapotranspiration":
    formHtml = `
       <h3>Evapotranspiration (ET) for Agriculture</h3>

<p><strong>Soil Evaporation:</strong> (Enter the rate of soil evaporation in mm/day, which refers to the amount of water lost from the soil surface due to evaporation)</p>
<label for="soil_evaporation">Soil Evaporation (mm/day):</label>
<input type="number" id="soil_evaporation" name="soil_evaporation" step="any" required>

<p><strong>Plant Transpiration:</strong> (Enter the rate of plant transpiration in mm/day, which refers to the water loss from plants due to evaporation from plant tissues)</p>
<label for="plant_transpiration">Plant Transpiration (mm/day):</label>
<input type="number" id="plant_transpiration" name="plant_transpiration" step="any" required>

<p><strong>Field Area:</strong> (Enter the area of the field in hectares, as evapotranspiration is calculated for the total area)</p>
<label for="field_area">Field Area (hectares):</label>
<input type="number" id="field_area" name="field_area" step="any" required>

<p><strong>Crop Type:</strong> (Optional, specify the type of crop for personalized evapotranspiration calculation)</p>
<label for="crop_name">Crop Name:</label>
<input type="text" id="crop_name" name="crop_name" required>

<input type="submit" value="Calculate Evapotranspiration">

    `;
    break;

case "water_efficiency":
    formHtml = `
        <h3>Water Efficiency</h3>

<p><strong>Output:</strong> (Enter the useful production or services generated using water, such as the number of products, crops, or services delivered)</p>
<label for="output">Output (useful production or services):</label>
<input type="number" id="output" name="output" step="any" required>

<p><strong>Water Usage:</strong> (Enter the total water usage in either liters or gallons that was required to produce the output above)</p>
<label for="water_usage_efficiency">Water Usage (in liters or gallons):</label>
<input type="number" id="water_usage_efficiency" name="water_usage_efficiency" step="any" required>

<label for="unit">Unit of Measurement:</label>
<select id="unit" name="unit" required>
    <option value="liters">Liters</option>
    <option value="gallons">Gallons</option>
</select>

<p><strong>Old Water Efficiency:</strong> (If applicable, enter the previous water efficiency percentage for comparison)</p>
<label for="old_efficiency">Old Water Efficiency (%):</label>
<input type="number" id="old_efficiency" name="old_efficiency" step="any" min="0" max="100">

<p><strong>New Water Efficiency:</strong> (Enter the new water efficiency percentage to see the improvement)</p>
<label for="new_efficiency">New Water Efficiency (%):</label>
<input type="number" id="new_efficiency" name="new_efficiency" step="any" min="0" max="100">

<input type="submit" value="Calculate Water Efficiency">

    `;
    break;

    case "rainwater_harvesting":
    formHtml = `
        <h3>Rainwater Harvesting Potential</h3>

<label for="catchment_area">Catchment Area:</label>
<input type="number" id="catchment_area" name="catchment_area" required>

<label for="catchment_area_unit">Unit:</label>
<select id="catchment_area_unit" name="catchment_area_unit" required>
    <option value="meters">Square Meters (m²)</option>
    <option value="feet">Square Feet (ft²)</option>
</select>

<label for="rainfall">Rainfall (in mm):</label>
<input type="number" id="rainfall" name="rainfall" step="any" required>

<label for="runoff_coefficient">Runoff Coefficient (0 to 1):</label>
<select id="runoff_coefficient" name="runoff_coefficient" required>
    <option value="0.1">0.1 (low permeability)</option>
    <option value="0.3">0.3 (medium permeability)</option>
    <option value="0.5">0.5 (high permeability)</option>
    <option value="0.7">0.7 (impermeable surface)</option>
</select>

<label for="region_type">Region Type:</label>
<select id="region_type" name="region_type" required>
    <option value="tropical">Tropical (high rainfall)</option>
    <option value="arid">Arid (low rainfall)</option>
    <option value="temperate">Temperate (moderate rainfall)</option>
</select>

<input type="submit" value="Calculate Rainwater Harvesting Potential">

    `;
    break;

}

        formContainer.innerHTML = formHtml;
    }
</script>

    <footer>
        <p>💧 Every drop counts. Together, we can make a difference.💧</p>
    </footer>

</body>
</html>


