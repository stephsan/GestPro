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
                <li class="breadcrumb-item active text-dark"><a href="{{route('valeurs.index')}}">Valeurs</a></li>
                <li class="breadcrumb-item active text-dark active">Ajout d'une nouvelle valeur</li>
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
            <form action="{{ route('valeurs.update', $valeur) }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                    <div class="form-group{{ $errors->has('Parametre') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label" for="typeorga">Parametre : </label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <select  class="form-control" id="parent" name="parametre"  >
                                <option></option>

                                @foreach($parametres as $parametre)
                                        <option value="{{ $parametre->id }}"
                                            @if ($parametre->id == $valeur->parametre_id)
                                                selected
                                            @endif
                                            >{{ $parametre->libelle }}</option>
                                 @endforeach

                            </select>     </div>
                        @if ($errors->has('parent'))
                        <span class="help-block">
                            <strong>{{ $errors->first('parent') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('parent') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label" for="typeorga">Parent : </label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <select  class="form-control" id="parent" name="parent"  >
                                <option></option>

                                @foreach($vals as $val)
                                    <option value="{{ $val->id }}"
                                       @if ($valeur->id == $val->val_id)
                                            selected
                                       @endif
                                        >{{ $val->libelle }}</option>
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
                                <input id="libele" type="text" class="form-control" name="libelle" value="{{ old('libele')?? $valeur->libelle }}" required>

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
                            <textarea id="description" name="description" placehorder="description" class="form-control">{{old('description')?? $valeur->libelle}}</textarea>
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
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Modifier</button>
                       <a href="{{ route('valeurs.index') }}" class="btn btn-sm btn-warning">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
 </div>
    </section>
@endsection
