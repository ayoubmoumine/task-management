<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    private static $id = 1, $nameIndex = 0;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $projectNames = [
            "Active Achievement", 
            "techprime", 
            "Optimize range", 
            "Smart Brief Leadership", 
            "Passion Chasers", 
            "Commission Kings", 
            "Limitless Horizons", 
            "The Social Experiment",
            "Social Geek Made",
            "The Blue Bird"
        ];
        return [
            "id" => self::$id++,
            "name" => $projectNames[ self::$nameIndex++ ],
        ];
    }
}
