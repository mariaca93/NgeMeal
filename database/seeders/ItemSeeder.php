<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item')->insert([
            [
                'cuisine_id' => 1,
                'subcuisine_id' => 1,
                'item_name' => "Beef Burger",
                'image' => 'beef-burger-1.jpg',
                'weather_id' => '1',
                'addons_id' => '1,5,6',
                'slug' => 'beef-burger',
                'item_type' => 2,
                'has_variation' => 2,
                'price' => '16000',
                'item_description' => '1. Heat the olive oil in a frying pan, add the onion and cook for 5 minutes until softened and starting to turn golden. Set aside.
                <br/>2. In a bowl, combine the beef mince with the herbs and the egg. Season, add the onions and mix well. Using your hands, shape into 4 patties.
                <br/>3. Cook the burgers on a preheated barbecue or griddle for 5-6 minutes on each side. While the second side is cooking, lay a slice of cheese on top to melt slightly (if using).
                <br/>4. Meanwhile, lightly toast the cut-sides of the buns on the barbecue. Fill with the lettuce, burgers and tomato slices. Serve with ketchup, if you like.',
                'preparation_time' => '20',
                'is_featured' => 1
            ],
            [
                'cuisine_id' => 1,
                'subcuisine_id' => 1,
                'item_name' => "Chicken Burger",
                'image' => 'chicken-burger-1.jpg',
                'weather_id' => '1',
                'addons_id' => '1,4,7',
                'slug' => 'chicken-burger',
                'item_type' => 2,
                'has_variation' => 2,
                'price' => '12000',
                'item_description' => '1. In a medium bowl, add ground chicken, breadcrumbs, mayonnaise, onions, parsley, garlic, paprika, salt and pepper. Use your hands to combine all the ingredients together until blended, but don’t over mix.
                <br/>2. Preheat grill to medium-high heat and oil the grates.
                <br/>3. Form the mixture into 4-6 equal patties. Press down in the middle of each patty with your thumb to ensure even cooking of the chicken burgers.
                <br/>4. Cook the chicken burgers on the preheated grill until the internal temperature is 165F, about 10 minutes total, flipping halfway through.
                <br/>5. Assemble the chicken burgers with hamburger buns and toppings of choice.',
                'preparation_time' => '18',
                'is_featured' => 1
            ],
            [
                'cuisine_id' => 1,
                'subcuisine_id' => 1,
                'item_name' => "Black Bean Burger",
                'image' => 'black-bean-burger-1.jpg',
                'weather_id' => '1',
                'addons_id' => '1,2,5',
                'slug' => 'black-bean-burger',
                'item_type' => 1,
                'has_variation' => 2,
                'price' => '10000',
                'item_description' => '1. Preheat an outdoor grill for high heat. Lightly oil a sheet of aluminum foil with cooking spray.
                <br/>2. Mash black beans in a medium bowl with a fork until thick and pasty.
                <br/>3. Finely chop bell pepper, onion, and garlic in a food processor. Stir chopped vegetables into mashed beans.
                <br/>4. tir together egg, chili powder, cumin, and chili sauce in a small bowl. Add to the mashed beans and stir to combine. Mix in bread crumbs until the mixture is sticky and holds together. Divide the mixture into four patties and place on the prepared foil.
                <br/>5. Grill on the preheated grill for about 8 minutes on each side.',
                'preparation_time' => '20',
                'is_featured' => 1
            ],
            [
                'cuisine_id' => 1,
                'subcuisine_id' => 2,
                'item_name' => "Fried Chicken",
                'image' => 'fried-chicken-1.jpg',
                'weather_id' => '1',
                'addons_id' => '1,2,4',
                'slug' => 'fried-chicken',
                'item_type' => 2,
                'has_variation' => 2,
                'price' => '15000',
                'item_description' => '1. In a large shallow dish, combine 2-2/3 cups flour, garlic salt, paprika, 2-1/2 teaspoons pepper and poultry seasoning. 
                <br/>2. In another shallow dish, beat eggs and 1-1/2 cups water; add salt and the remaining 1-1/3 cups flour and 1/2 teaspoon pepper. 
                <br/>3. Dip chicken in egg mixture, then place in flour mixture, a few pieces at a time. Turn to coat.
                <br/>4. In a deep-fat fryer, heat oil to 375°. Fry chicken, several pieces at a time, until chicken is golden brown and juices run clear, 7-8 minutes on each side. Drain on paper towels.',
                'preparation_time' => '15',
                'is_featured' => 1
            ],
            [
                'cuisine_id' => 1,
                'subcuisine_id' => 2,
                'item_name' => "Chicken Noodle Soup",
                'image' => 'chicken-noodle-soup-1.jpg',
                'weather_id' => '2',
                'addons_id' => '1,2,4',
                'slug' => 'chicken-noodle-soup',
                'item_type' => 2,
                'has_variation' => 2,
                'price' => '13000',
                'item_description' => '1. Melt butter in a large pot or Dutch oven over medium heat. Add the onions, carrots, and celery. Cook, stirring every few minutes until the vegetables begin to soften; 5 to 6 minutes.
                <br/>2. Stir in the garlic, bay leaves, and thyme. Cook, while stirring the garlic around the pan, for about 1 minute.
                <br/>3. Pour in the chicken stock and bring to a low simmer. Taste the soup then adjust the seasoning with salt and pepper. Depending on the stock used, you might need to add 1 or more teaspoons of salt.
                <br/>4. Submerge the chicken thighs into the soup so that the broth covers them. Bring the soup back to a low simmer then partially cover the pot with a lid and cook, stirring a few times until the chicken thighs are cooked through; about 20 minutes.
                <br/>5. If, during this time, the broth seems low, add a splash more stock or a bit of water. Turn the heat to medium-low.
                <br/>6. Transfer the cooked chicken to a plate. Stir the noodles into the soup and cook until done, 6 to 10 minutes depending on the type of noodles used.
                <br/>7. While the noodles cook, shred the chicken into strips or dice into cubes. Slide the chicken back into the pot and then taste the soup once more for seasoning. Adjust with more salt and pepper, as needed. Stir in the parsley and serve.',
                'preparation_time' => '15',
                'is_featured' => 1
            ],
            [
                'cuisine_id' => 1,
                'subcuisine_id' => 2,
                'item_name' => 'Chicken Pot Pie',
                'image' => 'chicken-pot-pie-1.jpg',
                'weather_id' => '2',
                'addons_id' => '1,2,4',
                'slug' => 'chicken-pot-pie',
                'item_type' => 2,
                'has_variation' => 2,
                'price' => '15000',
                'item_description' => '1. Preheat the oven to 425 degrees F (220 degrees C.)
                <br/>2. Combine chicken, carrots, peas, and celery in a saucepan; add water to cover and bring to a boil. Boil for 15 minutes, then remove from the heat and drain.
                <br/>3. While the chicken is cooking, melt butter in another saucepan over medium heat. Add onion and cook until soft and translucent, 5 to 7 minutes. Stir in flour, salt, pepper, and celery seed. Slowly stir in chicken broth and milk. Reduce heat to medium-low and simmer until thick, 5 to 10 minutes. Remove from heat and set aside.
                <br/>4. Place chicken and vegetables in the bottom pie crust. Pour hot liquid mixture over top. Cover with top crust, seal the edges, and cut away any excess dough. Make several small slits in the top crust to allow steam to escape.
                <br/>5. Bake in the preheated oven until pastry is golden brown and filling is bubbly, 30 to 35 minutes. Cool for 10 minutes before serving.',
                'preparation_time' => '25',
                'is_featured' => 1
            ],
            [
                'cuisine_id' => 2,
                'subcuisine_id' => 1,
                'item_name' => 'Dan Dan Mian',
                'image' => 'dan-dan-mian-1.jpeg',
                'weather_id' => '1',
                'addons_id' => '2,3',
                'slug' => 'dan-dan-mian',
                'item_type' => 2,
                'has_variation' => 2,
                'price' => '18000',
                'item_description' => '1. Whisk the sesame paste and light soy sauce together in a bowl until fully incorporated. Add the Chinkiang vinegar. Continue stirring until mixed. Then mix in the garlic, green onion, honey, and Sichuan peppercorns.
                <br/>2. Heat the oil in a large nonstick skillet over medium-high heat until hot. Add the pork. Cook and stir until the surface is lightly browned.
                <br/>3. Turn to medium heat. Add the ginger, green onion, fermented black beans, Sui Mi Ya Cai, cooking wine, and sugar. Cook and chop the pork into small pieces, until all the liquid has evaporated and the pork turns a dark brown color. Transfer to a bowl and set aside.
                <br/>4. Cook the noodles according to instructions.
                <br/>5. Briefly blanch the leafy green vegetables, drain, and set aside.
                <br/>6. To assemble the noodle bowls
                <br/>7. For each noodle bowl, add 1/4 cup of noodle sauce. Add the chili oil according to your taste. Add some noodles, then top with a few spoonfuls of the cooked pork and green veggies. Garnish with peanut crumbles and chopped green onion. Sprinkle with a pinch of toasted ground Sichuan peppercorn, if you like the numbing taste.',
                'preparation_time' => '28',
                'is_featured' => 1
            ],
            [
                'cuisine_id' => 2,
                'subcuisine_id' => 1,
                'item_name' => 'Chow Mein',
                'image' => 'chow-mein-1.jpg',
                'weather_id' => '1',
                'addons_id' => '2,3,9',
                'slug' => 'chow-mein',
                'item_type' => 1,
                'has_variation' => 2,
                'price' => '15000',
                'item_description' => '1. In a small mixing bowl, use a whisk to combine oyster sauce, granulated sugar, sesame oil, soy sauce, chicken broth and cornstarch. Set aside.
                <br/>2. Cook your noodles according to package instructions then drain, rinse with cold water and set aside.
                <br/>3. Heat a large wok or pan with olive oil over medium-heat. Cut your chicken breasts into bite-sized strips and cook them in the oil until golden brown. Remove strips and set aside.
                <br/>4. Add carrots, cabbage and pressed garlic and saute for a few minutes until veggies are slightly softened and the cabbage is a bit translucent.
                <br/>5. Add chicken and noodles back into the pan. Pour sauce over the top and continue cooking all the ingredients together for another 2 minutes.
                <br/>6. Garnish your chow mein with chopped green onions and serve the noodles straight from the pan and piping hot!',
                'preparation_time' => '15',
                'is_featured' => 1
            ],
            [
                'cuisine_id' => 2,
                'subcuisine_id' => 1,
                'item_name' => 'Chinese Mee Hoon',
                'image' => 'mee-hoon-1.jpg',
                'weather_id' => '2',
                'addons_id' => '2,3,10',
                'slug' => 'mee-hoon',
                'item_type' => 1,
                'has_variation' => 2,
                'price' => '16000',
                'item_description' => '1. Place Broth ingredients in a saucepan over high heat. Place lid on, bring to simmer then reduce to medium and simmer for 8 – 10 minutes to allow the flavours to infuse.
                <br/>2. Meanwhile, cook noodles according to packet directions.
                <br/>3. Cut bok choys in half (for small / medium) or quarter (for large). Wash thoroughly.
                <br/>4. Either cook the bok choi in the broth in the soup broth OR noodle cooking water for 1 min (if noodles required boiling).
                <br/>5. Pick garlic and ginger out of soup.
                <br/>6. Place noodles in bowls. Top with chicken and bok choy. Ladle over soup, garnish with green onions. Great served with chilli paste or fresh chillis.',
                'preparation_time' => '15',
                'is_featured' => 1
            ],
            [
                'cuisine_id' => 4,
                'subcuisine_id' => 4,
                'item_name' => 'Indonesian Fried Rice',
                'image' => 'fried-rice-1.jpg',
                'weather_id' => '1',
                'addons_id' => '1,2',
                'slug' => 'ind-fried-rice',
                'item_type' => 1,
                'has_variation' => 2,
                'price' => '12000',
                'item_description' => '1. Heat oil in a large skillet or wok over high heat.<br/>2. Add chilli and garlic, stir for 10 seconds.<br/>3. Add onion, cook for 1 minute.<br/>4. Add chicken, cook until it mostly turns white, then add 1 tbsp kecap manis and cook for a further 1 minute or until chicken is mostly cooked through and a bit caramelised.<br/>5. Add rice, 2 tbsp kecap manis and shrimp paste, if using. Cook, stirring constantly, for 2 minutes until sauce reduces down and rice grains start to caramelise (key for flavour!).<br/>6. Serve, garnished with garnishes of choice (green onions, red chilli, fried shallots).',
                'preparation_time' => '15',
                'is_featured' => 1
            ],
            [
                'cuisine_id' => 5,
                'subcuisine_id' => 5,
                'item_name' => 'Margharita Pizza',
                'image' => 'pizza-1.jpg',
                'weather_id' => '1',
                'addons_id' => '1,4,5',
                'slug' => 'marghariza-pizza',
                'item_type' => 2,
                'has_variation' => 2,
                'price' => '20000',
                'item_description' => '1. Preheat the oven to 500 degrees Fahrenheit with a rack in the upper third of the oven. If you’re using a baking stone or baking steel, place it on the upper rack. Prepare dough through step 5.
                <br/>2. Place a medium mixing bowl in the sink and pour the canned tomatoes into the bowl, juices and all. Crush the tomatoes by hand. Spread about ¾ cup of the tomato sauce evenly over each pizza, leaving about 1 inch bare around the edges.
                <br/>3. If your mozzarella is packed in water, drain off the water and gently pat the mozzarella dry on a clean tea towel or paper towels. If you’re working with large mozzarella balls, tear them into smaller 1-inch balls. Distribute the mozzarella over the pizza, concentrating it a bit more in the center of the pizza, as it will melt toward the edges.
                <br/>4. Bake pizzas individually on the top rack until the crust is golden and the cheese is just turning golden, about 10 to 12 minutes (or significantly less, if you’re using a baking stone/steel—keep an eye on it).
                <br/>5. Top each pizza generously with fresh basil, followed by a light back-and-forth drizzle of olive oil, a sprinkling of salt, and red pepper flakes, if you wish. Slice and enjoy. Leftover pizza will keep well in the refrigerator for up to 4 days.',
                'preparation_time' => '15',
                'is_featured' => 1
            ]
            ]);
    }
}
