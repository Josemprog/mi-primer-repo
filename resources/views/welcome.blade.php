@extends('layouts.app')

@section('content')
<div class="container">

  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" style="margin-top: 50px">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="rounded mx-auto d-block w-50" src="/img/frontend/shelving4.jpeg">

        <div class="carousel-caption d-none d-md-block">
          <h3>Welcome!!</h3>
          <p>This is your online shoe store!</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="rounded mx-auto d-block w-50" src="/img/frontend/shelving7.jpeg">

        <div class="carousel-caption d-none d-md-block">
          <h3>Find your style</h3>
          <p>We have brands for every type of personality and style.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="rounded mx-auto d-block w-50" src="/img/frontend/shelving11.jpeg">

        <div class="carousel-caption d-none d-md-block">
          <h3>Give the best first impression</h3>
          <p>We have shoes for every occasion.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <hr style="margin-top: 50px">
  <div class="d-flex justify-content-center align-items-center" style="height: 500px;">
    <img class="img d-block p-4" style="height: 400px; width: auto;" src="/img/frontend/shelving1.jpeg">
    <div>
      <h1 class="text-white">Sport shoes</h1>
      <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit quae eius dignissimos
        commodi, earum itaque! Ab
        quae repellat, fugiat cumque impedit numquam at, aliquam assumenda nemo consectetur, labore molestiae neque.</p>
    </div>
  </div>
  <hr>
  <div class="d-flex justify-content-center align-items-center" style="height: 500px;">
    <div>
      <h1 class="text-white">Variety of shoes</h1>
      <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit quae eius dignissimos
        commodi, earum itaque! Ab
        quae repellat, fugiat cumque impedit numquam at, aliquam assumenda nemo consectetur, labore molestiae neque.</p>
    </div>
    <img class="img d-block p-4" style="height: 400px; width: auto;" src="/img/frontend/shelving2.jpeg">
  </div>
</div>
@endsection