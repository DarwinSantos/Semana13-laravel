@extends('base')
@section('main')
<h1 class='d-flex justify-content-center mt-5'>LOGIN</h1>
    
        
          <div class="card bg-dark my-4 d-flex justify-content-center" style="margin-left: 30%;margin-right:30%;">
            <div class="card-body">
              <div class="form-group">                
                  <label for="nombres">Nombres:</label>             
                      <input type="text" class="form-control" name="nombres" id="nombres"/>         
                          </div>
               <div class="form-group">                
                      <label for="Apellidos">Apellidos:</label>             
                          <input type="text" class="form-control" name="Apellidos" id="Apellidos"/>         
                              </div>
       <div class="form-group">                
             <label for="Password">Password:</label>             
                      <input type="password" class="form-control" name="Password" id="Password"/>         
                           </div>
                    <div class="form-group d-flex justify-content-center">       
                                 <div class="col-md-6">
                                    <a href="/contacts" class="d-flex justify-content-center btn btn-primary py-2 mt-5">INICIAR </a> 
                                 </div>                                                 
                 </div>                                        

            </div>
        </div>
@endsection
