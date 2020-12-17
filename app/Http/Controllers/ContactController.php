<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use JD\Cloudder\Facades\Cloudder;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts=Contact::all();
        return view('contacts.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    public function store(Request $request)
    {


        $request->validate([
            'nombres'=>'required',
            'apellidos'=>'required',
            'correo'=>'required',
            'telefono'=>'required',
            
        ]);

        //ClOUDINARY----------------
        //Darwin Santos
        $this->validate($request,[
            'Foto'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
        ]);


        $image = $request->file('Foto');
        $name = $request->file('Foto')->getClientOriginalName();
        $image_name = $request->file('Foto')->getRealPath();;
        Cloudder::upload($image_name, null);
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
        //temporal la de abajo--> obtiene el nombre de la imagen
        $image_name_un= Cloudder::getPublicId();
      
        //save to uploads directory
        $image->move(public_path("uploads"), $name);
        $contact=new Contact([
            'nombres'=>$request->get('nombres'),
            'apellidos'=>$request->get('apellidos'),
            'correo'=>$request->get('correo'),
            'telefono'=>$request->get('telefono'),
            'Foto' => $image_url,
            'Nombre_foto'=>$image_name_un]);

        $contact->save();
        return redirect('/contacts')->with('success','Contacto registrado');
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
        $contact=Contact::find($id);
        return view('contacts.edit',compact('contact'));
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
        //Darwin Santos
        //CLOUDINARY-----------
        $this->validate($request,[
            'Foto'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
        ]);
        $image = $request->file('Foto');
        $name = $request->file('Foto')->getClientOriginalName();
        $image_name = $request->file('Foto')->getRealPath();;
        Cloudder::upload($image_name, null);
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
        $image_name_un= Cloudder::getPublicId();
        $image->move(public_path("uploads"), $name);
         //elimina el dato de cloudinary--------------------------
         $valoress = contact::where('id',$id)
         ->firstOr(['Nombre_foto'],function(){});
         //da formato
         $nombre_foto =$valoress->Nombre_foto;
         Cloudder::destroyImages($nombre_foto);   


        $request->validate([
            'nombres'=>'required',
            'apellidos'=>'required',
            'correo'=> 'required',
            'telefono'=>'required',
        ]);
        $contact= Contact::find($id);
        $contact->nombres=$request->get('nombres');
        $contact->apellidos=$request->get('apellidos');
        $contact->correo=$request->get('correo');
        $contact->telefono=$request->get('telefono');
        $contact->Foto=$image_url;
        $contact->Nombre_foto=$image_name_un;
        $contact->save();
        return redirect('/contacts')->with('success','Contacto Actualizado');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    //Valor de la imagen
    $valoress = contact::where('id',$id)
    ->firstOr(['Nombre_foto'],function(){});
    $nombre_foto =$valoress->Nombre_foto;
    //elimina en cloudinary
    Cloudder::destroyImages($nombre_foto);

    //elimina DB
    contact::destroy($id);
        return redirect('/contacts')->with('success','Contacto Eliminado');
    }

}
