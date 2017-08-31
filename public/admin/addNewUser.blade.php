@extends('admin.index')
@section('admin.main')
    
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-user-plus"></i> Add New User
            </h4>

            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
                 <li class="active">
                    <i class="fa fa-users"></i> Users Settings
                </li>                
                <li >
                    <i class="fa fa-fw fa-user-plus"></i> Add New User
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    
    <div class="row">
        
        <div class="col-md-12">
        
            @if($errors->any() )

                <div style="padding:8px;margin-bottom:25px;"
                 class="alert alert-danger text-left" role="alert">
                <ul style="list-style:none;" >
                    {{ implode('',$errors->all('
                        <li ><i class="fa fa-exclamation-circle"></i> :message</li>
                        '))
                     }}
                </ul>
                </div>

            @endif                    

           @if(Session::has('success'))
              <div style="padding:8px;margin-bottom:25px;" class="alert alert-success text-left" role="alert">
                <ul style="list-style:none;" >
                    <li >
                    <i class="fa fa-check-circle"></i>
                         New User has been Created.
                   </li>
                </ul>

              </div>
           @endif()
        </div>
        
        <div class="col-md-7">

            
            {{ Form::open( array(
                'method' => 'post',
                'role' => 'form'
            ) ) }}
           
           
          <div class="form-group">
               {{ Form::label( 'username','Username') }}
               
               {{ Form::text('username','' ,array(
               'class'=>'form-control',
               'tabindex'   => '1',
               'placeholder'=> 'Username'
               )) }}
           </div>
                


        <div class="form-group">
            {{ Form::label('email','User Email') }}
                
            {{ Form::text('email',$data['settings']->email ,array(
                'class'=>'form-control',
                'tabindex'   => '2',
                'placeholder'=> 'Email '
                ))
            }}
        </div>
              

        <div class="form-group">
            {{ Form::label('password','User Password') }}

           {{ Form::password( 'password',array(
               'id'         =>'password',
               'tabindex'   => '3',
               'class'      => 'form-control',
               'placeholder'=> 'Password'
            ))}}

        </div>

        <div class="form-group">
           {{ Form::label('password_confirmation','User Password Confirmation') }}

           {{ Form::password( 'password_confirmation',array(
               'id'         =>'password_confirmation',
               'tabindex'   => '4',
               'class'      => 'form-control',
               'placeholder'=> 'Confirm Password'
           ) ) }}

        </div>

            <div class="form-group">
                {{ Form::label('plan','User Plan') }}

                {{  Form::select('plan_id',
                 array('2' => Plans::find(2)->name  , '3' => Plans::find(3)->name ),'user',
                 array('class' => 'form-control','tabindex'   => '4',))
                  }}
            </div>
            <br >
            
            <div class="form-group">
               {{ Form::label('level','User Level (permission)') }}

                {{  Form::select('level',
                 array('user' => 'user', 'admin' => 'admin'),'user',
                 array('class' => 'form-control','tabindex'   => '4',))
                  }}
            </div>   
               <br >
            
            <div class="form-group">
                {{ Form::button('<i class="fa fa-fw fa-save"></i> Save User', array(
                   'type' => 'submit',
                                  'tabindex'   => '6',

                   'class' => 'btn btn-success  btn-block'
                   ));
                }}
            </div>
          
                
            </div>
            
            
        </div>
                 {{ Form::close() }}

    </div>


@endsection
@stop