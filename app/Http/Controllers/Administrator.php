<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
// use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ValidationCategory;
use App\Http\Requests\ValidationProducts;
use App\Http\Requests\ValidationProductPrice;
use App\Models\Categorys;
use App\Models\Products;
use App\Models\Price;

use function App\Helpers\indo_currency;

class Administrator extends Controller
{
    protected $Categorys;
    protected $Products;
    protected $Price;
    public function __construct(Categorys $Categorys, Products $Products, Price $Price) {
        $this->Categorys = $Categorys;
        $this->Products = $Products;
        $this->Price = $Price;
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



   public function Price_product()  {
    $data = [
        'title' => 'Data Price Product'
    ];
       return view('administrator/product-price/data/datatable', $data);
    }


    public function Get_data_product_price(Request $request)  {
        if ($request->ajax()) {
            // Mengambil data dari model dengan join
            $data = $this->Price
            ->select('ms_prices.*','product.name_product','product.description_product','ms_category.name_category')
            ->leftJoin('product','ms_prices.product_id','=','product.id_product')
            ->leftJoin('ms_category','product.id_category','=','ms_category.id_category')
            ->orderBy('id_price', 'DESC')->get();
        
            // Cek apakah ada parameter pencarian
            if ($request->has('search') && !empty($request->input('search')['value'])) {
                $searchTerm = $request->input('search')['value'];
                // Pastikan kolom fullname ada di table
                $data->where('price', 'LIKE', "%{$searchTerm}%");
            }


            // Menyusun DataTables
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('price', function($row){
                    return indo_currency($row->price);
                })

                ->addColumn('start_date', function($row){
                    return format_date_indonesia_old($row->start_date);
                })

                ->addColumn('end_date', function($row) {
                    return $row->end_date ? format_date_indonesia_old($row->end_date) : 'Tidak ada data';
                })

                ->addColumn('description_product', function($row){
                    return '<textarea class="form-control"  rows="2" cols="2" readonly>'.$row->description_product.'</textarea>';
                })
                

                ->addColumn('action', function($row){
                    $editUrl = route('Administrator.edit.product.price', Crypt::encrypt($row->id_price));
                    $deleteUrl = route('Administrator.delete.product.price', Crypt::encrypt($row->id_price));
                    $btn = '<a href="'.$editUrl.'" class="btn btn-pill btn-outline-orange btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>';
                    $btn .= '<form action="'.$deleteUrl.'" method="POST" style="display:inline;" id="delete-form-productPrice-' . $row->id_price . '">
                    ' . csrf_field() . '
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" onclick="confirmDelete(' . $row->id_price . ')" class="edit btn btn-pill btn-outline-red btn-sm">  <i class="fa fa-trash"> </i></button>
                    </form>';
                    return $btn;
                })
                ->rawColumns(['action','description_product'])
                ->make(true);
        }
    }


    public function Create_product_price()  {

        $product = $this->Products
        ->leftJoin('ms_prices', 'product.id_product', '=', 'ms_prices.product_id')
        ->whereNull('ms_prices.product_id') // Hanya produk yang belum ada di tabel price
        ->select('product.*') // Pilih hanya kolom dari tabel products
        ->get();

        $data = [
            'title' => 'Form Create Price Product',
            'product' => $product
        ];
           return view('administrator/product-price/form/create', $data);
    }
   


    public function Store_price_product(ValidationProductPrice  $request)  {
       
        try {
            $cleanPrice = str_replace('.', '', $request->input('prices'));  
            $productPrice = $this->Price;
            $productPrice->price = $cleanPrice;
            $productPrice->product_id = $request->input('product_id');
            $productPrice->start_date = $request->input('start_date');
            $productPrice->end_date = $request->input('end_date');
            $productPrice->save();
            return redirect()->route('Administrator.price.products')->with('success', 'Success save data');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.price.products')->with('error', 'Failed to save data. Please try again.');
        }
    }


   public function Show_product_price ($id)  {

    $product = $this->Products
    ->leftJoin('ms_prices', 'product.id_product', '=', 'ms_prices.product_id')
    ->select('product.*') // Pilih hanya kolom dari tabel products
    ->get();
   
    // $idProductPrice = $request->input('id');
    $decyidProductPrice = Crypt::decrypt($id);

    $getDataProductPrice = $this->Price
                          ->leftJoin('product','product.id_product','=','ms_prices.product_id')
                          ->where('id_price', $decyidProductPrice)
                          ->select('ms_prices.*', 'product.name_product','product.id_product')
                          ->first();

    $data = [
        'title' => 'Form Update Price Product',
        'row' => $getDataProductPrice,
        'id' => $id,
        'product' => $product
       
    ];
       return view('administrator/product-price/form/update', $data);
    }


    public function Update_product_price(ValidationProductPrice  $request, $id)  {
        try {

            $decyidProductPrice = Crypt::decrypt($id);

            $cleanPrice = str_replace('.', '', $request->input('prices'));  

            $productPrice = $this->Price->findOrFail($decyidProductPrice);
            $productPrice->price = $cleanPrice;
            // $productPrice->product_id = $request->input('product_id');
            $productPrice->start_date = $request->input('start_date');
            $productPrice->end_date = $request->input('end_date');
            $productPrice->update();

            return redirect()->route('Administrator.price.products')->with('success', 'Success update data');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.price.products')->with('error', 'Failed to update data. Please try again.');
        }
    }


    public function Destroy_product_price($id)  {
        try {
            $idProductPriceDecy = Crypt::decrypt($id);
            $productPrice = $this->Price->find($idProductPriceDecy);
            
            if (!$productPrice) {
                return redirect()->route('Administrator.price.products')
                    ->with('error', 'Data Code OR ID Not Found!');
            }
            // Jika ditemukan, lakukan penghapusan
            $productPrice->delete();
            
            return redirect()->route('Administrator.price.products')->with('success', 'Success delete');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.price.products')->with('error', 'Failed to delete data. Please try again.');
        }
    }




public function Price_product_report_excel_all_data()
{
    // Ambil semua data laporan
    $ReportAll = $this->Price
        ->leftJoin('product', 'ms_prices.product_id', '=', 'product.id_product')
        ->leftJoin('ms_category', 'product.id_category', '=', 'ms_category.id_category')
        ->select('ms_prices.*', 'product.name_product', 'product.description_product', 'ms_category.name_category')
        ->get();

    // Buat spreadsheet baru
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Menambahkan header dengan penamaan yang lebih baik
    $headers = [
        'A1' => 'No',
        'B1' => 'Product Name',
        'C1' => 'Product Price',
        'D1' => 'Start Date',
        'E1' => 'End Date',
        'F1' => 'Description',
        'G1' => 'Category Product',
    ];

    foreach ($headers as $cell => $text) {
        $sheet->setCellValue($cell, $text);
    }

    // Styling untuk header (PERBAIKAN: A1:G1)
    $headerStyle = [
        'font' => ['bold' => true, 'size' => 12],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'D9D9D9'], // Warna abu-abu muda
        ],
    ];
    $sheet->getStyle('A1:G1')->applyFromArray($headerStyle); // PERBAIKAN: A1:G1

    // Menambahkan data ke dalam file Excel
    $row = 2;
    $no = 1;
    foreach ($ReportAll as $rep) {
        $sheet->setCellValue('A' . $row, $no);
        $sheet->setCellValue('B' . $row, $rep->name_product ?? 'Unknown');
        $sheet->setCellValue('C' . $row, $rep->price); // PERBAIKAN: Tidak perlu explicit type
        $sheet->setCellValue('D' . $row, $rep->start_date);
        $sheet->setCellValue('E' . $row, $rep->end_date);
        $sheet->setCellValue('F' . $row, $rep->description_product);
        $sheet->setCellValue('G' . $row, $rep->name_category);
        
        $row++;
        $no++;
    }

    // Set AutoSize untuk setiap kolom agar rapi
    foreach (range('A', 'G') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Styling teks agar lebih rapi
    $sheet->getStyle('A2:A' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // No
    $sheet->getStyle('B2:B' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); // Product Name
    $sheet->getStyle('C2:C' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT); // Price
    $sheet->getStyle('D2:E' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Start & End Date
    $sheet->getStyle('F2:F' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); // Description
    $sheet->getStyle('G2:G' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Category

    // Menyimpan dan mengunduh file Excel
    $writer = new Xlsx($spreadsheet);
    $filename = 'price_product_report_' . date('Y-m-d_H-i-s') . '.xlsx';

    return response()->stream(
        function () use ($writer) {
            $writer->save('php://output');
        },
        200,
        [
            "Content-Type" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            "Content-Disposition" => "attachment; filename={$filename}",
        ]
    );
}



    public function Price_product_report_pdf_all_data() {
         // Ambil data dari database
            $reportsAll = $this->Price
            ->leftJoin('product', 'ms_prices.product_id', '=', 'product.id_product')
            ->leftJoin('ms_category', 'product.id_category', '=', 'ms_category.id_category')
            ->select('ms_prices.*', 'product.name_product', 'product.description_product', 'ms_category.name_category')
            ->get();

        // Load tampilan HTML
        $html = view('administrator/product-price/report/pdf', compact('reportsAll'))->render();

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Helvetica');  // Set font default
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);  // Jika ingin memuat gambar dari URL

        // Inisialisasi Dompdf
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); // Ukuran kertas


        // Render PDF
        $dompdf->render();

        // Nama file PDF yang akan diunduh
        $filename = 'price_product_report_' . date('Y-m-d') . '.pdf';

        // Unduh PDF
        return response()->streamDownload(
            fn () => print($dompdf->output()),
            $filename,
            ["Content-Type" => "application/pdf"]
        );
    }



    public function Price_product_report_csv_all_data()  {
          //ambil semua data laporan
          $reportsAll = $this->Price
            ->leftJoin('product', 'ms_prices.product_id', '=', 'product.id_product')
            ->leftJoin('ms_category', 'product.id_category', '=', 'ms_category.id_category')
            ->select('ms_prices.*', 'product.name_product', 'product.description_product', 'ms_category.name_category')
            ->get();
          // Buat spreadsheet baru
          $spreadsheet = new Spreadsheet();
 
          // Set sheet aktif
          $sheet = $spreadsheet->getActiveSheet();
 
          // Menambahkan judul kolom
         $sheet->setCellValue('A1', 'No');
         $sheet->setCellValue('B1', 'Product Name');
         $sheet->setCellValue('C1', 'Price');
         $sheet->setCellValue('D1', 'Price Start Date');
         $sheet->setCellValue('E1', 'Price End Date');
         $sheet->setCellValue('F1', 'Description Product');
         $sheet->setCellValue('G1', 'Product Category');
 
         // Menambahkan data ke dalam file Excel
         $row = 2; // Mulai dari baris kedua setelah header
         $no = 1;
         foreach ($reportsAll as $rep) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $rep->name_product ?? 'Unknown');
            $sheet->setCellValue('C' . $row, $rep->price); // PERBAIKAN: Tidak perlu explicit type
            $sheet->setCellValue('D' . $row, $rep->start_date);
            $sheet->setCellValue('E' . $row, $rep->end_date);
            $sheet->setCellValue('F' . $row, $rep->description_product);
            $sheet->setCellValue('G' . $row, $rep->name_category);
             $row++;
             $no++;
         }
 
         // Menyimpan dan mengunduh file Excel
         $writer = new Csv($spreadsheet);
 
         // Menghasilkan output langsung sebagai unduhan
         $filename = 'price_product_report_' . date('Y-m-d_H-i-s') . '.csv';
         return response()->stream(
             function () use ($writer) {
                 $writer->save('php://output');
             },
             200,
             [
                 "Content-Type" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                 "Content-Disposition" => "attachment; filename={$filename}",
             ]
         );
    }


}
