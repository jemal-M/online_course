<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index(){
        $courses=course::with('category','instructor')
        ->latest()
        ->paginate(10);
     return Inertia::render('Courses/Index',['courses'=>$courses]);
    }

    public function create(){
    $categories=Category::all();
    return Inertia::render('Course/Create',['categories'=>$categories]);
    }
    public function store(Request $request){
        $validated=$request->validate([
            'title'=>'required|string',
            'category_id'=>'required',
            'description'=>'required',
            'price'=>'required'
        ]);
        $validated['instructor_id']=Auth::user()->id();
        $validated['slug']=\Str::slug(($validated['title']));
        Course::create($validated);
        return redirect()->route('Courses.index')->with('success','Course created successfully');

    }
    public function show(Course $course){
        $course->load('sections.lessons','reviews.user');
        return Inertia::render('Courses/Show',[
            'course'=>$course
        ]);

    }

    public function edit(Course $course){
        $categories=Category::all();
        return Inertia::render('Courses/Edit',
        [
            'course'=>$course,
            'categories'=>$categories
        ]);
    }
    public function update(Request $request,Course $course){
        $validated=$request->validate([
            'title'=>'required',
            'description'=>'required',
            'price'=>'required|numeric'
        ]);
        $course->update($validated); return redirect()->route('courses.index')
        ->with('success','course updated successfully');
    }
    public function destroy(Course $course){
        $course->delete();
        return redirect()->route('courses.index')->with('success','course deleted');
        }
}
