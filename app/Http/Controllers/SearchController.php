<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sizeFilter = $request->query('size');
        $colorFilter = $request->query('color');
        $brandsFilter = $request->query('brand');
        $priceFrom = $request->query('priceFrom');
        $priceTo = $request->query('priceTo');
        $sort = $request->query('sort', 'newest'); // Predvolené zoradenie

        // Načítanie produktov s vyhľadávaním
        $query = Product::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Filtrovanie podľa veľkosti
        if (!is_null($sizeFilter)) {
            $query->whereHas('sizes', function ($q) use ($sizeFilter) {
                $q->where('name', $sizeFilter);
            });
        }

        // Filtrovanie podľa farby
        if (!is_null($colorFilter)) {
            $query->whereHas('colors', function ($q) use ($colorFilter) {
                $q->where('name', $colorFilter);
            });
        }

        // Filtrovanie podľa značiek
        if (!is_null($brandsFilter)) {
            $brandsFilter = is_array($brandsFilter) ? $brandsFilter : [$brandsFilter];
            $query->whereIn('producerinfo', $brandsFilter);
        }

        // Filtrovanie podľa ceny
        if (!is_null($priceFrom) && is_numeric($priceFrom)) {
            $priceFrom = (float) $priceFrom;
            $query->where('price', '>=', $priceFrom);
        }
        if (!is_null($priceTo) && is_numeric($priceTo)) {
            $priceTo = (float) $priceTo;
            $query->where('price', '<=', $priceTo);
        }

        // Zoradenie produktov podľa zvoleného kritéria
        if ($sort === 'lowest-price') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'highest-price') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        }

        // Načítanie produktov s pagináciou
        $products = $query->with(['images', 'sizes', 'colors'])->paginate(8);
        $products->appends([
            'search' => $search,
            'size' => $sizeFilter,
            'color' => $colorFilter,
            'brand' => $brandsFilter,
            'priceFrom' => $priceFrom,
            'priceTo' => $priceTo,
            'sort' => $sort
        ]);

        // Načítanie unikátnych značiek z tabuľky products
        $brands = Product::select('producerinfo')
            ->distinct()
            ->pluck('producerinfo')
            ->filter()
            ->sort();

        // Načítanie unikátnych farieb z tabuľky colors
        $colors = Color::pluck('name')->sort();

        // Načítanie unikátnych veľkostí z tabuľky sizes
        $sizes = Size::pluck('name')->sort();

        $kategoria = null;
        $podkategoria = null;

        // Poslanie dát do šablóny
        return view('client.vyber_produktov', compact(
            'kategoria',
            'podkategoria',
            'products',
            'search',
            'sort',
            'brands',
            'colors',
            'sizes'
        ));
    }
}
