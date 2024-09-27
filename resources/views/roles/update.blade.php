@extends('./layouts/base')
@section('title')
@endsection
@section('administration', 'show')
@section('role', 'active')
@section('css')
@endsection
@section('content')

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark"><a href="{{route('dashboard')}}">Accueil</a></li>
                <li class="breadcrumb-item active text-dark"><a href="{{route('role.index')}}">roles</a></li>
                <li class="breadcrumb-item active text-dark active">Modifier un role</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-12 col-md-10 offset-0 offset-md-1">
                <div class="card mt-2">
                    <div class="card-body">
                        @if(session()->has('succes'))
                            <div class="alert alert-success">{{session()->get('succes')}}</div>
                        @endif
                    <form id="form-validation" method="POST"  action="{{route('role.update', $role)}}" class="form-horizontal form-bordered">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label" for="nom">Libellé du role<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                            <input id="name" type="text" class="form-control" name="nom" value="{{ $role->nom }}" required autofocus>
                                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                    </div>
                                    @if ($errors->has('nom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nom') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Role Système <span class="text-success">*</span></label>
                            <div class="col-md-9">
                                <div class="input-group">
                                        <input type="checkbox"  class="form-control" name="typeRole" value="1"
                                        @if($role->typerole == 1)
                                        checked
                                         @endif>
                                </div>
                            </div>
                        </div>

                            <div class="row col-lg-offset-1">
                                <div class="col-lg-4">
                                    <label>Permissions Système</label>
                                    @foreach ($permissions as $permission )
                                        @if($permission->for== 'systeme')
                                                <label><input type="checkbox" name=permissions[] value="{{ $permission->id }}"
                                                    @foreach ($role->permissions as $role_permit)
                                                            @if ($role_permit->id==$permission->id)
                                                                  checked
                                                            @endif
                                                        @endforeach
                                                        > {{ $permission->name }}</label>
                                                    @endif
                                                @endforeach
                                </div>
                                <div class="col-lg-4">
                                        <label>Permissions Dossier</label>
                                        @foreach ($permissions as $permission )
                                            @if($permission->for== 'dossier')
                                                    <label><input type="checkbox" name=permissions[] value="{{ $permission->id }}"
                                                        @foreach ($role->permissions as $role_permit)
                                                            @if ($role_permit->id==$permission->id)
                                                                  checked
                                                            @endif
                                                        @endforeach
                                                        > {{ $permission->name }}</label>
                                            @endif
                                        @endforeach
                                </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                                <label>Permissions Administration</label>
                                                @foreach ($permissions as $permission )
                                                    @if($permission->for== 'administration')
                                                            <label><input type="checkbox" name=permissions[] value="{{ $permission->id }}"
                                                                @foreach ($role->permissions as $role_permit)
                                                                    @if ($role_permit->id==$permission->id)
                                                                      checked
                                                                    @endif
                                                                @endforeach

                                                                > {{ $permission->name }}</label>
                                                    @endif
                                                @endforeach
                                </div>
                            </div>

                        <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Valider</button>
                            <a href="{{ route('role.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Annuler</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
