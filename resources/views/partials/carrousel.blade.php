<style>
@-webkit-keyframes scroll {
  0% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
  }
  100% {
    -webkit-transform: translateX(calc(-250px * 7));
            transform: translateX(calc(-250px * 7));
  }
}

@keyframes scroll {
  0% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
  }
  100% {
    -webkit-transform: translateX(calc(-250px * 7));
            transform: translateX(calc(-250px * 7));
  }
}
.slider {
  background: white;
  box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.125);
  margin: auto;
  overflow: hidden;
  position: relative;
}
.slider::before, .slider::after {
  background: linear-gradient(to right, white 0%, rgba(255, 255, 255, 0) 100%);
  content: "";
  height: 50px;
  position: absolute;
  width: 250px;
  z-index: 2;
}
@media (max-width: 600px) {
    .slider::before, .slider::after {
  background: linear-gradient(to right, white 0%, rgba(255, 255, 255, 0) 30%);
  content: "";
  height: 50px;
  position: absolute;
  width: 250px;
  z-index: 2;
}
}
.slider::after {
  right: 0;
  top: 0;
-webkit-transform: rotateZ(180deg);
          transform: rotateZ(180deg);
}
.slider::before {
  /*left: 0;
  top: 0;
  */
}
.slider .slide-track {
  -webkit-animation: scroll 40s linear infinite;
          animation: scroll 40s linear infinite;
  display: flex;
  width: calc(180px * <?php echo isset($pricesCryptos) ? count($pricesCryptos) : ''; ?>);
}
.slider .slide {
  height: 50px;
margin:auto;
	display: flex;
	flex-direction: row;
	align-content: center;
	align-items: center;	
}
.slide img {
	object-fit: contain;
	width: 25px;
	height: 25px;	
	margin-right: .4rem;	
}
</style>

<div class="slider">
	<div class="slide-track">
		@if(isset($pricesCryptos))
			@foreach($pricesCryptos as $obj)
				<div class="slide">
					<img src="{{ asset('uploads/img/' . $obj['img']) }}" alt="">
					1 {{ $obj['code'] }} = {{ $obj['price'] }} {{$symbol}}
				</div>
			@endforeach
		@endif
	</div>
</div>