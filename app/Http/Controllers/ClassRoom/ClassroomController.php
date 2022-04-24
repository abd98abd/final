<?php
namespace App\Http\Controllers\Classroom;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Models\Classroom as ModelsClassroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $My_Classes = ModelsClassroom::all();
        $grade = Grade::all();
        return view('pages.My_Classes.My_Classes', compact('My_Classes','grade'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassroom $request)
    {

        $List_Classes = $request->List_Classes;

        try {

            foreach ($List_Classes as $List_Class) {

                $My_Classes = new ModelsClassroom();

                $My_Classes->Name_Class = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];

                $My_Classes->Grade_id = $List_Class['Grade_id'];

                $My_Classes->save();

            }

            toastr()->success(trans('messages.success'));
            return redirect()->route('classroom.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {
        try{

        $edit = ModelsClassroom::findOrFail($request->id);

        $edit->update([


            $edit->Name_Class = ['ar' => $request->Name, 'en' => $request->Name_en],
            $edit->Grade_id = $request->Grade_id,
        ]);
        toastr()->success(trans('messages.Update'));
        return redirect()->route('classroom.index');







    }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $delete = ModelsClassroom::findOrFail($request->id);
        $delete->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('classroom.index');
    }

    public function delete_all(Request $request)
    {

        $delete_all_id = explode(",", $request->delete_all_id);

        ModelsClassroom::whereIn('id', $delete_all_id)->Delete();

        toastr()->error(trans('messages.Delete'));

        return redirect()->route('classroom.index');

    }

   public function Filter_Classes(Request $request)
    {
        $grade = Grade::all();

        $Search = ModelsClassroom::select('*')->where('Grade_id','=',$request->Grade_id)->get();


        return view('pages.My_Classes.My_Classes',compact('grade'))->withDetails($Search);

    }
}
