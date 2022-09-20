// webpack.mix.js
let mix = require('laravel-mix');

mix.js('assets/src/js/app.js', 'assets/dist/js')
	//.js('assets/src/js/charts.js', 'assets/dist/js')
	//.js('assets/src/js/alpine.js', 'assets/dist/js')
	.postCss('assets/src/css/app.css', 'assets/dist/css/app.css', [
		//require('bootstrap'),
		require('tailwindcss'),
	]).postCss('assets/src/css/auth.css', 'assets/dist/css/auth')
	//.less('assets/src/css/fontawesome.less', 'assets/dist/css/fontawesome.css')
	//.sourceMaps()
	.copy(
		'node_modules/@fortawesome/fontawesome-free/webfonts',
		'assets/dist/webfonts'
	);
	//mix.webpackConfig({
	//	stats: {
	//		children: true,
	//	},
	//});