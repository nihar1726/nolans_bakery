@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endsection

@section('title', 'Menu - All Our Baked Goods')

@section('content')
<section class="menu-header text-center">
<h1>The Nolan's Bakery Menu</h1>
<p>Explore our selection of cakes, pastries, breads, and seasonal specialties.</p>
</section>

<section class="menu-categories">
    @forelse ($products as $category => $items)
        <div class="category-section" id="{{ strtolower($category) }}">
            <h2>{{ ucwords(strtolower($category)) }}</h2>
            <div class="product-grid">
                @foreach ($items as $item)
                    <div class="menu-item">
                        @php
                            $categoryDir = strtolower($category);
                            // Map incoming categories to existing public image directories
                            $normalizedCategoryDir = match ($categoryDir) {
                                'pastries', 'pasteries' => 'pasteries',
                                'cakes', 'cake' => 'cakes',
                                'breads', 'bread' => 'breads',
                                // Map categories without dedicated folders to closest existing set
                                'brownies', 'croissant', 'muffins' => 'pasteries',
                                'pies', 'pie' => 'cakes',
                                default => $categoryDir,
                            };

                            $slug = \Illuminate\Support\Str::slug($item->name ?? 'item');
                            $candidates = [];

                            // 1) Respect explicit image_path if present (support absolute-like and storage paths)
                            if (!empty($item->image_path)) {
                                $raw = ltrim($item->image_path, '/');
                                $candidates[] = $raw;
                                $candidates[] = "storage/{$raw}";
                            }

                            // 2) Computed product image paths across extensions (normalized and legacy pastries)
                            foreach (['jpg','jpeg','png','webp'] as $ext) {
                                $candidates[] = "images/products/{$normalizedCategoryDir}/{$slug}.{$ext}";
                                $candidates[] = "storage/images/products/{$normalizedCategoryDir}/{$slug}.{$ext}";
                                if (in_array($normalizedCategoryDir, ['pasteries'])) {
                                    $candidates[] = "images/products/pastries/{$slug}.{$ext}"; // alternate spelling
                                }
                            }

                            // 3) Smart matching: Try to find images that match keywords from the product name
                            $productName = strtolower($item->name ?? '');
                            // Extract meaningful keywords (remove common words like "classic", "large", etc.)
                            $stopWords = ['classic', 'large', 'the', 'a', 'an', 'and', 'or', 'but', 'with', 'by', 'for', 'of', 'to'];
                            $keywords = array_filter(
                                explode(' ', preg_replace('/[^a-z0-9\s]/', ' ', $productName)),
                                fn($word) => strlen($word) > 2 && !in_array($word, $stopWords)
                            );
                            
                            $dirChecks = [
                                "images/products/{$normalizedCategoryDir}",
                                "storage/images/products/{$normalizedCategoryDir}",
                            ];
                            
                            $bestMatch = null;
                            $bestScore = 0;
                            
                            foreach ($dirChecks as $dirRel) {
                                $abs = public_path($dirRel);
                                if (is_dir($abs)) {
                                    $allImages = collect(['jpg','jpeg','png','webp'])
                                        ->map(function($ext) use ($abs) { return glob($abs . DIRECTORY_SEPARATOR . "*.{$ext}") ?: []; })
                                        ->flatten(1);
                                    
                                    foreach ($allImages as $imgPath) {
                                        $imgName = strtolower(basename($imgPath, '.' . pathinfo($imgPath, PATHINFO_EXTENSION)));
                                        $imgNameSlug = str_replace(['-', '_'], ' ', $imgName);
                                        
                                        // Score based on keyword matches
                                        $score = 0;
                                        foreach ($keywords as $keyword) {
                                            if (str_contains($imgNameSlug, $keyword) || str_contains($imgName, $keyword)) {
                                                $score += 2; // Exact keyword match
                                            }
                                            // Partial match (e.g., "croissant" matches "croissant")
                                            if (str_contains($imgName, substr($keyword, 0, 4))) {
                                                $score += 1;
                                            }
                                        }
                                        
                                        if ($score > $bestScore) {
                                            $bestScore = $score;
                                            $bestMatch = $dirRel . '/' . basename($imgPath);
                                        }
                                    }
                                }
                            }
                            
                            if ($bestMatch && $bestScore > 0) {
                                $candidates[] = $bestMatch;
                            } else {
                                // Fallback: pick first image in category directory if no smart match
                                foreach ($dirChecks as $dirRel) {
                                    $abs = public_path($dirRel);
                                    if (is_dir($abs)) {
                                        $found = collect(['jpg','jpeg','png','webp'])
                                            ->map(function($ext) use ($abs) { return glob($abs . DIRECTORY_SEPARATOR . "*.{$ext}") ?: []; })
                                            ->flatten(1)
                                            ->first();
                                        if ($found) {
                                            $rel = $dirRel . '/' . basename($found);
                                            $candidates[] = $rel;
                                            break;
                                        }
                                    }
                                }
                            }

                            // 4) Category card image as a last-ditch category fallback
                            foreach (['jpg','jpeg','png','webp'] as $ext) {
                                $candidates[] = "images/categories/{$normalizedCategoryDir}.{$ext}";
                                $candidates[] = "storage/images/categories/{$normalizedCategoryDir}.{$ext}";
                            }

                            // Choose the first existing candidate; final fallback is logo
                            $chosen = null;
                            foreach ($candidates as $rel) {
                                if (file_exists(public_path($rel))) { $chosen = $rel; break; }
                            }
                            $path = $chosen ?? 'images/logo/logo.png';
                        @endphp
                        <img src="{{ asset($path) }}" alt="{{ $item->name }}" style="width:100%; border-radius:12px" />
                        <h3>{{ $item->name }}</h3>
                        @if (!empty($item->description))
                            <p class="description">{{ $item->description }}</p>
                        @endif
                        <p class="price">₹{{ number_format($item->price, 2) }}</p>

                        @if (!empty($item->id))
                        <form method="POST" action="{{ route('cart.add', ['productId' => $item->id]) }}">
                            @csrf
                            <input type="hidden" name="quantity" value="1" />
                            <button type="submit">Add to Cart</button>
                        </form>
                        @else
                            <button disabled>Unavailable</button>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <p class="text-muted">No products available right now. Please check back soon.</p>
    @endforelse
</section>


@endsection