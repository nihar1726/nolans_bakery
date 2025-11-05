@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endsection

@section('title')
Our Story - About Nolan's Bakery
@endsection

@section('content')
<section class="about-hero text-center">
<h1>The Story of Nolan's Bakery</h1>
<p>A passion for baking, delivered to your neighborhood.</p>
</section>

<section class="our-mission">
    <h2>Our Mission</h2>
    <p>Our goal is simple: to provide the freshest, most delightful baked goods to our community without you ever having to leave your home. Quality, convenience, and a little bit of joy in every box.</p>
</section>

<section class="the-team">
    <h2>Meet Nolan</h2>
    <div class="team-member">
        <img class="team-photo" src="{{ asset('images/team/nolan.png') }}" alt="Nolan" />
        <p>Nolan started baking out of his home kitchen five years ago, fueled by a desire to share his grandmother's recipes. Today, Nolan's Bakery is the realization of that dream, still maintaining the small-batch quality and personal touch.</p>
    </div>
</section>

<section class="contact-cta text-center">
    <h2>Have a Question?</h2>
    <p>We'd love to hear from you for custom orders or feedback.</p>
    <a href="/contact" class="btn-tertiary">Contact Us</a>
</section>


@endsection