<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

@extends('main')

@push('styles')
<style>
    .drawer-content {
        padding-top: 0 !important;
    }
</style>
@endpush

@section('content')

@php
    $slides = [
        ['image' => 'carousel/copland.jpeg'],
        ['image' => 'carousel/code.jpg'],
        ['image' => 'carousel/server.jpeg'],
    ];
@endphp

<section class="relative overflow-hidden -mx-10 px-4 py-20 md:py-28 mb-4 pt-20">

    <div class="absolute inset-0 bg-gradient-to-br from-cyan-950/40 via-base-100 to-base-100 pointer-events-none" ></div>

    <div class="absolute -top-32 -left-32 w-[500px] h-[500px] rounded-full bg-cyan-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-[350px] h-[350px] rounded-full bg-cyan-700/10 blur-3xl pointer-events-none"></div>

    <div class="relative max-w-5xl mx-auto text-center flex flex-col items-center gap-6">
        <h1 class="text-5xl md:text-6xl font-extrabold leading-tight tracking-tight text-base-content">
            Bienvenido a <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-cyan-600">
                Serial Experiments
            </span>
            <span class="block text-base-content">Enterprises</span>
        </h1>

        <p class="text-lg text-gray-500 dark:text-gray-400 max-w-xl">
            Diseñamos e implementamos sistemas distribuidos eficientes,
            optimizados para funcionar con recursos limitados y a precios accesibles.
        </p>

        <div class="flex items-center gap-4 mt-2">
            <a href="/login">
                <button class="flex items-center gap-2 bg-cyan-600 hover:bg-cyan-500 active:scale-95 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-200 shadow-lg shadow-cyan-500/20">
                    <x-icon name="o-user" class="w-5 h-5" />
                    Iniciar sesión
                </button>
            </a>
            <a href="#sobre-nosotros" class="text-sm text-gray-500 hover:text-cyan-400 transition-colors font-medium">
                Conoce más →
            </a>
        </div>

    </div>
</section>

<section class="mb-16 rounded-2xl overflow-hidden shadow-2xl border border-base-300">
    <x-carousel :slides="$slides" without-indicators autoplay style="width: 100%; height: 400px;" />
</section>

<section class="grid grid-cols-3 gap-4 mb-16">
    @foreach([
        ['icon' => 'o-bolt', 'value' => '+12', 'label' => 'Productos disponibles'],
        ['icon' => 'o-currency-dollar', 'value' => 'Bajo costo', 'label' => 'Precios accesibles'],
        ['icon' => 'o-shield-check', 'value' => '100%', 'label' => 'Calidad garantizada'],
    ] as $stat)
    <div class="flex flex-col items-center justify-center gap-2 bg-base-200 border border-base-300 rounded-2xl py-8 px-4 text-center hover:border-cyan-500/40 transition-colors">
        <div class="bg-cyan-500/10 p-3 rounded-xl mb-1">
            <x-icon name="{{ $stat['icon'] }}" class="w-7 h-7 text-cyan-400" />
        </div>
        <span class="text-2xl font-extrabold text-base-content">{{ $stat['value'] }}</span>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $stat['label'] }}</span>
    </div>
    @endforeach
</section>

<section id="sobre-nosotros" class="mb-16">

    <div class="flex items-center gap-3 mb-8">
        <div class="h-px flex-1 bg-base-300"></div>
        <h2 class="text-3xl font-bold text-cyan-500 px-4">Sobre nosotros</h2>
        <div class="h-px flex-1 bg-base-300"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Misión --}}
        <div class="relative flex flex-col rounded-2xl bg-base-200 border border-base-300 hover:border-cyan-500/40 shadow-md hover:shadow-cyan-500/5 hover:shadow-xl transition-all duration-300 overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-cyan-500 to-cyan-700"></div>
            <div class="flex flex-col gap-5 p-7">
                <div class="flex items-center gap-4">
                    <div class="bg-cyan-500/10 rounded-xl p-3 flex-shrink-0">
                        <x-icon name="o-rocket-launch" class="w-7 h-7 text-cyan-400" />
                    </div>
                    <h3 class="text-xl font-bold text-cyan-500">Misión</h3>
                </div>
                <div class="flex items-center gap-6">
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-justify flex-1">
                        Diseñar e implementar sistemas distribuidos eficientes y accesibles, optimizados para funcionar con recursos limitados, con el objetivo de ofrecer estas tecnologías de bajo costo que beneficien al público en general.
                    </p>
                    <x-icon name="o-rocket-launch" class="w-24 h-24 text-cyan-500/20 flex-shrink-0 opacity-90" />
                </div>
            </div>
        </div>

        <div class="relative flex flex-col rounded-2xl bg-base-200 border border-base-300 hover:border-cyan-500/40 shadow-md hover:shadow-cyan-500/5 hover:shadow-xl transition-all duration-300 overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-cyan-700 to-cyan-500"></div>
            <div class="flex flex-col gap-5 p-7">
                <div class="flex items-center gap-4">
                    <div class="bg-cyan-500/10 rounded-xl p-3 flex-shrink-0">
                        <x-icon name="o-eye" class="w-7 h-7 text-cyan-400" />
                    </div>
                    <h3 class="text-xl font-bold text-cyan-500">Visión</h3>
                </div>
                <div class="flex items-center gap-6">
                        <x-icon name="o-eye" class="w-24 h-24 text-cyan-500/20 flex-shrink-0 opacity-90" />
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-justify flex-1">
                        Consolidarnos como una empresa sólida y reconocida por ofrecer servicios tecnológicos accesibles y de bajo costo para profesionistas.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
