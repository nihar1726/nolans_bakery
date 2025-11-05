@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/bakery.css') }}">
@endsection

@section('title', "Welcome to Nolan's Bakery")

@section('content')
@php
  $heroRel = null;
  foreach ([
    'images/hero/home-hero.webp',
    'images/hero/home-hero.png',
    'images/hero/home-hero.jpg',
  ] as $heroPath) {
    if (file_exists(public_path($heroPath))) { $heroRel = $heroPath; break; }
  }
  $heroRel = $heroRel ?? 'images/hero/home-hero.png';
@endphp
<section class="home-hero text-center" style="background-image:url('{{ asset($heroRel) }}')">
<h1>Freshly Baked, Delivered</h1>
<p>Small-batch breads, pastries, and cakes baked with care every morning.</p>
<p style="margin-top:12px">
    <a href="/menu" class="btn-primary">Browse the Menu</a>
    <a href="/order" class="btn-tertiary" style="margin-left:8px">Place an Order</a>
  </p>
</section>

<section class="our-mission">
  <h2>Why You'll Love Nolan's</h2>
  <ul style="margin:10px 0 0; padding-left:18px">
    <li>Real ingredients and time-honored techniques</li>
    <li>Neighborhood delivery, same-day freshness</li>
    <li>Seasonal specials and custom orders</li>
  </ul>
</section>

<section class="the-team">
  <h2>Featured Categories</h2>
  @php
    $candidatePaths = function(string $name){
        return [
            "images/categories/{$name}.webp",
            "images/categories/{$name}.jpg",
            "images/categories/{$name}.jpeg",
            "images/categories/{$name}.png",
            "storage/images/categories/{$name}.webp",
            "storage/images/categories/{$name}.jpg",
            "storage/images/categories/{$name}.jpeg",
            "storage/images/categories/{$name}.png",
        ];
    };
    $pickImage = function(string $name) use ($candidatePaths){
        foreach ($candidatePaths($name) as $relPath) {
            if (file_exists(public_path($relPath))) {
                return $relPath;
            }
        }
        return null;
    };
    $cakesImage = $pickImage('cakes') ?? 'images/categories/cakes.jpg';
    $breadsImage = $pickImage('breads') ?? 'images/categories/breads.jpg';
    // Support both correct and legacy misspelling 'pasteries'
    $pastriesImage = $pickImage('pastries')
        ?? $pickImage('pasteries')
        ?? 'images/categories/pasteries.jpg';
  @endphp
  <div class="category-grid" style="margin-top:10px">
    <a href="/menu#cakes" class="category-card">
      <img src="{{ asset($cakesImage) }}" alt="Cakes" />
      <h3>Cakes</h3>
    </a>
    <a href="/menu#breads" class="category-card">
      <img src="{{ asset($breadsImage) }}" alt="Breads" />
      <h3>Breads</h3>
    </a>
    <a href="/menu#pastries" class="category-card">
      <img src="{{ asset($pastriesImage) }}" alt="Pastries" />
      <h3>Pastries</h3>
    </a>
  </div>
  <p style="margin-top:12px"><a href="/menu" class="btn-tertiary">See Full Menu</a></p>
</section>

@endsection