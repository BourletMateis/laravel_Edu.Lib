<?php
namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Http\Requests\AppointmentRequest;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Mime\Part\Multipart\AlternativePart;
use Validator;

class AppointmentsController extends Controller
{
   public function index()
   {
       $this->authorize('viewAdmin', new Appointments());
       Carbon::setLocale('fr');
       $appointments = Appointments::where('user_teacher_id', auth()->id())->get();

       $events = $appointments->map(function ($appointment) {
           // Formatting dates
           $start = Carbon::parse($appointment->date . ' ' . $appointment->start_time)->locale('fr')->isoFormat('YYYY-MM-DDTHH:mm');
           $end = Carbon::parse($appointment->date . ' ' . $appointment->end_time)->locale('fr')->isoFormat('YYYY-MM-DDTHH:mm');
           //get the name and surname of the student 
           $user = User::find($appointment->user_student_id);
           $name_surname = $user->name . ' ' . $user->surname;
           return [
               'id' => $appointment->id,
               'start' => $start,
               'end' => $end,
               'title' => $name_surname,
               'email'=> $user->email,
               'user_student_id' => $appointment->user_student_id,
               'user_teacher_id' => $appointment->user_teacher_id,
               'subject' => $appointment->title,
               'description' => $appointment->description,
               'date' => $appointment->date,
               'price' => $appointment->price,
           ];
       });
       // Return the events in JSON format
       return response()->json($events);
   }

   public function destroy(Request $request, Appointments $appointment)
   {
       $this->authorize('delete', $appointment);
       $appointment = Appointments::find($request->id);
       if ($appointment) {
           $appointment->delete();
           return response()->json(['message' => 'Rendez-vous supprimé']);
       }
       return response()->json(['message' => 'Rendez-vous non trouvé'], 404);
   }

   public function createAppointments(AppointmentRequest $request)
   {
       // Vérifier s'il existe déjà un rendez-vous avec les mêmes informations
       $existingAppointment = Appointments::where('start_time', $request->input('start_time'))
           ->where('end_time', $request->input('end_time'))
           ->where('user_teacher_id', $request->input('user_teacher_id'))
           ->where('user_student_id', $request->input('user_student_id'))
           ->where('date', $request->input('date'))
           ->first();
   
       if ($existingAppointment) {
        
           return response()->json(['error' => 'Un rendez-vous avec ces détails existe déjà.'], 400);
       }
   
       $appointment = Appointments::create([
           'start_time' => $request->input('start_time'),
           'user_teacher_id' => $request->input('user_teacher_id'),
           'user_student_id' => $request->input('user_student_id'),
           'title' => $request->input('title'),
           'description' => $request->input('description'),
           'price' => $request->input('price'),
           'end_time' => $request->input('end_time'),
           'date' => $request->input('date'),
       ]);
   
       return response()->json($appointment, 201);
   }
   
   }


