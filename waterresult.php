<?php
if (isset($_GET['user_name'])) {
    $user_name = $_GET['user_name'];
    echo "<h1>Oops, $user_name, you're using more water than you should!</h1>";
    echo "<p>Your daily water usage exceeds the recommended amount. This is a good opportunity to consider how we can all make small changes to conserve this precious resource. Here are some practical tips and insights:</p>";
    
    echo "<h2>Simple Ways to Reduce Your Water Usage:</h2>";
    echo "<ul>
            <li><strong>Fix Leaks Immediately:</strong> A single leaky faucet can waste more than 3,000 gallons of water per year! Check for leaks around your home and repair them promptly.</li>
            <li><strong>Install Water-Efficient Fixtures:</strong> Switch to low-flow showerheads, faucets, and toilets. These can reduce your water usage by up to 50% without compromising performance.</li>
            <li><strong>Take Shorter Showers:</strong> Cutting just 2 minutes off your shower time can save you up to 5 gallons of water per shower.</li>
            <li><strong>Turn Off the Tap:</strong> Don’t leave the tap running while brushing your teeth, washing your hands, or scrubbing dishes. It’s a small change that adds up!</li>
            <li><strong>Use Full Loads for Laundry and Dishes:</strong> Only run the washing machine or dishwasher when they’re full to maximize water efficiency.</li>
            <li><strong>Water Your Garden Smartly:</strong> Water your plants in the early morning or late evening to reduce water loss through evaporation. Consider using a drip irrigation system to deliver water directly to the plant roots.</li>
            <li><strong>Use a Rain Barrel:</strong> Collect rainwater for gardening or outdoor use. It's a free, natural water source that can help reduce your reliance on mains water.</li>
            <li><strong>Use Water-Efficient Appliances:</strong> When it's time to replace appliances, look for those with the WaterSense label to ensure they are water-efficient.</li>
            <li><strong>Rethink Your Yard:</strong> Consider xeriscaping—landscaping that reduces or eliminates the need for supplemental water. Choose native plants that thrive in your local climate.</li>
            <li><strong>Educate Family and Friends:</strong> Encourage others in your household and community to join the effort in saving water.</li>
          </ul>";

    echo "<h2>Why Should You Care About Saving Water?</h2>";
    echo "<p>Excessive water usage is not just bad for your wallet—it also has a significant impact on the environment. Here’s why:</p>";
    echo "<ul>
            <li><strong>Rising Water Bills:</strong> The more water you use, the higher your water bills will be. By reducing your usage, you can save money and allocate it to other important needs.</li>
            <li><strong>Environmental Depletion:</strong> Water scarcity is a growing issue globally. Overuse of water sources can lead to depletion of rivers, lakes, and underground aquifers. This affects not just humans but wildlife and ecosystems.</li>
            <li><strong>Energy Consumption:</strong> It takes energy to pump, treat, and transport water to your home. By using less water, you reduce the energy required to provide it, helping to lower your carbon footprint.</li>
            <li><strong>Impacts on Agriculture:</strong> Agriculture is a major consumer of water. Excessive water consumption can affect the availability of water for farming, leading to food shortages and price increases.</li>
            <li><strong>Climate Change:</strong> Water shortages are exacerbated by climate change. By conserving water now, we can help mitigate the effects of extreme weather events such as droughts and floods.</li>
            <li><strong>Community Responsibility:</strong> Saving water helps ensure that everyone has enough for their daily needs. It’s a collective effort to make sure our communities thrive for generations to come.</li>
          </ul>";

    echo "<h2>Join the Movement!</h2>";
    echo "<p>Making a small change in your water habits can have a big impact. Every drop counts, and your efforts will contribute to a more sustainable future. Start today, and let’s work together to protect our planet's most valuable resource—water!</p>";
    
    echo "<h3>Fun Fact:</h3>";
    echo "<p>Did you know? The average person uses about 80-100 gallons of water per day! This includes everything from showering to cooking, washing, and flushing. Imagine how much water we could save if everyone used just 10% less.</p>";

    echo "<p><em>Let’s make water conservation a part of our daily lives. Together, we can make a big difference!</em></p>";
}
?>
