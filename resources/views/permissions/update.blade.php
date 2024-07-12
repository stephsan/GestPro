@extends('./layouts/base')
@section('title')
@endsection
@section('css')
@endsection
@section('content')

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark"><a href="{{route('dashboard')}}">Accueil</a></li>
                <li class="breadcrumb-item active text-dark"><a href="{{route('roles.index')}}">permissions</a></li>
                <li class="breadcrumb-item active text-dark active">Ajout une nouveau role</li>
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
                    <form id="form-validation" method="POST"  action="{{route('permissions.update', $permission)}}" class="form-horizontal form-bordered">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label" for="nom">Libelle de la permission<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <input id="name" type="text" class="form-control" name="nom" value="{{$permission->name}}" required autofocus>
                                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                        </div>
                                        @if ($errors->has('nom'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nom') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                                        <label class="col-md-6 control-label">Module<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <select name="for" id="for" class="form-control"
                                        >
                                            <option selected disabled>Selectionne permission pour</option>
                                            <option value="dossier">Souscription</option>
                                            <option value="administration">Administration</option>
                                        </select>
                                </div>
                                </div>
                        <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-sm btn-sucess"><i class="fa fa-arrow-right"></i> Valider</button>
                            <a href="{{ route('permissions.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Annuler</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
