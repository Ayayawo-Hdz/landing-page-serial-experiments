<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // Categorías
        $equipos = Categoria::create([
            'name' => 'Equipos',
            'description' => 'Equipos para desarrollo de sistemas'
        ]);

        $licencias = Categoria::create([
            'name' => 'Licencias',
            'description' => 'Licencias de software empresarial'
        ]);

        $componentes = Categoria::create([
            'name' => 'Componentes',
            'description' => 'Componentes para infraestructura de sistemas'
        ]);

        // Equipos
        Product::create([
            'name' => 'Servidor empresarial',
            'description' => 'Servidor para sistemas integrativos',
            'price' => 5000,
            'stock' => 5,
            'categoria_id' => $equipos->id
        ]);

        Product::create([
            'name' => 'Laptop desarrollo',
            'description' => 'Laptop optimizada para programación',
            'price' => 2000,
            'stock' => 10,
            'categoria_id' => $equipos->id
        ]);

        // Licencias
        Product::create([
            'name' => 'Licencia ERP',
            'description' => 'Sistema ERP empresarial',
            'price' => 3000,
            'stock' => 50,
            'categoria_id' => $licencias->id
        ]);

        Product::create([
            'name' => 'Licencia CRM',
            'description' => 'Sistema CRM para gestión de clientes',
            'price' => 2500,
            'stock' => 50,
            'categoria_id' => $licencias->id
        ]);

        // Componentes
        Product::create([
            'name' => 'API Integración',
            'description' => 'API para integración entre sistemas',
            'price' => 800,
            'stock' => 100,
            'categoria_id' => $componentes->id
        ]);

        Product::create([
            'name' => 'Módulo autenticación',
            'description' => 'Sistema de autenticación segura',
            'price' => 600,
            'stock' => 100,
            'categoria_id' => $componentes->id
        ]);

    }
}
