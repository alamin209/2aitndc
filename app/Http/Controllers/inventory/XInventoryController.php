<?php

namespace App\Http\Controllers\inventory;

use App\Inventory;
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
        $inventorycat=inventorycatagory::all();
        return view('inventory.add_category',compact('bank','inventorycat','menuname','upangshos'));
    }

    public function store(Request $request)
    {
        $id=inventorycatagory::create([
            'catgeory_name'=>$request->catgeory_name,
            'catgeory_name'=>$request->catgeory_name
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
        $inventorycat=inventorycatagory::all();
        $sub_cat=inventorysucategory::all();
        return view('inventory.subcatgory',compact('sub_cat','inventorycat','menuname','upangshos'));
    }

    public function postsubcat(Request $request){

        $id=inventorysucategory::create([
            'cat_id'=>$request->cat_id,
            'sub_cate_name'=>$request->sub_cate_name
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

        $menuname   =   'Inventory';
        $inventorycat=inventorycatagory::all();
        $sub_cat=inventorysucategory::all();
        $sup_lier=supplier::all();
        $bank        =    Bank::all();
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
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
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
            'doc_name'=>$request->doc_name,
            'branch_id'=>$branch_id,
            'bankact'=>$bank_acc,
            'doc_name'=>$fileName,
            'purchase_date'=> $request->purchase_date,
            'sub_cat'=> $request->sub_cat,
            'purchase_cost'=> $request->purchase_cost,
        ]);
        $id=$inventory->id;

        $bankdetails= BankDetails::where('bank_details_id', $bank_acc)->first();
        $amount=$bankdetails->update_balance - $request->purchase_cost;
        $type=$bankdetails->type;
        BankDetails::where('bank_details_id', $bank_acc) ->update([
            'update_balance'       => $amount,
        ]);


        $trx_record = trx_record::create([
            'table_id'                  => 12,
            'table_incrment_id'         => $id,
            'amount_type'               => 2,
            'branchid'                  => $branch_id,
            'acount_details_id'         => $bank_acc,
            'amount'                    =>  $request->purchase_cost ,
            'trx_date'                  => $request->purchase_date ,
            'pay_type'                  => $type,
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
        $qty=$request->qty;

        $productqty=Inventory::where('id',$product_id)->first();

        $qty=$productqty->quantity - $qty;

        Inventory::where('id', $product_id) ->update([
            'quantity'        => $qty,
        ]);


        $id=damage::create([
            'cat_id'=>$request->cat_id,
            'sub_cat'=>$request->sub_cat,
            'prodct_id'=>$product_id,
            'remark'=>$request->remark,
            'qty'=>$qty ,
        ]);


        if(!empty($id)){

            $message='Product Damage Record add Successfully ';
        }else{
            $message='Product  Damage Record Added Fail ';
        }
        return redirect()->back()->with('message', $message);

    }




}
