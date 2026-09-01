<?php
/**
 * R.E.D.i Planner field options. Source: "R.E.D.i_Web Form Inputs For Dev.xlsx" (2026-07-11).
 *
 * The market list is the final list from the Excel, deduped. Quebec, Calgary,
 * Edmonton and Montreal appear at both province/region and city level in the
 * sheet, and tier labels for those are still pending. The category list is the
 * WIP sheet. Durations and budget minimum are stubs awaiting confirmation.
 *
 * @package rdm-rsm-parent
 */

return array(

	'markets' => array(
		// National / broad
		'Canada', 'Canada Excl. Quebec', 'Atlantic',
		// Provinces & territories
		'British Columbia', 'Alberta', 'Saskatchewan', 'Manitoba', 'Ontario', 'Quebec',
		'New Brunswick', 'Nova Scotia', 'Prince Edward Island', 'Newfoundland & Labrador',
		// Markets
		'Abbotsford - Mission', 'Alma', 'Amos', 'Baie-Comeau', 'Barrie', 'Bathurst',
		'Belleville - Quinte West', 'Brandon', 'Brantford', 'Brockville', 'Brooks',
		'Calgary', 'Campbell River', 'Campbellton', 'Camrose', 'Canmore', 'Cape Breton',
		'Centre Wellington', 'Charlottetown', 'Chatham-Kent', 'Chilliwack', 'Cobourg',
		'Collingwood', 'Corner Brook', 'Cornwall', 'Courtenay', 'Cowansville', 'Cranbrook',
		'Dawson Creek', 'Dolbeau-Mistassini', 'Drummondville', 'Duncan', 'Edmonton',
		'Edmundston', 'Elliot Lake', 'Essa', 'Estevan', 'Fort McMurray', 'Fort St. John',
		'Fredericton', 'Gander', 'Granby', 'Grand Falls-Windsor', 'Grande Prairie',
		'Greater Sudbury / Grand Sudbury', 'Guelph', 'Halifax', 'Hamilton', 'Hawkesbury',
		'High River', 'Ingersoll', 'Joliette', 'Kamloops', 'Kawartha Lakes', 'Kelowna',
		'Kenora', 'Kentville', 'Kingston', 'Kitchener - Cambridge - Waterloo', 'Lachute',
		'Lacombe', 'Ladysmith', 'Lethbridge', 'Lloydminster', 'London', 'Matane',
		'Medicine Hat', 'Midland', 'Miramichi', 'Moncton', 'Montreal', 'Moose Jaw',
		'Nanaimo', 'Nelson', 'New Glasgow', 'Norfolk', 'North Battleford', 'North Bay',
		'Okotoks', 'Orillia', 'Oshawa', 'Ottawa - Gatineau', 'Owen Sound', 'Parksville',
		'Pembroke', 'Penticton', 'Petawawa', 'Peterborough', 'Port Alberni', 'Port Hope',
		'Portage la Prairie', 'Powell River', 'Prince Albert', 'Prince George',
		'Prince Rupert', 'Quebec City', 'Quesnel', 'Red Deer', 'Regina', 'Rimouski',
		'Riviere-du-Loup', 'Rouyn-Noranda', 'Saguenay', 'Saint John', 'Saint-Georges',
		'Saint-Hyacinthe', 'Sainte-Agathe-des-Monts', 'Sainte-Marie',
		'Salaberry-de-Valleyfield', 'Salmon Arm', 'Sarnia', 'Saskatoon',
		'Sault Ste. Marie', 'Sept-Iles', 'Shawinigan', 'Sherbrooke', 'Smith Falls',
		'Sorel-Tracy', 'Squamish', 'St. Catharines - Niagara', "St. John's",
		'Steinbach', 'Stratford', 'Strathmore', 'Summerside', 'Swift Current',
		'Sylvan Lake', 'Terrace', 'Thetford Mines', 'Thompson', 'Thunder Bay',
		'Tillsonburg', 'Timmins', 'Toronto', 'Trail', 'Trois-Rivieres', 'Truro',
		"Val-d'Or", 'Vancouver', 'Vernon', 'Victoria', 'Victoriaville', 'Wasaga Beach',
		'Wetaskiwin', 'Weyburn', 'Whitehorse', 'Williams Lake', 'Windsor', 'Winkler',
		'Winnipeg', 'Wood Buffalo', 'Woodstock', 'Yellowknife', 'Yorkton',
	),

	'platforms' => array( 'Linear TV', 'Streaming TV', 'Radio', 'Podcast' ),

	'media_content' => array( 'Sports', 'News & Entertainment', 'Both' ),

	// Stub values. The increments are still to be confirmed (1 to 12 vs these).
	'durations' => array( 2, 4, 6, 8, 13, 26, 52 ),

	// From the WIP sheet. Client-facing labels are still pending.
	'categories' => array(
		'Advertising', 'Alcohol', 'Apparel & Jewellery', 'Automotive - Products',
		'Automotive - Service', "Children's Products", 'Electronics', 'Finance - Banking',
		'Finance - Insurance', 'Finance - Investments', 'Food - Beverages',
		'Food - Snacks & Confectionery', 'Grocery', 'Household - Appliances & Furnishings',
		'Household - Products', 'Loyalty Programs', 'Personal Care', 'Pets',
		'Psychographics', 'Restaurants', 'Retailers', 'Sports & Leisure', 'Travel',
	),

	// Stub value pending final CPM work.
	'budget_min' => 5000,
);
