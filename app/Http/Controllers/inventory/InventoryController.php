<?php

namespace App\Http\Controllers\inventory;

use App\Employee;
use App\Inventory;
use App\Product_distribution;
use App\trx_records_shuki;
use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use App\inventorycatagory;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use App\inventorysucategory;
use App\supplier;
use App\Bank;
use App\BankDetails;
use file;
use App\trx_record;
use App\damage;
class InventoryController extends Controller
{

    public function index()
    {
        $menuname   =   'Inventory';
        $inventorycat = inventorycatagory::all();
        return view('inventory.add_category',compact('bank','inventorycat','menuname','upangshos'));
    }

    public function store(Request $request)
    {
        $id=inventorycatagory::create([
            'catgeory_name'=>$request->catgeory_name,
            'depricit'=>$request->depricit,
           // 'status'=>$request->status
        ]);
        if(!empty($id)){

            $message='Inventory  Category Added Successfully ';
        }else{
            $message='Inventory  Category Added Fail ';
         }
         return redirect()->back()->with('message', $message);

    }
    public function create()
    {

        $menuname   =   'Inventory';
        $inventorycat= inventorycatagory::all();
        $sub_cat= inventorysucategory::all();
        return view('inventory.subcatgory',compact('sub_cat','inventorycat','menuname','upangshos'));
    }

    public function postsubcat(Request $request){

        $id=inventorysucategory::create([
            'cat_id'=>$request->cat_id,
            'sub_cate_name'=>$request->sub_cate_name,
            'note'=>$request->note
        ]);
        if(!empty($id)){

            $message='Inventory  Sub Category Added Successfully ';
        }else{
            $message='Inventory   Sub Category  Added Fail ';
        }
        return redirect()->back()->with('message', $message);
    }

    public function add_supplier()
    {
        $menuname   =   'Inventory';
        $suplier    =    supplier::all();
        return view('inventory.add_supplier',compact('suplier','inventorycat','menuname','upangshos'));
    }

    public function add_supplierstore(Request $request){
        $id=supplier::create([
            'name'=>$request->name,
            'companey_name'=>$request->companey_name,
            'address'=>$request->address
        ]);
        if(!empty($id)){

            $message='Supplier  Added Successfully ';
        }else{
            $message='Supplier Added Fail ';
        }
        return redirect()->back()->with('message', $message);
    }
    public function addproduct()
    {

        $menuname   	=   'Inventory';
        $inventorycat	=  	inventorycatagory::all();
        $sub_cat		= 	inventorysucategory::all();
        $sup_lier		= 	supplier::all();

		
        return view('inventory.purchaseproduct',compact('bank','sup_lier','sub_cat','inventorycat','menuname','upangshos'));
    }

    public function getsubcategory(Request $request){
        $cat=$request->category;
        $sub_cat=inventorysucategory::where('cat_id',$cat)->get();
        $data        =   '<option value="">Select Sub Category</option>';
        foreach($sub_cat as $tp){

            $data .= '<option value="'.$tp->id.'">'.$tp->sub_cate_name.'</option>';
        }
        echo $data;

    }
    public function getpaymenttype(Request $request){
        $payment=$request->payment_type;
        if($payment==1){
            $sub_cat=BankDetails::where('type',1)->get();
            $data        =   '<option value="">Select  Bank</option>';
            foreach($sub_cat as $tp){

                $data .= '<option value="'.$tp->bank_details_id.'">'.$tp->acc_no.'</option>';
            }
            echo $data;
            exit();

        }elseif($payment==2){

            $sub_cat=BankDetails::whereIn('type', [ 2, 3])->get();
            $data        =   '<option value="">Select Cash Type</option>';
            foreach($sub_cat as $tp){
                $data .= '<option value="'.$tp->bank_details_id.'">'.$tp->acc_no.'</option>';
            }
            echo $data;
            exit();
        }

    }
    public function storeproduct(Request $request){


        $path = 'public/admin/inventorydocument';


        $fileName = null;
        if (request()->hasFile('doc_name')) {
            $file = $request->file('doc_name');
            $fileName = $file->getClientOriginalName();
            $file->move($path, $fileName);
        }

        $bank_acc=$request->bankact;
        if(empty($bank_acc)){
            $bank_acc=$request->acount_no;
        }

        $branch_id=$request->branch_id;

        $inventory=Inventory::create([
		
            'sup_id'=>$request->sup_id,
            'cat_id'=>$request->cat_id,
            'sub_cat'=>$request->sub_cat,
            'product_name'=>$request->product_name,
            'quantity'=>$request->quantity,
            'total_qty'=>$request->quantity,
            'user_id'=>Auth()->id(),
            'branch_id'=>$branch_id,
            'inco_cat'=>9,
            'inco_type'=>10,
            'bankact'=>$bank_acc,
            'doc_name'=>$fileName,
            'purchase_date'=> $request->purchase_date,
             
            'purchase_cost'=> $request->purchase_cost,
        ]);
		
        $id=$inventory->id;


        $trx_record = trx_records_shuki::create([
            'table_id'                  => 12,
            'table_incrment_id'         => $id,
            'amount_type'               => 2,
            'branchid'                  => $branch_id,
            'acount_details_id'         => $bank_acc,
            'amount'                    =>  $request->purchase_cost ,
            'trx_date'                  => $request->purchase_date ,
            'pay_type'                  => 0,
        ]);
        if(!empty($id)){

            $message='Product  Added Successfully ';
        }else{
            $message='Product  Added Fail ';
        }
        return redirect()->back()->with('message', $message);
    }

    public function createdamageproduct(){
        $menuname   =   'Inventory';
        $inventorycat=inventorycatagory::all();
        $sub_cat=inventorysucategory::all();
        $sup_lier=supplier::all();
        $bank        =    Bank::all();
        return view('inventory.damage_product',compact('bank','sup_lier','sub_cat','inventorycat','menuname','upangshos'));


    }

    public function getproductfrominventory(Request $request){
        $cat=$request->prod;
        $sub_cat=Inventory::where('sub_cat',$cat)->get();
        $data        =   '<option value="">Select product</option>';
        foreach($sub_cat as $tp){

            $data .= '<option value="'.$tp->id.'">'.$tp->product_name.'</option>';
        }
        echo $data;
    }

    public function storeedamageproduct(Request $request){

        $product_id=$request->prodct_id;
        $qty1=$request->qty;

        $productqty=Inventory::where('id',$product_id)->first();

        $qty=$productqty->quantity - $qty1;

        Inventory::where('id', $product_id) ->update([
            'quantity'        => $qty,
        ]);


        $id=damage::create([
            'cat_id'=>$request->cat_id,
            'sub_cat'=>$request->sub_cat,
            'prodct_id'=>$product_id,
            'remark'=>$request->remark,
            'qty'=>$qty1 ,
        ]);


        if(!empty($id)){

            $message='Product Damage Record add Successfully ';
        }else{
            $message='Product  Damage Record Added Fail ';
        }
        return redirect()->back()->with('message', $message);

    }


    public function subcategory_id(Request $request){

        $subcategory_id=$request->subcategory_id;

        $sub_cat=Inventory::where('sub_cat',$subcategory_id)->get();
        $data        =   '<option value="">Select product</option>';
        foreach($sub_cat as $tp){

            $data .= '<option value="'.$tp->id.'">'.$tp->product_name.'</option>';
        }
        echo $data;

    }

    public function product_report(){


        $menuname   	=   'Inventory';
        $inventorycat	=  	inventorycatagory::all();
        $sub_cat		= 	inventorysucategory::all();
        $sup_lier		= 	supplier::all();
        $all_product    =  Inventory::select('*' ,'inventories.id as id' )
                            // ->leftJoin('product_distributions', 'inventories.id',                '=',  'product_distributions.product_id')
                             ->leftJoin('inventorycatagories', 'inventories.cat_id',                '=',   'inventorycatagories.id')
                             ->leftJoin('inventorysucategories', 'inventories.sub_cat',             '=',   'inventorysucategories.id')
                             ->leftJoin('suppliers', 'inventories.sup_id',                          '=',   'suppliers.id')
                             ->get();


        return view('inventory.purchase_product_details_show',compact('bank','sup_lier','sub_cat','inventorycat','menuname','upangshos','all_product'));



    }

    public function product_distribution(){

        $menuname   =   'Inventory';
        $inventorycat=inventorycatagory::all();
        $sub_cat=inventorysucategory::all();
        $sup_lier=supplier::all();
        $bank        =    Bank::all();
        $employ= Employee::all();
        return view('inventory.product_distribute',compact('bank','sup_lier','sub_cat','inventorycat','menuname','upangshos','employ'));


    }

    public function product_distribution_stor(Request $request){


        $product_id              = $request->product_id;
        $empl_id                = $request->empl_id;
        $date_ofdistribution    = $request->date_ofdistribution;

        $qty1                  =  $request->qty;

        $productqty            =  Inventory::where('id',$product_id)->first();


        if( $qty1 > $productqty->quantity){

            return redirect()->back()->with('err-message', 'This item excited the total Quantity');

        }

        $qty=$productqty->quantity - $qty1;

        Inventory::where('id', $product_id) ->update([
            'quantity'        => $qty,
        ]);


        $id=Product_distribution::create([
              'product_id'=>$product_id,
              'remark'=>$request->renmark,
              'empl_id'=>$empl_id,
              'user_id'=>auth()->id(),
              'distibuted_qty'=>$qty1 ,
              'date_ofdistribution'=>$date_ofdistribution ,
        ]);


        if(!empty($id)){
            $message='Product Distributed Successfully ';
        }else{
             $message='Product   Distributed  Fail ';
         }
        return redirect()->back()->with('message', $message);

    }

      public function print_product(){

          $menuname   =   'Inventory';
          $bank        =    Bank::all();
           $all_product_prints=Inventory::all();
          return view('inventory.print_product',compact('bank','sup_lier','sub_cat','inventorycat','menuname','upangshos','all_product_prints'));

      }

    public function print_product_process(Request $request, $id)
    {

        $product =Inventory::where('id',$id)->first();
        $menuname = 'Inventory';
        return view('inventory.product_slip_print', compact('menuname', 'product', 'copy'));
    }


}
