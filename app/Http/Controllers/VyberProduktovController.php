<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;

class VyberProduktovController extends Controller
{
    public function index(Request $request)
    {
        $kategoria = $request->query('kategoria');
        $podkategoria = $request->query('podkategoria');
        $sort = $request->query('sort');
        $priceFrom = $request->query('priceFrom');
        $priceTo = $request->query('priceTo');
        $brandsFilter = $request->query('brand');
        $colorFilter = $request->query('color');
        $sizeFilter = $request->query('size'); // Pridávame parameter pre veľkosť

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

        $category = Category::where('name', $kategoria)->firstOrFail();
        $query = $category->products();

        $subcategory = Category::where('name', $podkategoria)->first();
        if ($podkategoria) {
            $query->wherePivot('subcategoryid', $podkategoria);
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

        // Filtrovanie podľa značiek
        if (!is_null($brandsFilter)) {
            $brandsFilter = is_array($brandsFilter) ? $brandsFilter : [$brandsFilter];
            $query->whereIn('producerinfo', $brandsFilter);
        }

        // Filtrovanie podľa farby
        if (!is_null($colorFilter)) {
            $query->whereHas('colors', function ($q) use ($colorFilter) {
                $q->where('name', $colorFilter);
            });
        }

        // Filtrovanie podľa veľkosti
        if (!is_null($sizeFilter)) {
            $query->whereHas('sizes', function ($q) use ($sizeFilter) {
                $q->where('name', $sizeFilter);
            });
        }

        // Zoradenie produktov podľa zvoleného kritéria
        if ($sort === 'lowest-price') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'highest-price') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        }

        $search = null;

        $products = $query->paginate(8);
        $products->appends(['kategoria' => $kategoria, 'podkategoria' => $podkategoria, 'sort' => $sort, 'priceFrom' => $priceFrom, 'priceTo' => $priceTo, 'brand' => $brandsFilter, 'color' => $colorFilter, 'size' => $sizeFilter]);

        return view('client.vyber_produktov', compact('kategoria', 'podkategoria', 'products', 'search', 'sort', 'brands', 'colors', 'sizes'));
    }
}
