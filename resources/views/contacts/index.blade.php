@extends('base')
@section('main')
<nav class="navbar navbar-light mt-3">

    <a class="btn btn-info" href="{{ route('contacts.index')}}" >
        Agenda
    </a>
    @if (Route::has('login'))
                    @auth
                    <li class="navbar-brand btn btn-outline-info text-inf dropdown">
                        <a href="#" class="dropdown-toggle text-light" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();" class="text-dark btn">
                                    Cerrar Sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            
                        </ul>
                    </li>
                      @else
                      <a class="navbar-brand btn btn-outline-info text-info" href="/login" >
                        Iniciar Sesión
                      </a>
                    @endauth
            @endif
  </nav>
<div class="">  
<div class="row"><div class="col-sm-12">    
    <h1 class="d-flex justify-content-center py-4">Lista de Contactos</h1>
    <div>
    <form class="form-inline float-left">
        <input name="buscarpor" class="form-control mr-sm-2" type="search" placeholder="ingrese Apellido" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>

    <a class="btn btn-primary btn-sm float-right" href="{{ route('contacts.create')}}" >
        Agregar Contacto
    </a>
    </div>      
    <table class="table table-dark" style="margin-top:70px">    
        <thead>       
        <tr>          
            <td>Codigo</td>          
            <td>Nombre</td>       
                <td>Apellidos</td>        
                <td>Correo</td>   
                <td>Telefono</td>
                <td>Imagen</td>                  
            <td colspan = 2>Acciones</td>       
        </tr>    
    </thead>    
    <tbody>        
    @foreach($contacts as $contact)        
    <tr>            
    <td>{{$contact->id}}</td>            
    <td>{{$contact->nombres}}</td> 
    <td>{{$contact->apellidos}}</td>            
    <td>{{$contact->correo}}</td>
    <td>{{$contact->telefono}}</td>
    <td><img src="{{$contact->Foto}}" alt="" width="100px" height="70px"></td>                      
    <td>                
    <a href="{{ route('contacts.edit',$contact->id)}}" class="btn btn-primary">Editar</a>            
</td>            
<td>                
    <form action="{{ route('contacts.destroy', $contact->id)}}" method="post">                  
    {{ csrf_field() }}
    {{method_field('DELETE')}} 
    <button class="btn btn-danger" type="submit">Eliminar</button>               
</form>            
</td>        </tr>       
 @endforeach   
</tbody>  </table>
</div>
<div class="col-sm-12">  @if(session()->get('success'))   
     <div class="alert alert-success">     
          {{ session()->get('success') }}     
         </div>  @endif</div>
</div>

@endsection