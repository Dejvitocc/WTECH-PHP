<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Color;
use App\Models\Size;
use App\Models\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{   
    public function index(Request $request)
    {
    $query = Product::query();

    if ($request->filled('search')) {
        $searchTerm = $request->input('search');
        $query->where('name', 'like', '%' . $searchTerm . '%');
    }

    $products = $query->orderBy('id', 'asc')->paginate(10);

    return view('admin.sprava_produktov', compact('products'));
    }

    public function edit($id) // Laravel automaticky nájde produkt podľa ID
    {
        $product = Product::with(['images', 'colors', 'sizes', 'categories', 'subcategories'])->findOrFail($id);
        $mode = 'edit';
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $colors = Color::all(); 
        $sizes = Size::all();
        return view('admin.vytvorenie_produktu', compact('product', 'mode', 'categories', 'subcategories', 'colors', 'sizes'));   
    }

    public function update(Request $request, $id)
    {
        try {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'popis' => 'required|string',
            'vyrobca' => 'required|string',
            'udaje' => 'required|string',
            'colors' => 'required|exists:colors,id',
            'sizes' => 'required|array',
            'sizes.*' => 'exists:sizes,id',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:1',
            'subcategory_id' => 'required|exists:subcategories,id',
            'cena' => 'required|numeric',
            'images' => 'sometimes|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->popis,
            'producerinfo' => $request->vyrobca,
            'productinfo' => $request->udaje,
            'price' => $request->cena,
            'stockquantity' => $request->quantity,
        ]);

        $product->colors()->sync($request->colors); 
        $product->sizes()->sync($request->sizes);
        $product->categories()->sync([$request->category_id => ['subcategoryid' => $request->subcategory_id]]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $filename = $image->getClientOriginalName(); // Unikátny názov
                    $image->move(public_path('images'), $filename);

                    try {
                        Log::info('Image data before creation', [
                            'text' => $product->name,
                            'route' => 'images/' . $filename,
                            'productid' => $product->id
                        ]);

                        $imageModel = Image::create([
                            'text' => $product->name,
                            'route' => 'images/' . $filename,
                            'productid' => $product->id
                        ]);

                        Log::info('Image created', ['image' => $imageModel->toArray()]);
                    } catch (\Exception $e) {
                        Log::error('Failed to create image record', [
                            'error' => $e->getMessage(),
                            'filename' => $filename,
                            'product_id' => $product->id
                        ]);
                    }
                } else {
                    Log::error('Invalid image file', ['filename' => $image->getClientOriginalName()]);
                }
            }
        }

        return redirect()->route('admin.index')->with('success', 'Produkt bol aktualizovaný.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Aktualizácia zlyhala: ' . $e->getMessage());
    }
    }

    public function destroyImage($id)
    {
                    // Nájde obrázok podľa ID
            $image = Image::findOrFail($id);

            // Získa cestu k súboru
            $filePath = public_path($image->route);

            // Skontroluje, či súbor existuje, a odstráni ho
            if (file_exists($filePath)) {
                unlink($filePath);
                Log::info('Image file deleted', ['file' => $image->route]);
            } else {
                Log::warning('Image file not found', ['file' => $image->route]);
            }

            // Odstráni záznam z databázy
            $image->delete();
            Log::info('Image record deleted', ['image_id' => $id]);

            if (request()->expectsJson()) {
                return response()->json(['message' => 'Obrázok bol odstránený.']);
            }

            // Vráti úspešnú odpoveď
            return redirect()->route('admin.vytvorenie_produktu')->with('success', 'Obrázok bol odstranený.');
        
    }   

    public function destroy($id)
    {
        try {
            DB::table('productcategories')->where('productid', $id)->delete();
            $product = Product::with('images')->findOrFail($id);

            DB::statement("SELECT setval('images_id_seq', (SELECT COALESCE(MAX(id), 1) FROM images))");
            // Delete associated images
            foreach ($product->images as $image) {
                $filePath = public_path($image->route);
                if (file_exists($filePath)) {
                    unlink($filePath);
                    Log::info('Image file deleted', ['file' => $image->route]);
                }
                $image->delete();
                Log::info('Image record deleted', ['image_id' => $image->id]);
            }

            // Delete the product
            $product->delete();
            Log::info('Product deleted', ['product_id' => $id]);

            // AJAX response
            if (request()->expectsJson()) {
                return response()->json(['message' => 'Produkt bol úspešne zmazaný.']);
            }

            // Fallback redirect
            return redirect()->route('admin.index')->with('success', 'Produkt bol zmazaný.');
        } catch (\Exception $e) {
            Log::error('Failed to delete product', [
                'product_id' => $id,
                'error' => $e->getMessage(),
            ]);
            if (request()->expectsJson()) {
                return response()->json(['error' => 'Chyba pri mazaní produktu: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Chyba pri mazaní produktu: ' . $e->getMessage());
        }
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $colors = Color::all(); 
        $sizes = Size::all();
        $mode = 'create';

        return view('admin.vytvorenie_produktu', compact('mode', 'categories', 'subcategories', 'colors', 'sizes'));
    }

// Uloženie nového produktu
    public function store(Request $request)
    {
        DB::statement("SELECT setval('images_id_seq', (SELECT COALESCE(MAX(id), 1) FROM images))");
        // Validácia požiadaviek
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'popis' => 'required|string',
            'vyrobca' => 'required|string',
            'udaje' => 'required|string',
            'colors' => 'required|exists:colors,id',
            'sizes' => 'required|array',
            'sizes.*' => 'exists:sizes,id',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'cena' => 'required|numeric',
            'images' => 'sometimes|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Vytvorenie nového produktu
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->popis,
            'producerinfo' => $request->vyrobca,
            'productinfo' => $request->udaje,
            'price' => $request->cena,
            'stockquantity' => $request->quantity,
        ]);

        // Priradenie farieb, veľkostí, kategórie a subkategórie
        $product->colors()->sync($request->colors); 
        $product->sizes()->sync($request->sizes);
        $product->categories()->sync([$request->category_id => ['subcategoryid' => $request->subcategory_id]]);

        // Nahrávanie obrázkov
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $filename = $image->getClientOriginalName(); // Unikátny názov
                    $image->move(public_path('images'), $filename);

                    try {
                        Log::info('Image data before creation', [
                            'text' => $product->name,
                            'route' => 'images/' . $filename,
                            'productid' => $product->id
                        ]);

                        $imageModel = Image::create([
                            'text' => $product->name,
                            'route' => 'images/' . $filename,
                            'productid' => $product->id
                        ]);

                        Log::info('Image created', ['image' => $imageModel->toArray()]);
                    } catch (\Exception $e) {
                        Log::error('Failed to create image record', [
                            'error' => $e->getMessage(),
                            'filename' => $filename,
                            'product_id' => $product->id
                        ]);
                    }
                } else {
                    Log::error('Invalid image file', ['filename' => $image->getClientOriginalName()]);
                }
            }
        }

        // Presmerovanie späť na zoznam produktov alebo stránku s detailmi produktu
        return redirect()->route('admin.index')->with('success', 'Produkt bol úspešne pridaný.');
    }
    
}
