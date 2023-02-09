<?php

namespace App\Http\Controllers;

use App\Mail\sendMesseges;
use App\Models\Customer;
use App\Models\Email;
use App\Models\Event;
use App\Models\Logbook;
use App\Models\Page;
use App\Models\Project;
use App\Models\Script;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CustomersController extends Controller
{

    //
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('customers.customers-overview', compact('customers'));
    }

    public function details($cId)
    {
        $customers = Customer::find($cId);
        $messages = Email::where('customer_id', $cId)->orderBy('created_at', 'DESC')->get();

        return view('customers.customer-details', compact('customers', 'messages'));
    }
    public function pages()
    {
        $pages = Page::where('user_id',Auth::id())->get();
        return view('PDF.page',compact('pages'));
    }
//    public function sendMessage(Request $request)
//    {
//        $details = [
//           // 'subject' => $request->subject,
//            'message' => $request->message,
//        ];
//        Mail::to('jfroosama10@gmail.com')->send(new sendMesseges($details));
//        return back()->with('message_send', 'send successfully');
//    }
    public function logAdd($title,$id,$type, $description)
    {
        $log = new Logbook();
        $log->user_id = Auth::id();
        $log->title = $title;
        $log->type = $type;
        $log->id_of = $id;
        $log->description = $description;
        $log->save();
    }
    public function getCustomersInTap($cId)
    {
        $customers = Customer::find($cId);
        $messages = Email::where('customer_id', $cId)->orderBy('created_at', 'DESC')->get();
        $data = view('includes.customer-tab', compact('customers', 'messages'))->render();
        return response()->json($data);
    }

    public function getCustomers()
    {
        $customers = Customer::get();
        $data = view('includes.customers-table', compact('customers'))->render();
        return response()->json($data);
    }

    public function form()
    {
        return view('customers.customers');
    }

    public function addCustomer(Request $request)
    {
        $new = new Customer();
        $new->fullname = $request->fullname;
        $new->email = $request->email;
        $new->description = $request->description;
        $new->address = $request->adress;
        $new->address_sec = $request->Secadress;
        $new->city = $request->city;
        $new->zip = $request->zip;
//dd($request->all());
        $new->save();
        $this->logAdd($new->fullname,$new->id,'add','Customer');

        return response()->json('success');
    }

    public function editCustomer($cId)
    {
        $Customer = Customer::find($cId);

        return response()->json([
            'status' => 200,
            'customer' => $Customer
        ]);
    }

    public function saveCustomer($cId, Request $request)
    {
        $edit = Customer::find($cId);
        $edit->fullname = $request->fullname_edit;
        $edit->email = $request->email_edit;
        $edit->description = $request->description_edit;
        $edit->address = $request->adress_edit;
        $edit->address_sec = $request->Secadress_edit;
        $edit->city = $request->city_edit;
        $edit->zip = $request->zip_edit;

        $edit->save();
        $this->logAdd($edit->fullname,$edit->id,'edit','Customer');

        return response()->json();
    }

    public function deleteCustomer($cId)
    {
        Customer::find($cId)->delete();
        if ($cId != null){
           $pro = Project::where('customer_id',$cId)->delete();
        }
        $this->logAdd('non',$cId,'delete', $pro == true ? 'Customer & Project' : 'Customer ' );
//    Book::find($eId)->delete();
    }

    public function trash()
    {
        $customerTrash = Customer::onlyTrashed()->get();
        $projectTrash = Project::onlyTrashed()->get();
        return view('trash',compact('customerTrash','projectTrash'));
    }
public function restore($cId)
{
    $customer = Customer::onlyTrashed()->find($cId);
    $project = Project::onlyTrashed()->where('customer_id',$cId);
    if ($customer == true){

        $customer->restore();
    }else{

        $project->restore();
    }
    return back();
}
    public function forceDelete($cId)
    {
        $customer = Customer::onlyTrashed()->find($cId);
        $project = Project::onlyTrashed()->where('customer_id',$cId);
        if ($customer == true){
            $customer->forceDelete();
        }else{
            $project->forceDelete();
        }
        return back();
    }
    public function PDF(Request $request)
    {
        $customers = Customer::get();
        //  $messages = Email::where('customer_id',$cId)->orderBy('created_at','DESC')->get();

        if ($request->has('download')) {
            \Barryvdh\DomPDF\Facade\Pdf::setOptions(['dpi' => '150', 'defaultFont' => 'sans-serif']);
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('Page.pdf-details');
            return $pdf->download('Page.pdf-details');
        }
        return view('Page.pdf-details', compact('customers'));
    }

    public function createPDFv($cId)
    {

        $messages = Email::where('customer_id', $cId)->orderBy('created_at', 'DESC')->get();
        $customers = Customer::find($cId);
        // $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('Page.pdf-details');
        //  return $pdf->download('Page.pdf-details');
        return view('Page.pdf-details', compact('customers', 'messages'));
    }

    public function createPDFy($cId)
    {
        $data = Customer::findOrFail($cId);
        $messages = Email::where('customer_id', $cId)->orderBy('created_at', 'DESC')->get();

        view()->share('customers', $data);
        view()->share('messages', $messages);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('PDF.pdf-details')
            ->setPaper('a4', 'potrait')
            ->setWarnings(false);
        return $pdf->stream();
    }

    public function viewPDF($pId)
    {
        $page = Page::find($pId);

$scripts = Script::where('page_id',$pId)->get();
        return view('PDF.view-PDF', compact('scripts','page'));
    }
    public function scriptsView($pId)
    {
        $scripts = Script::where('page_id',$pId)->get();
        $page = Page::find($pId);
        $data = view('includes.scripts-load', compact('scripts','page'))->render();
        return response()->json($data);
    }
public function addScripts(Request $request)
{

    $new = new Script();
    $new->user_id = Auth::id();
    $new->description = $request->description;
    $new->page_id = $request->pageId;
    $new->save();
    return response()->json();
}
public function deleteScripts($sId)
{
    Script::find($sId)->delete();
}
    public function createPDF($pId)
    {
        $data = Page::where('user_id', Auth::id());
        $scripts = Script::where('page_id',$pId)->get();

        view()->share('data', $data);
        view()->share('scripts', $scripts);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('PDF.create-PDF')
            ->setPaper('a4', 'potrait')
            ->setWarnings(false);
        return $pdf->stream();
    }

    public function search() {
        $search = $_GET['searchQuery'];

        $query = Customer::where('fullname', 'like', '%'.$search.'%');
        $customers = $query->paginate(10);

        $data = view('includes.customers-table', compact('customers'))->render();
        return response()->json($data);
    }

}
