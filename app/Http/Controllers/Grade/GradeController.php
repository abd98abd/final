<?php


namespace App\Http\Controllers\Grade;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Http\Controllers\Grade\StoreGrades;
use App\Http\Requests\StoreGrades as RequestsStoreGrades;
use Illuminate\Http\Request;
use App\Http\Controllers\Grade\toastr;
use App\Http\Controllers\Grade\Classroom;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $Grades = Grade::all();
    return view('pages.Grade.Grades',compact('Grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(RequestsStoreGrades $request)
  {

    if(Grade::where('Name->ar',$request->Name)->orWhere('Name->en',$request->Name_en)->exists()){


   return redirect()->back()->withErrors(trans('grade_trans.existss'));


    }


    try{



 $Grade = new Grade();

    $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];

    $Grade->Note = $request->Notes;

    $Grade->save();

    toastr()->success( trans('messages.success'));

    return redirect()->back();




    }

catch(\Exception $e){

return redirect()->back()->withErrors(['error'=>$e->getMessage()]);


}








  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update( RequestsStoreGrades $request)
  {



    try {

        $validated = $request->validated();
        $Grades = Grade::findOrFail($request->id);
        $Grades->update([
          $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
          $Grades->Note = $request->Notes,
        ]);
        toastr()->success(trans('messages.Update'));
        return redirect()->route('grades.index');
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
   * @return Response
   */

  public function destroy(Request $request)
  {


          Grade::findOrFail($request->id)->delete();

          toastr()->error(trans('messages.Delete'));
          return redirect()->route('grades.index');




      /*  if (App::getLocale() == 'en'){




        }
     elseif(App::getLocale() == 'ar'){

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('grades.index');



      }
*/






}

  }



