<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ValidationCategory;
use App\Http\Requests\ValidationProducts;
use App\Models\Categorys;
use App\Models\Products;

class Administrator extends Controller
{
    protected $Categorys;
    protected $Products;
    public function __construct(Categorys $Categorys, Products $Products) {
        $this->Categorys = $Categorys;
        $this->Products = $Products;
    }


    public function index()  {
       
        $data = [
             'title' => 'Dashboard'
        ];
        return view('administrator/dashboard/file', $data);
    }




    public function Category()  {

        $category = $this->Categorys->orderBy('id_category', 'desc')->get();
       
        $data = [
             'title' => 'Data Category',
             'category' =>  $category
        ];
        return view('administrator/category/data/datatable', $data);
    }


    public function Create()  {
        $data = [
             'title' => 'Form Create Data'
        ];
        return view('administrator/category/form/create', $data);
    }



    public function Store(ValidationCategory $request)  {
    
        try {
         // Cek apakah kategori dengan nama yang sama sudah ada
        $existingCategory = $this->Categorys->where('name_category', $request->input('name_category'))->first();

        if ($existingCategory) {
            return redirect()->route('Administrator.category')
                ->with('error', 'Category already exists.');
        }

        $category = $this->Categorys;
        $category->name_category = $request->input('name_category');
        $category->description_category = $request->input('description_category');
        $category->save();
        return redirect()->route('Administrator.category')->with('success','success save');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.category')->with('error','Failed to create data. Please try again.');
        }
    }

    

    public function Show(Request $request)  {
        $idCategory = $request->input('id');
        $idCategoryDecy = Crypt::decrypt($idCategory);
        $Category = $this->Categorys->findOrFail($idCategoryDecy);
      
        $data = [
             'title' => 'Form Update Data',
             'id' => $idCategory,
             'row' =>  $Category
        ];
        return view('administrator/category/form/update', $data);
    }

    public function Update(ValidationCategory $request, $id)  {
        try {
            $idCategoryDecy = Crypt::decrypt($id);
            // Cari data kategori yang akan diupdate
            $category = $this->Categorys->findOrFail($idCategoryDecy);
            // Cek apakah sudah ada kategori dengan nama yang sama tapi ID berbeda
            $isExist = $this->Categorys
                ->where('name_category', $request->input('name_category'))
                ->where('id_category', '!=', $idCategoryDecy) // Pastikan bukan ID yang sedang diupdate
                ->exists();
    
            if ($isExist) {
                return redirect()->route('Administrator.category')
                    ->with('error', 'Category name already exists!');
            }

            $category = $this->Categorys->findOrFail($idCategoryDecy);
            $category->name_category = $request->input('name_category');
            $category->description_category = $request->input('description_category');
            $category->update();
            return redirect()->route('Administrator.category')->with('success','success update');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.category')->with('error','Failed to update data. Please try again.');
        }
    }


        public function Destroy($id)  
    {
        try {
            // Dekripsi ID yang dienkripsi di URL
            $idCategoryDecy = Crypt::decrypt($id);

            // Cek apakah kategori dengan ID tersebut ada di database
            $category = $this->Categorys->find($idCategoryDecy);
            
            if (!$category) {
                return redirect()->route('Administrator.category')
                    ->with('error', 'Data Code OR ID Not Found!');
            }

            // Jika ditemukan, lakukan penghapusan
            $category->delete();
            
            return redirect()->route('Administrator.category')->with('success', 'Success delete');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.category')->with('error', 'Failed to delete data. Please try again.');
        }
    }


        
    public function Product()  {
        $data = [
            'title' => 'Data Product'
    ];
    return view('administrator/product/data/datatable', $data);
    }

    public function Get_data_product(Request $request)  {
        if ($request->ajax()) {
            // Mengambil data dari model dengan join
            $data = $this->Products
            ->select('product.*','ms_category.name_category')
            ->leftJoin('ms_category','product.id_category','=','ms_category.id_category')
            ->orderBy('product.name_product', 'DESC')->get();
        
            // Cek apakah ada parameter pencarian
            if ($request->has('search') && !empty($request->input('search')['value'])) {
                $searchTerm = $request->input('search')['value'];
                // Pastikan kolom fullname ada di table
                $data->where('product.name_product', 'LIKE', "%{$searchTerm}%");
            }


            // Menyusun DataTables
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('description_product', function($row){
                    return '<textarea class="form-control"  name="komentar" rows="1" cols="2" readonly>'.$row->description_product.'</textarea>';
                })

                ->addColumn('action', function($row){
                    $editUrl = route('Administrator.edit.product', Crypt::encrypt($row->id_product));
                    $deleteUrl = route('Administrator.delete.product', Crypt::encrypt($row->id_product));
                    $btn = '<form action="'.$editUrl.'" method="POST" style="display:inline;">
                                    ' . csrf_field() . '
                                    <input type="hidden" name="id" value="'.Crypt::encrypt($row->id_product).'">
                                    <button type="submit" class="btn btn-pill btn-outline-orange btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </button>
                     </form>';
                    $btn .= '<form action="'.$deleteUrl.'" method="POST" style="display:inline;" id="delete-form-product-' . $row->id_product . '">
                    ' . csrf_field() . '
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" onclick="confirmDelete(' . $row->id_product . ')" class="edit btn btn-pill btn-outline-red btn-sm">  <i class="fa fa-trash"> </i></button>
                    </form>';
                    return $btn;
                })
                ->rawColumns(['action','description_product'])
                ->make(true);
        }
    }


    public function Create_product()  {

        $category = $this->Categorys->all();
        $data = [
            'title' => 'Form Create Data Product',
            'category' => $category
    ];
    return view('administrator/product/form/create', $data);
    }


    public function Store_product (ValidationProducts $request)  {
    
         try {
             // Cek apakah kategori dengan nama yang sama sudah ada
            $existingCategory = $this->Products->where('name_product', $request->input('name_product'))->first();
            if ($existingCategory) {
                return redirect()->route('Administrator.products')
                    ->with('error', 'name product already exists.');
            }
            $product = $this->Products;
            $product->name_product = $request->input('name_product');
            $product->id_category = $request->input('id_category');
            $product->description_product = $request->input('description_product');
            $product->save();
            return redirect()->route('Administrator.products')->with('success', 'Success saved data product');
         } catch (\Throwable $th) {
            return redirect()->route('Administrator.products')->with('error', 'Failed to saved data. Please try again.');
         }
    }

    public function Show_product(Request $request)  {
        $idProduct = $request->input('id');
        $decyidProduct = Crypt::decrypt($idProduct);
        $Product = $this->Products->findOrFail($decyidProduct);
        $category = $this->Categorys->all();
        $data = [
            'title' => 'Form Update Data Product',
            'category' => $category,
            'row' => $Product,
            'id' => $idProduct
    ];
    return view('administrator/product/form/updated', $data);
    }


    public function Update_product(ValidationProducts $request, $id) {
        $decyidProduct = Crypt::decrypt($id);
        $Product = $this->Products->findOrFail($decyidProduct);

        $isExist = $this->Products
        ->where('name_product', $request->input('name_product'))
        ->where('id_product', '!=', $decyidProduct) // Pastikan bukan ID yang sedang diupdate
        ->exists();

        if ($isExist) {
            return redirect()->route('Administrator.products')
                ->with('error', 'Product name already exists!');
        }

        $Product->name_product = $request->input('name_product');
        $Product->id_category = $request->input('id_category');
        $Product->description_product = $request->input('description_product');
        $Product->update();
        return redirect()->route('Administrator.products')->with('success', 'Success saved data product');

    }



    public function Destroy_product ($id) {
        try {
            $idProductDecy = Crypt::decrypt($id);
            $product = $this->Products->find($idProductDecy);
            
            if (!$product) {
                return redirect()->route('Administrator.products')
                    ->with('error', 'Data Code OR ID Not Found!');
            }

            // Jika ditemukan, lakukan penghapusan
            $product->delete();
            
            return redirect()->route('Administrator.products')->with('success', 'Success delete');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.products')->with('error', 'Failed to delete data. Please try again.');
        }
    }

}
