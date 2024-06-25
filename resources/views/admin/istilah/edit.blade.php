@extends('admin.index')

@section('main-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> {{ $title }} </h1>
    <div class="btn-toolbar mb-2 mb-md-0">

    </div>
</div>

<form method="POST" action="/admin/terms/{{ $term->id }}">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">ID Istilah</label>
      <input type="text" name="title" value="{{ $term->id }}" disabled class="form-control @error('title') is-invalid  @enderror" id="title" aria-describedby="emailHelp">
      @error('title')
      <div id="titleFeedback" class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" value="{{ $term->title }}" class="form-control @error('title') is-invalid  @enderror" id="title" aria-describedby="emailHelp">
      @error('title')
      <div id="titleFeedback" class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        @error('description')
        <p class="text-danger"> {{ $message }}</p>
        @enderror
        <input id="description" type="hidden" name="description" value="{{ $term->description }}">
        <trix-editor input="description"></trix-editor>
    </div>
    <button type="submit" class="btn btn-primary">Perbarui Data</button>
    <a href="/admin/terms" type="button" class="btn btn-outline-primary">
        Batal
    </a>
  </form>
@endsection
