let sliderIndex = [1, 1]
let sliderClass = ["slider-imagenes", "slider-ofertas"]
mostrarSlide(1, 0);
mostrarSlide(1, 1);


function mostrarSlide(n, no) {
	let x = document.getElementsByClassName(sliderClass[no]);
	if (n > x.length) { sliderIndex[no] = 1 }
	if (n < 1) { sliderIndex[no] = x.length }
	for (let i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	x[sliderIndex[no] - 1].style.display = "block";
}

function cambiarSlide(n, no) {
	mostrarSlide(sliderIndex[no] += n, no);
}

function comenzarImagen() {
	setInterval(cambiarSlide, 2000, 1, 0);
}

function comenzarOfertas() {
	setInterval(cambiarSlide, 2000, 1, 1);
}

comenzarImagen();
comenzarOfertas();

let rotadores = document.getElementsByClassName("slider-wrapper")
let rotadorImagen = rotadores[0]
let rotadorOfertas = rotadores[1]

