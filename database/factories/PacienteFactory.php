<?php

namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Paciente::class;

    public function definition()
    {

        return [
            'nome' => $this->faker->name,
            'data_nascimento' => $this->faker->date,
            'sexo' => $this->faker->randomElement(['Masculino', 'Feminino']),
            'endereco' => $this->faker->address,
            'telefone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'historico_medico' => $this->faker->paragraph,
        ];
    }
}
