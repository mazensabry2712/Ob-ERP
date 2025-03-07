<?php

namespace App\Http\Controllers;

use App\Models\Cust;
use App\Models\custs_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $custs=cust::all() ;
        return view("dashboard.customer.index",compact("custs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'abb' => 'nullable|string|max:255'??null,
            'tybe' => 'nullable|in:GOV,PRIVATE'??null,
            'logo' => 'nullable|file|mimes:jpeg,png,gif,webp,pdf,doc,docx,svg|max:2048',

            // 'logo' => 'nullable|file|mimetypes:image/jpeg,image/png,image/gif,image/webp,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/svg+xml|max:2048'??null,
            'customercontactname' => 'nullable|string|max:255'??null,
            'customercontactposition' => 'nullable|string|max:255'??null,
            'email' => 'nullable|email|max:255'??null, 
            'phone' => 'nullable|string|max:15'??null, 
        ]);
        
        // التحقق من وجود اسم مكرر
        $b_exists = Cust::where('name', $validatedData['name'])->exists();

// التحقق من وجود ملف الصورة
if ($request->hasFile('logo')) {

    $file = $request->file('logo');
    $path = $file->store('uploads',[
        'disk' => 'public'
    ]);

    $data['logo'] = $path;
    //$cust_id = Cust::latest()->first()->id; 
    // $cust_id = Cust::latest()->first();// الحصول على آخر عميل مضاف
    // $image = $request->file('logo');
    // $file_name = $image->getClientOriginalName();
    // $cust_number = $request->cust_number;

    // حفظ تفاصيل المرفق
    // $attachments = new custs_attachments();
    // $attachments->file_name = $file_name;
    // $attachments->cust_number = $cust_number;
    // $attachments->Created_by = Auth::user()->name;
    // $attachments->cust_id = $cust_id;
    // $attachments->save();

    // نقل الصورة إلى المجلد المحدد
    // $imageName = $request->logo->getClientOriginalName();
    // $request->logo->move(public_path('Attachments/' . $cust_number), $imageName);
}

// التحقق إذا كان العميل موجودًا بالفعل
if ($b_exists) {
    session()->flash('Error', 'The name already exists');
    return redirect('/customer');
}

// إذا كانت البيانات سليمة، يتم حفظها
Cust::create($validatedData);

// إضافة رسالة النجاح
session()->flash('Add', 'Customer registration successful');

// العودة إلى الصفحة السابقة أو إعادة توجيه
//return back(); // أو 
return redirect('/customer'); //حسب الحاجة













      
        // if ($request->hasFile('logo')) {

        //     $cust_id = Cust::latest()->first()->id;
        //     $image = $request->file('logo');
        //     $file_name = $image->getClientOriginalName();
        //     $cust_number = $request->cust_number;

        //     $attachments = new custs_attachments();
        //     $attachments->file_name = $file_name;
        //     $attachments->cust_number = $cust_number;
        //     $attachments->Created_by = Auth::user()->name;
        //     $attachments->cust_id = $cust_id;
        //     $attachments->save();

        //     // move logo
        //     $imageName = $request->logo->getClientOriginalName();
        //     $request->logo->move(public_path('Attachments/' . $cust_number), $imageName);
        // }

        // session()->flash('Add', 'Customer registration successful');
        // return back();


        // if ($b_exists) {
        //     session()->flash('Error', 'The name already exists');
        //     return redirect('/customer');
        // } else {
        //     // حفظ البيانات في قاعدة البيانات
        //     Cust::create($validatedData);
            
        
        //     session()->flash('Add', 'Customer registration successful');
        //     return redirect('/customer');
        // }


        
     







    }

    /**
     * Display the specified resource.
     */
    public function show(Cust $cust)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cust $cust)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
    
        // التحقق من صحة البيانات
        $this->validate($request, [
            'name' => 'required|string|max:255'.$id,
            'abb' => 'nullable|string|max:255',
            'tybe' => 'nullable|in:GOV,PRIVATE',
             'logo' => 'nullable|file|mimetypes:image/jpeg,image/png,image/gif,image/webp,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/svg+xml|max:2048',
            'customercontactname' => 'nullable|string|max:255',
            'customercontactposition' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255', 
            'phone' => 'nullable|string|max:15', 
        ]);
    
        // العثور على العنصر وتحديث
        $aams = Cust::findOrFail($id); // نستخدم findOrFail للتأكد من وجود العنصر
        $aams->update([
            'name' => $request->name,
            'abb' => $request->abb,
            'tybe' => $request->tybe,
            'logo' => $request->logo,
            'customercontactname' => $request->customercontactname,
            'customercontactposition' => $request->customercontactposition,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
    
        // رسالة تأكيد وإعادة توجيه
        session()->flash('edit', 'The section has been successfully modified');
        return redirect('/customer'); // إعادة التوجيه إلى صفحة الأقسام
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
        Cust::find($id)->delete();
        session()->flash('delete', 'Deleted successfully');
             return redirect('/customer');
    }
}
