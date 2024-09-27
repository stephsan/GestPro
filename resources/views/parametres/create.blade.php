@extends('./layouts/base')
@section('title')
@endsection
@section('administration', 'show')
@section('parametre', 'active')
@section('css')
@endsection
@section('content')

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark"><a href="{{route('dashboard')}}">Accueil</a></li>
                <li class="breadcrumb-item active text-dark"><a href="{{route('permissions.index')}}">parametres</a></li>
                <li class="breadcrumb-item active text-dark active">Ajout un nouveau parametres</li>
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
            <form action="{{ route('parametres.store') }}" method="POST" class="form-horizontal form-bordered">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('parent') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label" for="typeorga">Parametre parent : </label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <select  class="form-control select-select2" id="parent" name="parent"  >
                                <option></option>
                                @foreach($parametres as $parametre)
                                                                <option value="{{ $parametre->id }}">{{ $parametre->libelle }}</option>
                                                                @endforeach

                            </select>     </div>
                        @if ($errors->has('parent'))
                        <span class="help-block">
                            <strong>{{ $errors->first('parent') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('libele') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label" for="libele">Libellé : <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <div class="input-group">
                                <input id="libele" type="text" class="form-control" name="libele" value="{{ old('libele') }}" required>

                        </div>
                        @if ($errors->has('libele'))
                        <span class="help-block">
                            <strong>{{ $errors->first('libele') }}</strong>
                        </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label" for="description">Description : <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <div class="input-group">
                            <textarea id="description" name="description" placehorder="description" class="form-control">{{old('description')}}</textarea>
                            </div>
                    @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
                <div class="form-group form-actions">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Enregistrers</button>
                        <a href="{{ route('parametres.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i>Annuler</a>
                    </div>
                </div>
            </form>
            <!-- END Basic Form Elements Content -->
        </div>
    </div>
            </div></div></section>
@endsection
