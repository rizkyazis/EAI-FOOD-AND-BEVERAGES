<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuIngredients;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $category = ['Vegetables',
            'Fruits',
            'Grains, legumes, nuts and seeds',
            'Meat and poultry',
            'Fish and seafood',
            'Dairy foods',
            'Eggs'];

        $imgCategory = ['vegetables.jpg',
            'fruits.jpg',
            'seeds.jpg',
            'meats.jpg',
            'seafood.jpeg',
            'dairy.jpeg',
            'eggs.jpg'];

        $menu = ['Gado-gado',
            'The "Es buah"',
            'The "Nasi Goreng" Special',
            'Chicken with Fried Coconut Flakes',
            'Grilled Salmon',
            'Milkshake',
            'The "Mata Sapi" egg'];

        $type = ['food',
            'drink',
            'food',
            'food',
            'food',
            'drink',
            'food'];

        $image = ['gadogado.jpg',
            'esbuah.jpg',
            'nasigoreng.jpg',
            'ayamserundeng.jpg',
            'salmon.jpg',
            'milkshake.jpg',
            'matasapi.jpg'];

        $description = ['Gado-gado (Indonesian or Betawi) is an Indonesian salad of slightly boiled, blanched or steamed vegetables and hard-boiled eggs, boiled potato, fried tofu and tempeh, and lontong (rice wrapped in a banana leaf), served with a peanut sauce dressing.',
            'Es buah is an Indonesian iced fruit cocktail dessert. This cold and sweet beverage is made of diced fruits, such as honeydew, cantaloupe, pineapple, papaya, squash, jackfruit and kolang kaling (Arenga pinnata fruit), mixed with shaved ice or ice cubes, and sweetened with liquid sugar or syrup.',
            'Nasi goreng (English pronunciation: /ˌnɑːsi ɡɒˈrɛŋ/), literally meaning "fried rice" in both the Indonesian and Malay languages, is an Indonesian rice dish with pieces of meat and vegetables added. It can refer simply to fried pre-cooked rice, a meal including stir fried rice in a small amount of cooking oil or margarine, typically spiced with kecap manis (sweet soy sauce), shallot, garlic, ground shrimp paste, tamarind and chilli and accompanied by other ingredients, particularly egg, chicken and prawns. There is also another kind of nasi goreng which is made with ikan asin (salted dried fish) which is also popular across Indonesia.',
            'Chicken with Fried Coconut Flakes is a traditional cuisine originated from Indonesia that consists of fried chicken mixed with fried coconut flakes. Fried coconut flakes is made of fried grated coconut flesh and galangal.',
            'Salmon is a common food fish classified as an oily fish with a rich content of protein and omega-3 fatty acids. In Norway – a major producer of farmed and wild salmon – farmed and wild salmon differ only slightly in terms of food quality and safety, with farmed salmon having lower content of environmental contaminants, and wild salmon having higher content of omega-3 fatty acids.',
            'A milkshake, or simply shake, is a drink that is usually made by blending milk, ice cream, and flavorings or sweeteners such as butterscotch, caramel sauce, chocolate syrup, fruit syrup, or whole fruit into a thick, sweet, cold mixture.',
            'A "Mata Sapi" is an egg that has been cooked, outside the shell, by poaching (or sometimes steaming), as opposed to simmering or boiling. This method of preparation can yield more delicately cooked eggs than cooking at higher temperatures such as with boiling water.'];

        $price = [25000,20000,45000,65000,70000,20000,25000];

        for($i = 0;$i<count($category);$i++){
            $input = new Category();
            $input->name = $category[$i];
            $input->image = $imgCategory[$i];
            $input->save();
        }

        for($i = 0;$i<count($menu);$i++){
            $input = new Menu();
            $input->name = $menu[$i];
            $input->type = $type[$i];
            $input->image = $image[$i];
            $input->description = $description[$i];
            $input->price = $price[$i];
            $input->category_id = $i+1;
            $input->save();
        }

        $ingredient = [1,4,6,15,3];
        $quantity = [30,24,54,23,1];

        for($i = 0;$i<count($menu);$i++){
            for($u = 0;$u<count($ingredient);$u++){
                $input = new MenuIngredients();
                $input->menu_id = $i+1;
                $input->ingredient_id = $ingredient[$u];
                $input->quantity = $quantity[$u];
                $input->save();
            }
        }
    }
}
