<?php
$sliders = App\Slider::all();
$count = $sliders->count();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div id="demo" class="carousel slide " data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                    @for($i= 0 ;$i < $count ; $i++)
                    <li data-target="#demo" data-slide-to="{{$i}}" @php if($i==0) echo "class=active";  @endphp ></li>
                    @endfor
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner">
                    @foreach($sliders as $slide)

                        <div class="carousel-item   @php if($loop->first) echo "active";  @endphp " >
                            <img src="{{asset('storage/'.$slide->imageAddress)}}"  alt="Los Angeles" class="imageslider">

                        </div>
                      @endforeach
                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>

            </div>
        </div>
    </div>

</div>

