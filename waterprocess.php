<?php
// Start the session to access session variables (e.g., result messages after processing)
session_start();

// Function to determine the unit time based on the usage frequency
function getUnitTime($usageFrequency) {
    // If usage is less than or equal to 7, it's considered a "day"
    if ($usageFrequency <= 7) {
        return "day";
    } 
    // If usage is between 8 and 30, it's considered a "week"
    elseif ($usageFrequency <= 30) {
        return "week";
    } 
    // Otherwise, it's considered a "month"
    else {
        return "month";
    }
}

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected calculator type from the form
    $calculatorType = $_POST['calculator_type'];

    // Start output buffering to capture the output
    ob_start();

    // Switch statement to handle different calculator types
    switch ($calculatorType) {
        case 'personal_usage':
            
            if (isset($_POST['user_name']) && isset($_POST['daily_usage']) && isset($_POST['usage_type']) && isset($_POST['reduction_percentage'])) {
                
                $userName = htmlspecialchars($_POST['user_name']);
                $dailyUsage = floatval($_POST['daily_usage']);
                $usageType = $_POST['usage_type'];
                $reductionPercentage = floatval($_POST['reduction_percentage']);
                
                $conversionFactor = ($usageType == 'gallons') ? 3.78541 : 1;
     
                $usageInLiters = $dailyUsage * $conversionFactor;
            
                $savingsInLiters = $usageInLiters * ($reductionPercentage / 100);
                $remainingUsageInLiters = $usageInLiters - $savingsInLiters;
          
                $savingsInPreferredUnit = $savingsInLiters / $conversionFactor;
                $remainingUsageInPreferredUnit = $remainingUsageInLiters / $conversionFactor;
                
                echo "<h3>Water Usage Results for $userName</h3>";
                echo "<p>Your daily water usage is: " . number_format($dailyUsage, 2) . " $usageType.</p>";
                echo "<p>By reducing your usage by $reductionPercentage%, you could save approximately " . 
                     number_format($savingsInPreferredUnit, 2) . " $usageType per day.</p>";
                echo "<p>Your adjusted daily usage would be " . 
                     number_format($remainingUsageInPreferredUnit, 2) . " $usageType.</p>";
            } else {
                
                echo "<p>Error: Missing required fields.</p>";
            }
            break;
        
        case 'household_usage':
            
            if (isset($_POST['household_name']) && isset($_POST['household_daily_usage']) && isset($_POST['household_usage_type']) && isset($_POST['reduction_percentage'])) {
               
                $householdName = htmlspecialchars($_POST['household_name']);
                $householdDailyUsage = floatval($_POST['household_daily_usage']);
                $usageType = $_POST['household_usage_type'];
                $reductionPercentage = floatval($_POST['reduction_percentage']);
                
              
                $conversionFactors = [
                    'liters' => 1,
                    'gallons' => 3.78541,
                    'quarts' => 0.946353,
                    'pints' => 0.473176
                ];
                
                
                if (array_key_exists($usageType, $conversionFactors)) {
                    $usageInLiters = $householdDailyUsage * $conversionFactors[$usageType];
                } else {
               
                    echo "<p>Invalid unit of measurement selected.</p>";
                    exit;
                }
        
                $savingsInLiters = $usageInLiters * ($reductionPercentage / 100);
                $remainingUsageInLiters = $usageInLiters - $savingsInLiters;
          
                $savingsInPreferredUnit = $savingsInLiters / $conversionFactors[$usageType];
                $remainingUsageInPreferredUnit = $remainingUsageInLiters / $conversionFactors[$usageType];
              
                echo "<h3>Household Water Usage Results for $householdName</h3>";
                echo "<p>Your daily household water usage is: " . number_format($householdDailyUsage, 2) . " $usageType.</p>";
                echo "<p>By reducing your usage by $reductionPercentage%, your household could save approximately " . 
                     number_format($savingsInPreferredUnit, 2) . " $usageType per day.</p>";
                echo "<p>Your adjusted daily household usage would be " . 
                     number_format($remainingUsageInPreferredUnit, 2) . " $usageType.</p>";
            } else {
                echo "<p>Error: Missing required fields.</p>";
            }
            break;
            

            case 'water_consumption_per_person':
                if (isset($_POST['total_water_usage']) && isset($_POST['unit']) && isset($_POST['number_of_people'])) {
                    $totalWaterUsage = floatval($_POST['total_water_usage']);
                    $unit = $_POST['unit'];
                    $numberOfPeople = intval($_POST['number_of_people']);
                    
                    if ($totalWaterUsage <= 0) {
                        echo "<p>Please enter a valid total water usage greater than zero.</p>";
                        exit;
                    }
            
                    if ($numberOfPeople <= 0) {
                        echo "<p>Please enter a valid number of people greater than zero.</p>";
                        exit;
                    }
            
                    $waterConsumptionPerPerson = $totalWaterUsage / $numberOfPeople;
            
                    echo "<h3>Water Consumption per Person</h3>";
                    echo "<p>Total water usage: " . number_format($totalWaterUsage, 2) . " " . htmlspecialchars($unit) . "</p>";
                    echo "<p>Number of people: " . number_format($numberOfPeople, 0) . "</p>";
                    echo "<p>Water consumption per person: " . number_format($waterConsumptionPerPerson, 2) . " " . htmlspecialchars($unit) . "</p>";
            
                    if ($waterConsumptionPerPerson > 1000) {
                        echo "<p><strong>Note:</strong> The calculated water consumption per person seems high. Please check if the total usage and number of people are accurate for the period selected.</p>";
                    }
                } else {
                    echo "<p>Error: Missing required fields. Please ensure all fields are filled out correctly.</p>";
                }
                break;
            
            case 'annual_water_consumption':
                if (isset($_POST['daily_water_usage']) && isset($_POST['unit'])) {
                    $dailyWaterUsage = floatval($_POST['daily_water_usage']);
                    $unit = $_POST['unit'];
                    
                    if ($dailyWaterUsage <= 0) {
                        echo "<p>Please enter a valid daily water usage greater than zero.</p>";
                        exit;
                    }
            
                    $annualWaterConsumption = $dailyWaterUsage * 365;
            
                    echo "<h3>Annual Water Consumption</h3>";
                    echo "<p>Your daily water usage: " . number_format($dailyWaterUsage, 2) . " " . htmlspecialchars($unit) . "</p>";
                    echo "<p><strong>Annual water consumption:</strong> " . number_format($annualWaterConsumption, 2) . " " . htmlspecialchars($unit) . "</p>";
            
                    if ($annualWaterConsumption > 1000000) {
                        echo "<p><strong>Note:</strong> Your annual water consumption seems very high. Please verify if your daily usage is correct.</p>";
                    } elseif ($annualWaterConsumption < 1000) {
                        echo "<p><strong>Note:</strong> Your annual water consumption seems quite low. Please check if the daily usage is entered accurately.</p>";
                    }
                } else {
                    echo "<p>Error: Missing required fields. Please make sure all fields are filled out correctly.</p>";
                }
                break;
            
                    

                case 'water_savings_appliances':
                    if (isset($_POST['old_water_usage'], $_POST['new_water_usage'], $_POST['usage_frequency'], $_POST['unit'])) {
                        $oldWaterUsage = floatval($_POST['old_water_usage']);
                        $newWaterUsage = floatval($_POST['new_water_usage']);
                        $unit = $_POST['unit'];
                        $usageFrequency = intval($_POST['usage_frequency']);
                        
                        if ($oldWaterUsage <= 0 || $newWaterUsage <= 0 || $usageFrequency <= 0) {
                            echo "<p>Please enter valid positive numbers for all fields.</p>";
                            exit;
                        }
                        
                        $waterSavings = ($oldWaterUsage - $newWaterUsage) * $usageFrequency;
                        
                        echo "<h3>Water Savings from Water-Efficient Appliances</h3>";
                        echo "<p>Your old water usage: " . number_format($oldWaterUsage, 2) . " " . htmlspecialchars($unit) . "</p>";
                        echo "<p>Your new water usage: " . number_format($newWaterUsage, 2) . " " . htmlspecialchars($unit) . "</p>";
                        echo "<p>Usage frequency: $usageFrequency times</p>";
                        echo "<p><strong>Total water savings:</strong> " . number_format($waterSavings, 2) . " " . htmlspecialchars($unit) . " per " . getUnitTime($usageFrequency) . "</p>";
                        
                        if ($waterSavings > 1000) {
                            echo "<p><strong>Great job!</strong> Your savings are significant, which contributes positively to water conservation.</p>";
                        } elseif ($waterSavings < 50) {
                            echo "<p><strong>Note:</strong> Your savings seem small. Please double-check your inputs and the frequency of use.</p>";
                        }
                    } else {
                        echo "<p>Error: Missing required fields. Please fill in all the fields.</p>";
                    }
                    break;
                
                case 'industrial_usage':
                    $companyName = htmlspecialchars($_POST['company_name']);
                    $industrialUsage = floatval($_POST['industrial_usage']);
                    $usageType = $_POST['industrial_usage_type'];
                    
                    if ($industrialUsage <= 0) {
                        echo "<p>Please enter a valid industrial water usage greater than zero.</p>";
                        exit;
                    }
                    
                    $reductionPercentage = 10;
                    $savingsInUsage = $industrialUsage * ($reductionPercentage / 100);
                    $remainingUsage = $industrialUsage - $savingsInUsage;
                    
                    $message = "";
                    if ($savingsInUsage > 500) {
                        $message = "<p><strong>Excellent!</strong> You are making a significant impact with your water savings.</p>";
                    } elseif ($savingsInUsage <= 50) {
                        $message = "<p><strong>Consider optimizing further.</strong> Review processes and check for any unnecessary water usage.</p>";
                    }
                    
                    echo "<h3>Industrial Water Usage Results for $companyName</h3>";
                    echo "<p>Your daily industrial water usage: " . number_format($industrialUsage, 2) . " $usageType</p>";
                    echo "<p>By reducing your usage by $reductionPercentage%, you could save approximately " . number_format($savingsInUsage, 2) . " $usageType per day.</p>";
                    echo "<p>Your adjusted daily water usage would be " . number_format($remainingUsage, 2) . " $usageType.</p>";
                    echo $message;
                    break;
                

                    case 'water_usage_per_unit':
                        $totalWaterUsage = floatval($_POST['total_water_usage_industry']);
                        $unit = $_POST['unit'];
                        $unitsProduced = intval($_POST['units_produced']);
                        
                        if ($totalWaterUsage <= 0 || $unitsProduced <= 0) {
                            echo "<p>Please enter valid positive numbers for both total water usage and units produced.</p>";
                            exit;
                        }
                        
                        $waterUsagePerUnit = $totalWaterUsage / $unitsProduced;
                        
                        $message = "";
                        if ($waterUsagePerUnit > 10) {
                            $message = "<p><strong>Consider reviewing your process:</strong> Your water usage per unit is relatively high. Implementing water-saving measures might improve efficiency.</p>";
                        } elseif ($waterUsagePerUnit < 1) {
                            $message = "<p><strong>Great efficiency!</strong> Your water usage per unit is low. Keep up the good work in optimizing water usage.</p>";
                        }
                        
                        echo "<h3>Water Usage per Unit of Production</h3>";
                        echo "<p>Total water usage: " . number_format($totalWaterUsage, 2) . " " . htmlspecialchars($unit) . "</p>";
                        echo "<p>Units produced: " . number_format($unitsProduced, 0) . "</p>";
                        echo "<p>Water usage per unit: " . number_format($waterUsagePerUnit, 2) . " " . htmlspecialchars($unit) . " per unit</p>";
                        echo $message;
                        break;
                    
                    case 'agricultural_usage':
                        if (isset($_POST['farm_name'], $_POST['agricultural_usage'], $_POST['agricultural_usage_type'], $_POST['reduction_percentage'])) {
                            $farmName = htmlspecialchars($_POST['farm_name']);
                            $agriculturalUsage = floatval($_POST['agricultural_usage']);
                            $usageType = $_POST['agricultural_usage_type'];
                            $reductionPercentage = floatval($_POST['reduction_percentage']);
                            
                            if ($reductionPercentage < 0 || $reductionPercentage > 100) {
                                echo "<p>Error: Please enter a reduction percentage between 0 and 100.</p>";
                                exit;
                            }
                        
                            $waterSavings = $agriculturalUsage * ($reductionPercentage / 100);
                            $remainingUsage = $agriculturalUsage - $waterSavings;
                            
                            echo "<h3>Agricultural Water Usage Results for $farmName</h3>";
                            echo "<p>Your current daily agricultural water usage is: " . number_format($agriculturalUsage, 2) . " $usageType.</p>";
                            echo "<p>By reducing your usage by $reductionPercentage%, you could save approximately " . number_format($waterSavings, 2) . " $usageType per day.</p>";
                            echo "<p>Your adjusted daily agricultural water usage would be " . number_format($remainingUsage, 2) . " $usageType.</p>";
                        
                            if ($waterSavings > 1000) {
                                echo "<p><strong>Suggestion:</strong> Your savings are significant! Consider investing in water-efficient irrigation systems to reduce costs further and increase sustainability.</p>";
                            }
                        } else {
                            echo "<p>Error: Missing required fields. Please fill out all the form fields.</p>";
                        }
                        break;
                    
                                    
            

                        case "evapotranspiration":
                            if (isset($_POST['soil_evaporation']) && isset($_POST['plant_transpiration']) && isset($_POST['field_area']) && isset($_POST['crop_name'])) {
                                $soilEvaporation = floatval($_POST['soil_evaporation']);
                                $plantTranspiration = floatval($_POST['plant_transpiration']);
                                $fieldArea = floatval($_POST['field_area']);
                                $cropName = htmlspecialchars($_POST['crop_name']);
                                
                                $totalEvapotranspiration = $soilEvaporation + $plantTranspiration;
                                $fieldEvapotranspiration = $totalEvapotranspiration * $fieldArea;
                                
                                echo "<h3>Evapotranspiration (ET) Calculation for $cropName</h3>";
                                echo "<p><strong>Soil Evaporation:</strong> " . number_format($soilEvaporation, 2) . " mm/day</p>";
                                echo "<p><strong>Plant Transpiration:</strong> " . number_format($plantTranspiration, 2) . " mm/day</p>";
                                echo "<p><strong>Total Evapotranspiration Rate:</strong> " . number_format($totalEvapotranspiration, 2) . " mm/day</p>";
                                echo "<p><strong>Field Area:</strong> " . number_format($fieldArea, 2) . " hectares</p>";
                                echo "<p><strong>Total Evapotranspiration for the Field:</strong> " . number_format($fieldEvapotranspiration, 2) . " mm/day</p>";
                            } else {
                                echo "<p>Error: Missing required fields.</p>";
                            }
                            break;
                        
                        case "water_efficiency":
                            if (isset($_POST['output']) && isset($_POST['water_usage_efficiency']) && isset($_POST['unit'])) {
                                $output = floatval($_POST['output']);
                                $waterUsageEfficiency = floatval($_POST['water_usage_efficiency']);
                                $unit = $_POST['unit']; 
                                
                                if ($waterUsageEfficiency != 0) {
                                    $waterEfficiency = $output / $waterUsageEfficiency;
                                } else {
                                    $waterEfficiency = 0;
                                }
                                
                                if (isset($_POST['old_efficiency']) && isset($_POST['new_efficiency'])) {
                                    $oldEfficiency = floatval($_POST['old_efficiency']);
                                    $newEfficiency = floatval($_POST['new_efficiency']);
                                    $efficiencySavings = $oldEfficiency - $newEfficiency;
                                } else {
                                    $efficiencySavings = null;
                                }
                                
                                echo "<h3>Water Efficiency Calculation</h3>";
                                echo "<p>Output: " . number_format($output, 2) . " " . ($unit == 'gallons' ? 'gallons' : 'liters') . "</p>";
                                echo "<p>Water usage efficiency: " . number_format($waterUsageEfficiency, 2) . " " . ($unit == 'gallons' ? 'gallons' : 'liters') . "</p>";
                                echo "<p>Water efficiency: " . number_format($waterEfficiency, 2) . " units per " . ($unit == 'gallons' ? 'gallon' : 'liter') . "</p>";
                                
                                if ($efficiencySavings !== null) {
                                    echo "<p>Efficiency savings: " . number_format($efficiencySavings, 2) . "%</p>";
                                }
                            } else {
                                echo "<p>Error: Missing required fields.</p>";
                            }
                            break;
                        
            

            case "rainwater_harvesting":
               
                if (isset($_POST['catchment_area']) && isset($_POST['catchment_area_unit']) && isset($_POST['rainfall']) && isset($_POST['runoff_coefficient'])) {
                    
               
                    $catchmentArea = floatval($_POST['catchment_area']);
                    $rainfall = floatval($_POST['rainfall']);
                    $runoffCoefficient = floatval($_POST['runoff_coefficient']);
                    $areaUnit = $_POST['catchment_area_unit']; 
                    $regionType = $_POST['region_type']; 
                    
                    
                    if ($areaUnit == 'feet') {
                        $catchmentArea = $catchmentArea * 0.092903; 
                    }
            
                    
                    $rainwaterHarvested = $catchmentArea * $rainfall * $runoffCoefficient;
            
                    
                    echo "<h3>Rainwater Harvesting Potential</h3>";
                    echo "<p>Catchment area: " . number_format($catchmentArea, 2) . " square meters</p>";
                    echo "<p>Annual rainfall: " . number_format($rainfall, 2) . " mm</p>";
                    echo "<p>Runoff coefficient: " . number_format($runoffCoefficient, 2) . "</p>";
                    echo "<p>Region type: " . htmlspecialchars($regionType) . "</p>"; 
                    echo "<p>Total rainwater harvested: " . number_format($rainwaterHarvested, 2) . " liters</p>";
                } else {
                    echo "<p>Error: Missing required fields.</p>";
                }
                break;
            
            

            

        default:
            echo "<p>Invalid calculator type selected.</p>";
            break;
    }
    $calculationResult = ob_get_clean(); 
    $_SESSION['water_results'] = $calculationResult;
    header("Location: watersection.php");
    exit();
} else {
    echo "<p>No data submitted. Please fill out the form.</p>";
}
?>
